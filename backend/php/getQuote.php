<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getQuote';
$retArr["status"] = "Success";

if (isset($_POST["siteId"])) { 
	$siteId = $_POST["siteId"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]="siteId not in POST parameter.";
	echo json_encode($retArr);
	exit;
};


try {
	$SQL = "SELECT 	Q.id,
					quote_number,
					sap_quote_no,
					client_order_no,
					client_quote_no,
					CONCAT(UC.first_name, ' ', UC.surname) created_by, 
					CONCAT(UL.first_name, ' ', UL.surname) last_updated_by
				FROM quote Q
				LEFT JOIN $scDbName.user UC ON UC.id = Q.created_by 
				LEFT JOIN $scDbName.user UL ON UL.id = Q.last_updated_by
				WHERE site_quoted = $siteId";
	doLog($SQL);
	$returnQuoteRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnQuoteRows) > 0) {
		$retArr["data"] = $returnQuoteRows;
	}
	
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr);
?>