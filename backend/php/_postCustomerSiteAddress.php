<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'postCustomerSiteAddress';
$retArr["status"] = "Success";

if (isset($_POST["addressId"])) {
	$addressId = $_POST["addressId"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "addressId not in POST parameter.";
};

if (isset($_POST["customerId"])) {
	$customerId = $_POST["customerId"];
} else {
	$retArr["status"] = "Error";
	$retArr["description"]= "customerId not in POST parameter.";
	echo json_encode($retArr);
};

if (isset($_POST["siteName"])) {
	$siteName = $_POST["siteName"];
} else {
	$retArr["status"] = "Error";
	$retArr["description"]= "siteName not in POST parameter.";
	echo json_encode($retArr);
};

try {
	$SQL = "SELECT * FROM $scDbName.address 
			WHERE id = $addressId
			LIMIT 30";
	doLog($SQL);
	$retArr["data"] = crgMySqlgetRowArr($SQL);
		
	if (sizeof($retArr["data"]) == 0) {
			$SQL = "SELECT  
					service_address AS serviceAddress_physicalAddress,
					contact_person AS contactDetails_name,
					email_address AS contactDetails_email,
					tel_number AS contactDetails_telNo,
					cell_number AS contactDetails_cellNo,
					fax_number AS contactDetails_faxNo
					FROM customer_site_quoted 
					WHERE customer_id = $customerId 
					AND site_name LIKE '%$siteName%' 
					ORDER BY site_name 
					LIMIT 10";
			doLog($SQL);		
			$retArr["data"] = crgMySqlgetRowArr($SQL);
		}

} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
}

echo json_encode($retArr);
?>

