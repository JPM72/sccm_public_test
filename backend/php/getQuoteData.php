<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = 'getQuoteData';
$retArr["status"] = "Success";

if (isset($_POST["quoteId"])) { 
	$quoteId = $_POST["quoteId"];
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]="quoteId not in POST parameter.";
	echo json_encode($retArr);
	exit;
};


try { 
	$SQL = "SELECT quote_number,
	CQ.id AS newCustomerId,
	CQ.customer_id AS companyId,
	CQ.customer_name AS companyName,
	CQ.customer_name AS payCompName,
	CQ.customer_code AS companyCode,
	CQ.registration_number AS accRegNo,
	CQ.client_industry AS clientIndustry,
	CSQ.id AS siteId,
	CSQ.site_name AS siteName,
	CSQ.site_id AS siteId,
	CSQ.site_code AS siteCode,
	CSQ.vat_number AS accVatNo,
	CSQ.contact_person AS serDelName,
	CSQ.email_address AS serDelEmail,
	CSQ.tel_number AS serDelTelNo,
	CSQ.cell_number AS serDelCellNo,
	CSQ.fax_number AS serDelFaxNo,
	client_order_no AS orderNo,
	client_quote_no AS quoteNo,
	service_frequency AS serviceFrequency,
	contract_duration AS contractDuration,
	Q.id AS quoteId,
	Q.site_quoted AS siteId,
	Q.regional_manager_approved AS regionalManagerApproved,
	Q.regional_director_approved AS regionalDirectorApproved,
	Q.manager_director_approved AS managerDirectorApproved,
	Q.template,
	service_start_date AS serviceDate,
	sap_quote_no As sapQuoteNum,
	debtors_no AS debtorsNo,
	contract_code AS contractCode,
	j_number AS jNum,
	profit_center AS profitCenterDataSheet,
	service_description AS detailDesSer,
	special_notes AS specialNotes,
	sales_org AS salesOrg,
	sales_division AS salesDivision,
	region AS region,
	sales_district AS salesDistrict,
	sales_district_sap AS salesDistrictSap,
	sales_exec_code AS salesExecCode,
	sales_exec_name AS salesExecName,
	area_manager_code AS salesGrp,
	area_manager_name AS areaManagerName,
	profit_center AS profitCenter,
	regional_manager_name AS regManName,
	client_order_date AS poDate,
	valid_from AS validFrom,
	CO.id,
	CO.name AS contactPerson,
	CO.designation AS designation,
	CO.email AS email,
	CO.fax_number AS faxNo,
	CO.cell_number AS cellNo,
	CDM.name AS clientName,
	CDM.email AS clientEmail,
	CDM.fax_number AS clientFaxNo,
	CDM.tel_number AS clientTelNo,
	CDM.cell_number AS clientCellNo,
	CAD.name AS accContactName,
	CAD.email AS accEmailAddress,
	CAD.fax_number AS accFaxNo,
	CAD.tel_number AS accTelNo,
	CAD.cell_number AS accCellNo,
	CCRP.name AS payName,
	CCRP.email AS payEmail,
	CCRP.fax_number AS payFaxNo,
	CCRP.tel_number AS payTelNo,
	CCRP.cell_number AS payCellNo,
	AQS.address_name AS serviceAddress,
	AQPO.address_name AS postalAddress,
	AQB.address_name AS payBillingAddress,
	AQP.address_name AS physicalAddress
	FROM quote Q
	LEFT JOIN customer_site_quoted CSQ ON CSQ.id = Q.site_quoted
	LEFT JOIN customer_quoted CQ ON CQ.id = CSQ.customer_id
	LEFT JOIN service_frequency SF ON SF.id = Q.service_frequency
	LEFT JOIN contract_duration CD ON CD.id = Q.contract_duration
	LEFT JOIN contact CO ON CO.quote_id = Q.id AND CO.contact_type = 1
	LEFT JOIN contact CDM ON CDM.quote_id = Q.id AND CDM.contact_type = 2
	LEFT JOIN contact CAD ON CAD.quote_id = Q.id AND CAD.contact_type = 3
	LEFT JOIN contact CCRP ON CCRP.quote_id = Q.id AND CCRP.contact_type = 4
	LEFT JOIN contact_type CT ON CT.id = CO.contact_type
	LEFT JOIN address_quoted AQS ON AQS.site_quoted = CSQ.id AND AQS.address_type = 1
	LEFT JOIN address_quoted AQPO ON AQPO.site_quoted = CSQ.id AND AQPO.address_type = 2
	LEFT JOIN address_quoted AQB ON AQB.site_quoted = CSQ.id AND AQB.address_type = 3
	LEFT JOIN address_quoted AQP ON AQP.site_quoted = CSQ.id AND AQP.address_type = 4
	WHERE Q.id = $quoteId";
	doLog($SQL);
	$retArr["data"] = crgMySqlgetRow($SQL);
	
	$SQL = "SELECT 
		Name,
		Id,
		uid,
		type rosterType,
		startDate,
		service,
		tabledata,
		costSheet,
		isActive
	FROM rosters
	WHERE quote_id = $quoteId
	AND isActive = true";
	doLog($SQL);
	$retArr["data"]["rosters"] = crgMySqlgetRowArr($SQL);

    foreach ($retArr["data"]["rosters"] as $key => $roster) {
		// doLog($roster);
        $roster['costSheet'] = json_decode($roster['costSheet']);
        $roster['tabledata'] = json_decode($roster['tabledata']);
        $retArr["data"]["rosters"][$key] = $roster;
    }
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr, JSON_PRETTY_PRINT);
?>