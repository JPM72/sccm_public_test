<?php
 // Set headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header("Access-Control-Allow-Methods: POST");
 header("Allow: GET, POST, OPTIONS, PUT, DELETE");
 header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

require_once("backend/php/config.php");

if(isset($_POST)){$postRequest=$_POST;}else{} 

$cURLConnection = curl_init('http://empactgw.qflo.co.za/SAPR3/5.6/CostingModel'.$env.'/ZSD_COSTING_UPLOAD.php');

curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);


echo $apiResponse;
?>