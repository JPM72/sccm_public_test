<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'postComponents';

if (isset($_POST)) { 
	$d = $_POST;
	doLog(print_r($d, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "data not in POST parameter";
	echo json_encode($retArr);
	exit;
}

try {
	//check if customer exists in table
	if(isset($d['quote_id'])){
		$quoteId = $d['quote_id'];
		$SQL = "SELECT id FROM executive_summary WHERE quote = $quoteId";
		doLog($SQL);
		$returnComponentRows = crgMySqlgetRowArr($SQL);
		if (sizeof($returnComponentRows) > 0) {
			// Update
			doLog("Updating");
			$SQL = "
				UPDATE 
					executive_summary
				SET
					labour = ".$d['ntSummary'].",
					overtime = ".$d['otSummary'].",
					public_holidays = ".$d['phSummary'].",
					supervision = ".$d['superSummary'].",
					equipment = ".$d['equipmentSummary'].",
					equipment_repairs = ".$d['repairsSummary'].",
					loose_equipment = ".$d['looseSummary'].",
					transport = ".$d['transportSummary'].",
					chemicals = ".$d['chemicalsSummary'].",
					uniforms = ".$d['uniformSummary'].",
					consumables = ".$d['consumablesSummary'].",
					sub_cont_int = ".$d['subcontIntSummary'].",
					sub_cont_ext = ".$d['subcontExtSummary'].",
					other_cont = ".$d['otherContractCost'].",
					overheads = ".$d['overheadsRecovSummary'].",
					management_fee = ".$d['managementFeeSummary']
			;
			doLog($SQL);
			crgExecMySql($SQL);
		} else {
			doLog("Need to insert");
			$insertSQL = "
				INSERT INTO executive_summary (
					quote,
					labour, 
					overtime, 
					public_holidays, 
					supervision, 
					equipment,  
					equipment_repairs,  
					loose_equipment, 
					transport, 
					chemicals, 
					uniforms, 
					consumables, 
					sub_cont_int,
					sub_cont_ext,
					other_cont, 
					overheads, 
					management_fee
				) VALUES (
					$quoteId,
					".$d['ntSummary'].", 
					".$d['otSummary'].", 
					".$d['phSummary'].", 
					".$d['superSummary'].", 
					".$d['equipmentSummary'].",  
					".$d['repairsSummary'].",  
					".$d['looseSummary'].", 
					".$d['transportSummary'].", 
					".$d['chemicalsSummary'].", 
					".$d['uniformSummary'].",  
					".$d['consumablesSummary'].", 
					".$d['subcontIntSummary'].",
					".$d['subcontExtSummary'].",
					".$d['otherContractCost'].", 
					".$d['overheadsRecovSummary'].", 
					".$d['managementFeeSummary']."
				)";
			doLog($insertSQL);
			crgExecMySql($insertSQL);
		}

		crgCommitMySql();
	}
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}

echo json_encode($retArr);




?>