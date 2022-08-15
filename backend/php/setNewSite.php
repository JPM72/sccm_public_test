<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'setNewSite';

if (isset($_POST["data"])) { 
	$data = $_POST["data"];
	$d = json_decode($data);
	doLog(print_r($d, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "data not in POST parameter";
	echo json_encode($retArr);
	exit;
}

try {
	//check if customer exists in table
	$cusId = empty($d->clientOverview->companyId) ? $d->newCustomer->newCustomerId : $d->clientOverview->companyId;
	$SQL = "SELECT id FROM customer_quoted WHERE customer_id = {$cusId} OR id = {$cusId}";
	doLog($SQL);
	$returnCustomerRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnCustomerRows) > 0) {
		$retArr["customerQuotedId"] = $returnCustomerRows[0]['id'];
	} else {
		// Insert existing customer if customerId in obj has a value to validate that it is an exising customer
		if (!empty($d->clientOverview->companyId)) {
			$customerId = empty($d->clientOverview->companyId)  ? 'NULL' : $d->clientOverview->companyId;
			$insertSQL = "INSERT INTO customer_quoted (customer_name, customer_id, customer_code) 
							VALUES ('".$d->clientOverview->companyName."', ".$customerId.", ".$d->clientOverview->companyCode.")";
			doLog($insertSQL);
			crgExecMySql($insertSQL);
			$retArr["customerQuotedId"] = lastInsertedId();
		};
	};
	// insert new site if site code does not exist
	if (empty($d->clientOverview->siteCode)) {
		$siteName = $d->newSite->newSiteName ? $d->newSite->newSiteName : 'NULL';
		//$siteAddresss = $d->newSite->newSiteAddress ? $d->newSite->newSiteAddress : 'NULL';
		$siteId = $d->clientOverview->siteId ? $d->clientOverview->siteId : 'NULL';
		$siteCode = $d->clientOverview->siteCode ? $d->clientOverview->siteCode : 'NULL';
		$customerId = empty($retArr['customerQuotedId']) ? $d->newCustomer->newCustomerId : $retArr['customerQuotedId'];
		$insertSQL = "INSERT INTO customer_site_quoted (site_name, 
														site_id, 
														customer_id, 
														site_code,
														vat_number,
														contact_person,
														email_address, 
														tel_number, 
														cell_number, 
														fax_number)
						VALUES ('".$siteName."', 
								".$siteId.", 
								".$customerId.", 
								".$siteCode.",
								'".$d->newSite->newSiteVatNo."',
								'".$d->newSite->newSiteContactPerson."', 
								'".$d->newSite->newSiteEmailAddress."', 
								'".$d->newSite->newSiteTelNo."', 
								'".$d->newSite->newSiteCellNo."', 
								'".$d->newSite->newSiteFaxNo."')";
		doLog($insertSQL);
		crgExecMySql($insertSQL);
		$retArr["lastInsertedSiteId"] = lastInsertedId();


		$SQL = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
				VALUES ('".$d->newSite->newSiteAddress."', ".$retArr["lastInsertedSiteId"].", 1)";
			doLog($SQL);
			crgExecMySql($SQL);
	}
	crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}

echo json_encode($retArr);




?>