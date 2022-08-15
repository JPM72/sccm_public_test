<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$logFile = 'postCustomerSiteContactDetails';
$retArr["status"] = "Success";

if (isset($_POST["contactDetails"])) {
	$contactDetails = $_POST["contactDetails"];
	doLog(print_r($contactDetails, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"] = "contactDetails not in POST parameter.";
	echo json_encode($retArr);
	exit;
};

try {
	$SQL = "SELECT 
				contact_person1_designation AS contactDetails_designation, 
				contact_person1_email AS contactDetails_email, 
				contact_person1_name AS contactDetails_name, 
				contact_person1_tel AS contactDetails_telNo, 
				domcilium_address AS contactDetails_postalAddress, 
				fax_number AS contactDetails_faxNo, 
				vat_number AS contactDetails_vatNo 
			FROM supercare2Dev.contact_details 
			WHERE id = $contactDetails  
			LIMIT 30";
	$retArr["data"] = crgMySqlgetRowArr($SQL);
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr);
?>
