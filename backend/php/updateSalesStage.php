<?php

    // Set headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Methods: POST");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");


error_reporting(-1);
ini_set("html_errors", 1);
ini_set("display_startup_errors", 1);
ini_set("log_errors", 1);
ini_set("display_errors", 1);
ini_set("track_errors",1);
ini_set("report_memleaks",1);


    // Include db handler
    include("libs/crgMySqlLibLocal.php");
    include("config.php");
    // doLog(print_r($_POST, true));

    $salesStage = $_POST["salesStage"];
    $presentDate = $_POST["presentDate"];
    $awardDate = $_POST["awardDate"];
    $startDate = $_POST["startDate"];
    $quoteNumber = $_POST["quoteNumber"];
    $user = $_POST["user"];
    $rows = 0;
    // Query to update record in hygiene_quote table
    $query = "UPDATE sc_costingmodel.quote SET sales_stage = ?, 
                                       present_date = ?, 
                                       award_date = ?,
                                       start_date = ?
                                   WHERE quote_number = ?";
								 
		
try {			 
crgExecMySql($query, [nullIfBlank($salesStage), nullIfBlank($presentDate), nullIfBlank($awardDate), nullIfBlank($startDate), nullIfBlank($quoteNumber)]);

    $rows = crgMySqlAffectedRows();
    crgCommitMySql();

    // Return a message if update was successfull or not
    if($rows == 0){
        echo json_encode(array("message" => "Record could not be Updated"));
    }
    else{
        echo json_encode(array("message" => "Record Updated"));
    }

}

//catch exception
catch(Exception $e) {
  //echo 'Message: ' .$e->getMessage();
  echo json_encode(array("Error" => $e->getMessage()));
}



?>