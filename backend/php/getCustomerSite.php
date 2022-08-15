<?php
require_once("libs/crgHeaders.php");

require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getCustomerSite';
$retArr["status"] = "Success";

if (isset($_POST["customerId"])) {
	$customerId = $_POST["customerId"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]="customerId not in POST parameter.";
	echo json_encode($retArr);
	exit;
};

if (isset($_POST["siteName"])) {
	$siteName = $_POST["siteName"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]="siteName not in POST parameter.";
	echo json_encode($retArr);
	exit;
};

try {
	$searchString = [" ", "'"];
	$replaceString = ["%", "\'"];
	$nameReplace = str_replace($searchString, $replaceString, $siteName);
	$SQL = "SELECT CS.id, 
				CS.name, 
				CS.code, 
				CONCAT(A.address_line_1, ' ', A.address_line_2, ' ', A.city, ' ', A.postal_code, ' ', A.province) serviceAddress, 
				CD.domcilium_address AS postalAddress,
				'' physicalAddress,
				'' payBillingAddress,
				CD.vat_number AS accVatNo,
				CD.contact_person1_name AS serDelName, 
				CD.contact_person1_email AS serDelEmail, 	
				CD.contact_person1_tel AS serDelTelNo, 
				'' serDelCellNo,
				CD.fax_number AS serDelFaxNo
			FROM $scDbName.customer C
			JOIN $scDbName.customer_site CS ON C.id = CS.customer_id
			JOIN $scDbName.address A ON CS.address_id = A.id
			JOIN $scDbName.contact_details CD ON CS.contact_details_id = CD.id
			WHERE C.id = $customerId
			AND CS.name LIKE '%$siteName%'
			UNION
			SELECT CSQ.id, 
				CSQ.site_name, 
				IFNULL(CSQ.site_code, 'no contract code:'),
				IFNULL(AQS.address_name, '') serviceAddress,
				IFNULL(AQP.address_name, '') postalAddress,
				IFNULL(AQPH.address_name, '') physicalAddress,
				IFNULL(AQB.address_name, '') payBillingAddress,
				CSQ.vat_number,
				CSQ.contact_person,
				CSQ.email_address, 
				CSQ.tel_number, 
				CSQ.cell_number, 
				CSQ.fax_number
			FROM customer_quoted CQ
			JOIN customer_site_quoted CSQ ON CQ.id = CSQ.customer_id
			LEFT JOIN address_quoted AQS ON AQS.site_quoted = CSQ.id
			AND AQS.address_type = 1
			LEFT JOIN address_quoted AQP ON AQP.site_quoted = CSQ.id
			AND AQP.address_type = 2
			LEFT JOIN address_quoted AQPH ON AQPH.site_quoted = CSQ.id
			AND AQPH.address_type = 4
			LEFT JOIN address_quoted AQB ON AQB.site_quoted = CSQ.id
			AND AQB.address_type = 3
			WHERE CQ.id = $customerId
			AND CSQ.site_name LIKE '%$siteName%'
			UNION
			SELECT CS.id, 
				CS.name, 
				CS.code, 
				CONCAT(A.address_line_1, ' ', A.address_line_2, ' ', A.city, ' ', A.postal_code, ' ', A.province) serviceAddress, 
				CD.domcilium_address AS postalAddress,
				'' physicalAddress,
				'' payBillingAddress,
				CD.vat_number AS accVatNo,
				CD.contact_person1_name AS serDelName, 
				CD.contact_person1_email AS serDelEmail, 	
				CD.contact_person1_tel AS serDelTelNo, 
				'' serDelCellNo,
				CD.fax_number AS serDelFaxNo
			FROM customer_quoted CQ
			JOIN $scDbName.customer C On C.id = CQ.customer_id
			JOIN $scDbName.customer_site CS on C.id = CS.customer_id
			JOIN $scDbName.address A ON CS.address_id = A.id
			JOIN $scDbName.contact_details CD ON CS.contact_details_id = CD.id
			LEFT JOIN customer_site_quoted CSQ on CQ.id = CSQ.customer_id
			WHERE CQ.id = $customerId
			AND CS.name LIKE '%$siteName%'
			AND CSQ.id IS NULL
			LIMIT 10";
			doLog($SQL);
			$retArr["data"] = crgMySqlgetRowArr($SQL);
	
	// if (sizeof($retArr["data"]) == 0) {
	// 	$SQL = "SELECT * FROM $scDbName.customer_site 
	// 	 		WHERE customer_id = $customerId 
	// 	 		AND name LIKE '%$siteName%' 
	// 	 		ORDER BY name 
	// 	 		LIMIT 10";
	// 	doLog($SQL);		
	// 	$retArr["data"] = crgMySqlgetRowArr($SQL);
	// };
	
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr);

	// $SQL = "SELECT * FROM $scDbName.customer_site 
	// 		WHERE customer_id = $customerId 
	// 		AND name LIKE '%$siteName%' 
	// 		ORDER BY name 
	// 		LIMIT 10";

	// $SQL = "SELECT site_name name, IFNULL(site_code, 'no contracts:') code, id, customer_id 
	// 		FROM customer_site_quoted 
	// 		WHERE customer_id = $customerId 
	// 		AND site_name LIKE '%$siteName%' 
	// 		ORDER BY name 
	// 		LIMIT 10";


?>
