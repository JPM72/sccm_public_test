<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'approveQuote';

$retArr["status"] = "Success";

doLog("test".PHP_EOL);

if(isset($_POST['quoteId']) && isset($_POST['approvedBy']) && isset($_POST['userId'])){
	$quoteId = $_POST['quoteId'];
	$approvedBy = $_POST['approvedBy'];
	$userId = $_POST['userId'];

	if($approvedBy == "Regional Manager"){
		$managerTypeCol = "regional_manager_approved";
	}
	if($approvedBy == "Regional Dir/Gen Manager"){
		$managerTypeCol = "regional_director_approved";
	}
	if($approvedBy == "Manager Director"){
		$managerTypeCol = "manager_director_approved";
	}
	$managerTypeColDate = $managerTypeCol."_date";



	try {
		doLog(json_encode($_POST));

		$updateSQL = "
			UPDATE quote 
			SET 
				$managerTypeCol = $userId,
				$managerTypeColDate = now()
			WHERE id = $quoteId; 
		";
		doLog($updateSQL);
		crgExecMySql($updateSQL);


		crgCommitMySql();

		$retArr["message"] = $approvedBy." Approved";


	} catch (exception $e) {
		$retArr["status"] = "Error";
		$retArr["description"] = print_r($e, true);
	};
} else {
	$retArr["status"] = "Error";
	$retArr["message"] = "Missing values";
}



echo json_encode($retArr, JSON_PRETTY_PRINT);
?>