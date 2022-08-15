<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'postQuote';


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

if (isset($_POST["userId"])) { 
	$userId = $_POST["userId"];
	$retArr["posted"] = $userId;
	doLog(print_r($userId, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "userId not in POST parameter";
	echo json_encode($retArr);
	exit;
};

try {
	// get site id in customer_site_quoted table / check if site id exists
    // if site_id exists, insert relevant data and site id into quote table
	$SQL = "SELECT id FROM customer_site_quoted WHERE id = {$d->clientOverview->siteId}";
	doLog($SQL);
	$returnSiteRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnSiteRows) > 0) {
		// update quote if quote id exists in quote table
		$quoteId = $d->clientOverview->quoteId ? $d->clientOverview->quoteId : 0;
		$SQL = "SELECT id FROM quote WHERE id = {$quoteId}";
		doLog($SQL);
		$returnQuoteRows = crgMySqlgetRowArr($SQL);
		if (sizeof($returnQuoteRows) > 0) {
			// $userID = empty($userId) ? 32 : $userId;  
			$retArr["quoteId"] = $returnQuoteRows[0]['id'];
			$retArr["description"] = 'Quote exists in quote table';
			$SQL = "UPDATE quote
					SET client_order_no = '".mssql_escape($d->clientOverview->orderNo)."',
						client_quote_no = '".mssql_escape($d->clientOverview->quoteNo)."',
						service_frequency = ".mssql_escape($d->clientOverview->serviceFrequency).",
						contract_duration = ".mssql_escape($d->clientOverview->contractDuration).",
						service_start_date = '".mssql_escape($d->clientOverview->serviceDate)."',
						sap_quote_no = '".mssql_escape($d->clientOverview->sapQuoteNum)."',
						debtors_no = '".mssql_escape($d->clientOverview->debtorsNo)."',
						contract_code = '".mssql_escape($d->clientOverview->contractCode)."',
						j_number = '".mssql_escape($d->clientOverview->jNum)."',
						service_description = '".mssql_escape($d->descriptionOfService->detailDesSer)."',
						special_notes = '".mssql_escape($d->specialNotes->specialNotes)."',
						last_updated_by = ".$userId.",
						upd_date = CURRENT_TIMESTAMP
					WHERE id = {$d->clientOverview->quoteId}";
			doLog($SQL);
			crgExecMySql($SQL);
		} else {
			$SQL = "INSERT INTO quote (client_order_no,
										client_quote_no,
										service_frequency,
										contract_duration,
										service_start_date,
										site_quoted,
										sap_quote_no,
										debtors_no,
										contract_code,
										j_number,
										service_description, 
										special_notes,
										created_by)
					VALUES ('".mssql_escape($d->clientOverview->orderNo)."',
							'".mssql_escape($d->clientOverview->quoteNo)."',
							".mssql_escape($d->clientOverview->serviceFrequency).",
							".mssql_escape($d->clientOverview->contractDuration).",
							'".mssql_escape($d->clientOverview->serviceDate)."',
							".mssql_escape($d->clientOverview->siteId).",
							'".mssql_escape($d->clientOverview->sapQuoteNum)."',
							'".mssql_escape($d->clientOverview->debtorsNo)."',
							'".mssql_escape($d->clientOverview->contractCode)."',
							'".mssql_escape($d->clientOverview->jNum)."',
							'".mssql_escape($d->descriptionOfService->detailDesSer)."',
							'".mssql_escape($d->specialNotes->specialNotes)."',
							".$userId.")";
			doLog($SQL);
			crgExecMySql($SQL);
			$retArr["quoteId"] = lastInsertedId();

			$updateSQL = "UPDATE quote SET quote_number =  CONCAT('CLN', LPAD(id, 7, 0)) WHERE id = " . $retArr["quoteId"];
			doLog($updateSQL);
			crgExecMySql($updateSQL);
		}
	}

    crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}

echo json_encode($retArr);


?>