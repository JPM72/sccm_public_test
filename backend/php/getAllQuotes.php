<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getAllQuotes';
$retArr["status"] = "Success";

try {
	$SQL = "
        SELECT 
            CONCAT(U.first_name,' ',U.surname) sales_rep,
            Q.id,
            CS.site_name AS site_name, 
            quote_number,
            sap_quote_no,
            R.RegionName AS region,
            CASE WHEN sap_quote_no = '' OR sap_quote_no IS NULL THEN 'Active' ELSE 'Finalised' END AS status,
            CONCAT('R', ' ', FORMAT(total_contract_price, 2, 'en-ZA')) AS total_contract_price,
            sales_stage,
            present_date,
            award_date,
            start_date
        FROM quote Q
        LEFT JOIN customer_site_quoted CS ON CS.id = Q.site_quoted
        LEFT JOIN region R ON R.id = Q.region
        LEFT JOIN $scDbName.user U ON Q.created_by = U.id
    ";
	// doLog($SQL);
    $retArr["data"] = crgMySqlgetRowArr($SQL);  
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr);
?>