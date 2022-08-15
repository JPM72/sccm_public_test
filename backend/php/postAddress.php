<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'postAddress';


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
	//check if site exists in table
	$SQL = "SELECT id FROM customer_site_quoted WHERE id = {$d->clientOverview->siteId}";
	doLog($SQL);
	$returnSiteRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnSiteRows) > 0) {
		// // insert new address details if siteCode does not exist
		// if (empty($d->clientOverview->siteCode)) {
		// 	$SQL = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
		// 			VALUES ('".$d->newSite->newSiteAddress."', ".$d->clientOverview->siteId.", 1)";
		// 	doLog($SQL);
		// 	crgExecMySql($SQL);
		// } else {
			// update address rows if siteId exists in address_quoted
			$addressSQL = "SELECT id FROM address_quoted WHERE site_quoted = {$d->clientOverview->siteId}";
			doLog($addressSQL);
			$returnAddressRows = crgMySqlgetRowArr($addressSQL);
			if (sizeof($returnAddressRows) > 0) {
				$retArr["addressSiteQuotedId"] = $returnSiteRows[0]['id'];
				$retArr["description"] = 'Address exists in address_quoted table';

				$addressSQL = "SELECT id FROM address_quoted WHERE site_quoted = {$d->clientOverview->siteId} AND address_type = 1";
				doLog($addressSQL);
				$returnAddressRows = crgMySqlgetRowArr($addressSQL);
				if (sizeof($returnAddressRows) > 0) {
					$SQL1 = "UPDATE address_quoted SET address_name = '".mssql_escape($d->serviceDelivery->serviceAddress)."', upd_date = CURRENT_TIMESTAMP WHERE address_type = 1 AND site_quoted = ".$d->clientOverview->siteId."";
					doLog($SQL1);
					crgExecMySql($SQL1);
				} else {
					$SQL1 = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
							VALUES ('".mssql_escape($d->serviceDelivery->serviceAddress)."', ".$d->clientOverview->siteId.", 1)";
					doLog($SQL1);
					crgExecMySql($SQL1);
				}
				
				$addressSQL = "SELECT id FROM address_quoted WHERE site_quoted = {$d->clientOverview->siteId} AND address_type = 2";
				doLog($addressSQL);
				$returnAddressRows = crgMySqlgetRowArr($addressSQL);
				if (sizeof($returnAddressRows) > 0) {
					$SQL2 = "UPDATE address_quoted SET address_name = '".mssql_escape($d->clientOverview->postalAddress)."', upd_date = CURRENT_TIMESTAMP WHERE address_type = 2 AND site_quoted = ".$d->clientOverview->siteId."";
					doLog($SQL2);
					crgExecMySql($SQL2);
				} else {
					$SQL2 = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
							VALUES ('".mssql_escape($d->clientOverview->postalAddress)."', ".$d->clientOverview->siteId.", 2)";
					doLog($SQL2);
					crgExecMySql($SQL2);
				}

				$addressSQL = "SELECT id FROM address_quoted WHERE site_quoted = {$d->clientOverview->siteId} AND address_type = 3";
				doLog($addressSQL);
				$returnAddressRows = crgMySqlgetRowArr($addressSQL);
				if (sizeof($returnAddressRows) > 0) {
					$SQL3 = "UPDATE address_quoted SET address_name = '".mssql_escape($d->payment->payBillingAddress)."', upd_date = CURRENT_TIMESTAMP WHERE address_type = 3 AND site_quoted = ".$d->clientOverview->siteId."";
					doLog($SQL3);
					crgExecMySql($SQL3);
				} else {
					$SQL3 = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
							VALUES ('".mssql_escape($d->payment->payBillingAddress)."', ".$d->clientOverview->siteId.", 3)";
					doLog($SQL3);
					crgExecMySql($SQL3);
				}

				$addressSQL = "SELECT id FROM address_quoted WHERE site_quoted = {$d->clientOverview->siteId} AND address_type = 4";
				doLog($addressSQL);
				$returnAddressRows = crgMySqlgetRowArr($addressSQL);
				if (sizeof($returnAddressRows) > 0) {
					$SQL4 = "UPDATE address_quoted SET address_name = '".mssql_escape($d->clientOverview->physicalAddress)."', upd_date = CURRENT_TIMESTAMP WHERE address_type = 4 AND site_quoted = ".$d->clientOverview->siteId."";
					doLog($SQL4);
					crgExecMySql($SQL4);
				} else {
					$SQL4 = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
							VALUES ('".mssql_escape($d->clientOverview->physicalAddress)."', ".$d->clientOverview->siteId.", 4)";
					doLog($SQL4);
					crgExecMySql($SQL4);
				}
			} else {
				// insert existing address details siteCode exist
				$SQL = "INSERT INTO address_quoted (address_name, site_quoted, address_type)
						VALUES ('".mssql_escape($d->serviceDelivery->serviceAddress)."', ".$d->clientOverview->siteId.", 1),
								('".mssql_escape($d->clientOverview->postalAddress)."', ".$d->clientOverview->siteId.", 2),
								('".mssql_escape($d->payment->payBillingAddress)."', ".$d->clientOverview->siteId.", 3),
								('".mssql_escape($d->clientOverview->physicalAddress)."', ".$d->clientOverview->siteId.", 4)";
				doLog($SQL);
				crgExecMySql($SQL);
			}
		// }
	}

    crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}

echo json_encode($retArr);
?>