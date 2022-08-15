<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'setNewCustomer';

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
	$insertSQL = "INSERT INTO customer_quoted (customer_name, registration_number, client_industry) 
					VALUES ('".mssql_escape($d->newCustomer->newCustomerName)."', '".mssql_escape($d->newCustomer->newRegistrationNumber)."', '".$d->newCustomer->newClientIndustry."')";
	doLog($insertSQL);
	crgExecMySql($insertSQL);
	$retArr["lastInsertedId"] = lastInsertedId();
	$retArr["newCustomerName"] = $d->newCustomer->newCustomerName;
	$retArr["newRegistrationNumber"] = $d->newCustomer->newRegistrationNumber;
	$retArr["newClientIndustry"] = $d->newCustomer->newClientIndustry;
	crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}
echo json_encode($retArr);



?>