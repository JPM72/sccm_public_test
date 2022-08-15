<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getSalesDistriceSAP';

// $logFile = '/tmp/getSalesDistriceSAP.log';
$name="";
$retArr["status"] = "Success";





try {

	$SQL = "
		SELECT 
			BZIRK code, 
			BZTXT name
		FROM
			T171T
		WHERE
			UPDFLAG = 1
	";
	// file_put_contents($logFile, $SQL, FILE_APPEND);
	// doLog($SQL);
	$retArr['salesDistrict'] = crgMySqlgetRowArr($SQL);

	$SQL = "
		SELECT 
			'' name,
			VKBUR salesOffice, 
			VKGRP code,
			description
		FROM
			TVBVK
		WHERE
			UPDFLAG = 1
	";
	// file_put_contents($logFile, $SQL, FILE_APPEND);
	// doLog($SQL);

	$retArr['salesGrp'] = crgMySqlgetRowArr($SQL);
	
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr, JSON_PRETTY_PRINT);
?>