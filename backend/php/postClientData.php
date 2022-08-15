<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'postClientData';


if (isset($_POST["data"])) { 
	$data = $_POST["data"];
	$d = json_decode($data);
	$retArr["posted"] = $d;
	doLog(print_r($d, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "data not in POST parameter";
	echo json_encode($retArr);
	exit;
};

try {
	//check if customer exists in table
	
	$customerId = empty($d->clientOverview->companyId) ? $d->newCustomer->newCustomerId : $d->clientOverview->companyId;
	$SQL = "SELECT id FROM customer_quoted WHERE customer_id = {$customerId} OR id = {$customerId}";
	doLog($SQL);
	$returnCustomerRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnCustomerRows) > 0) {
		$retArr["customerQuotedId"] = $returnCustomerRows[0]['id'];
		$retArr["description"] = 'Customer exists in customer_quoted table';
		$accRegNum = $d->account->accRegNo ? $d->account->accRegNo : 'NULL';
		$clientIndustry = $d->clientOverview->clientIndustry ? $d->clientOverview->clientIndustry : 'NULL';
		$SQL = "UPDATE customer_quoted
				SET registration_number = '$accRegNum',
					client_industry = $clientIndustry,
					upd_date = CURRENT_TIMESTAMP 
				WHERE customer_id = {$customerId} OR id = {$customerId}";
				doLog($SQL);
				crgExecMySql($SQL);
	} else {
		// Insert existing customer if customerCode in object is not empty
		if (!empty($d->clientOverview->companyCode) && !empty($d->clientOverview->siteCode)) {
			$customerId = $d->clientOverview->clientIndustry > 1000000000 ? 'NULL' :  $d->clientOverview->companyId;
			$insertSQL = "INSERT INTO customer_quoted (customer_name, customer_id, customer_code, registration_number, client_industry) 
							VALUES ('".mssql_escape($d->clientOverview->companyName)."', ".$customerId.", '".mssql_escape($d->clientOverview->companyCode)."', '".mssql_escape($d->account->accRegNo)."', '".$d->clientOverview->clientIndustry."')";
			doLog($insertSQL);
			crgExecMySql($insertSQL);
			$retArr["customerQuotedId"] = lastInsertedId();
		};
	};
	
	// check if site exists in table
	$cusId = empty($retArr['customerQuotedId']) ? $d->newCustomer->newCustomerId : $retArr['customerQuotedId'];
	$siteName = mssql_escape($d->clientOverview->siteName);
	$SQL = "SELECT id FROM customer_site_quoted WHERE site_name = '{$siteName}' AND customer_id = {$cusId}";
	doLog($SQL);
	$returnSiteRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnSiteRows) > 0) {
		$retArr["customerSiteQuotedId"] = $returnSiteRows[0]['id'];
		$retArr["description"] = 'Site exists in customer_site_quoted table';
		$SQL = "UPDATE customer_site_quoted
				SET site_name = '".mssql_escape($d->clientOverview->siteName)."',
					vat_number = '".mssql_escape($d->account->accVatNo)."',
					contact_person = '".mssql_escape($d->serviceDelivery->serDelName)."',
					email_address = '".mssql_escape($d->serviceDelivery->serDelEmail)."', 
					tel_number = '".mssql_escape($d->serviceDelivery->serDelTelNo)."', 
					cell_number = '".mssql_escape($d->serviceDelivery->serDelCellNo)."', 
					fax_number = '".mssql_escape($d->serviceDelivery->serDelFaxNo)."',
					upd_date = CURRENT_TIMESTAMP
				WHERE site_name = '{$d->clientOverview->siteName}' 
				AND customer_id = {$cusId}";
		doLog($SQL);
		crgExecMySql($SQL);

	} else {
		// Insert existing site
		if ($d->clientOverview->siteId < 1000000000) {
			$siteId = $d->clientOverview->siteId ? $d->clientOverview->siteId : 'NULL';
			$siteCode = $d->clientOverview->siteCode ? $d->clientOverview->siteCode : 'NULL';
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
							VALUES ('".mssql_escape($d->clientOverview->siteName)."', 
									$siteId, 
									".$retArr['customerQuotedId'].", 
									$siteCode, 
									'".mssql_escape($d->account->accVatNo)."',
									'".mssql_escape($d->serviceDelivery->serDelName)."', 
									'".mssql_escape($d->serviceDelivery->serDelEmail)."', 
									'".mssql_escape($d->serviceDelivery->serDelTelNo)."', 
									'".mssql_escape($d->serviceDelivery->serDelCellNo)."', 
									'".mssql_escape($d->serviceDelivery->serDelFaxNo)."')";
			doLog($insertSQL);
			crgExecMySql($insertSQL);
			$retArr["lastInsertedSiteId"] = lastInsertedId();
		}
	}

	// submit data into quote table to receive quote id
	// Once quote id received, insert rest of data into contact and address table

    crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	
	crgRollbackMySql();	
}

echo json_encode($retArr);
?>