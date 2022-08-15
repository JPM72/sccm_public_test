<?php

    // Set headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Methods: POST");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

    // Include db handler
    include("crgMySqlLib.php");
	include("config.php");


    $salesStage = $_POST["salesStage"];
    $presentDate = $_POST["presentDate"];
    $awardDate = $_POST["awardDate"];
    $startDate = $_POST["startDate"];
    $quoteNumber = $_POST["quoteNumber"];
    $user = $_POST["user"];

	

    // Query to update record in consumables_quote table
    $query = "UPDATE quote SET sales_stage = ?, 
                                       present_date = ?, 
                                       award_date = ?,
                                       start_date = ?
                                   WHERE quote_number = ?";
    crgExecMySql($query, [$salesStage, $presentDate, $awardDate, $startDate, $quoteNumber]);

    $rows = crgMySqlAffectedRows();
    crgCommitMySql();

    // Return a message if update was successfull or not
    if($rows == 0){
        echo json_encode(array("message" => "Record could not be Updated"));
    }
    else{
        echo json_encode(array("message" => "Record Updated"));
    }


?>