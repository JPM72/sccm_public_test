<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getCustomer';
$name="";
$retArr["status"] = "Success";

if (isset($_POST["name"])) { 
	$name = $_POST["name"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]="name not in POST parameter.";
	echo json_encode($retArr);
	exit;
};


try {
	$searchString = [" ", "'"];
	$replaceString = ["%", "\'"];
	$nameReplace = str_replace($searchString, $replaceString, $name);
	$SQL = "SELECT 1 part, IFNULL(CQ.id, C.id) id, code, name, registration_number, C.id customer_id, CQ.client_industry
			FROM $scDbName.customer C
			LEFT JOIN customer_quoted CQ ON C.id = CQ.customer_id
			WHERE name like '%".$nameReplace."%'
			OR code like '%".$nameReplace."%'
			LIMIT 30";
	doLog($SQL);
	$retArr["data"] = crgMySqlgetRowArr($SQL);
	
	if (sizeof($retArr["data"]) == 0) {
		$SQL = "SELECT 2 part, customer_name name, IFNULL(customer_code, 'no contract code:') code, id, registration_number, NULL customer_id, client_industry
				FROM customer_quoted 
				WHERE customer_name like '%".$nameReplace."%'
				OR customer_code like '%".$nameReplace."%' 
				LIMIT 30";
		doLog($SQL);	
		$retArr["data"] = crgMySqlgetRowArr($SQL);
	};
	
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr);
?>

