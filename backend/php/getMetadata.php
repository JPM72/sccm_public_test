<?php
require_once('libs/crgHeaders.php');
require_once('libs/crgMySqlLibLocal.php');

try {
    // Role
    $SQL = "
    SELECT * 
    FROM 
        role
    ";
    $retArr['roles'] = crgMySqlgetRowArr($SQL);

    // Role Rates
    $SQL = "
        SELECT * 
        FROM 
            role
        JOIN 
            role_rate 
        ON 
            role_rate.role = role.id
        WHERE 
            valid_till >= now()
        AND 
            valid_from <= now()
    ";
    $retArr['roleRates'] = crgMySqlgetRowArr($SQL);


    // Attributes
    $SQL = "SELECT Name, Value, Region, SalesDistrict, ValidTill FROM attributes WHERE ValidTill > CURDATE()";
    $retArr['attributes'] = crgMySqlgetRowArr($SQL);


    // Holidays
    $SQL = "
        SELECT 
            name, 
            REPLACE(SUBSTRING(holiday_date, 6, 5), '-', '/') date
        FROM 
            holidays
        WHERE 
            valid_till >= now()
        AND 
            valid_from <= now()
    ";
    $retArr['holidays'] = crgMySqlgetRowArr($SQL);


    // Region (Same as sales office)
    $SQL = "
        SELECT 
            region.Id, 
            RegionName Name, 
            attributes.Name AttributeName, 
            Value AttributeValue,
            region.Description,
            Address,
            PostalAddress,
            TelNum,
            Email,
            Website
        FROM 
            region
        LEFT JOIN 
            attributes 
        ON CASE WHEN attributes.validTill >= now() THEN attributes.region END = region.id 
    ";
    $retArr['region'] = crgMySqlgetRowArr($SQL);

    // Role Rate
    $SQL = "
        SELECT 
            Id, 
            rate 
        FROM 
            role_rate
        WHERE 
            valid_till >= now() AND valid_from <= now()
    ";
    $retArr['rate'] = crgMySqlgetRowArr($SQL);


    // Sales Division(service)
    $SQL = "
        SELECT Id, description Name, Name code, sales_org FROM sales_division WHERE is_active = true
    ";
    $retArr['service'] = crgMySqlgetRowArr($SQL);

    // Client Industry
    $SQL = "
        SELECT Id, description Name FROM client_industry
    ";
    $retArr['clientIndustry'] = crgMySqlgetRowArr($SQL);


    // Profit Center
    $SQL = "
        SELECT Id, name Name, sales_office region, sales_org, sales_division FROM profit_center
    ";
    $retArr['profitCenter'] = crgMySqlgetRowArr($SQL);


    // Sales Org
    $SQL = "
        SELECT Id, name Name FROM sales_org
    ";
    $retArr['salesOrg'] = crgMySqlgetRowArr($SQL);

    // Service Type
    $SQL = "SELECT * FROM service_type";
    $retArr['service_type'] = crgMySqlgetRowArr($SQL);

    // Labour Category (Maybe merge with service type?)
    $SQL = "SELECT * FROM job_titles";
    $retArr['job_titles'] = crgMySqlgetRowArr($SQL);

    // Service Frequency
    $SQL = "SELECT id, frequency FROM service_frequency ORDER BY id ASC";
    $retArr['service_frequency'] = crgMySqlgetRowArr($SQL);

    // Sales District
    $SQL = "SELECT Id, DistrictName Name FROM sales_district";
    $retArr['salesDistrict'] = crgMySqlgetRowArr($SQL);

    // Contract Duration
    $SQL = "SELECT id, duration FROM contract_duration ORDER BY id ASC";
    $retArr['contract_duration'] = crgMySqlgetRowArr($SQL);

    // Templates
    $SQL = "
        SELECT 
            template_name, 
            template, 
            template_description, 
            format_name,
            template_directory
        FROM 
            template 
        JOIN 
            document_format 
        ON 
            template.document_format = document_format.Id
    ";
    $retArr['templates'] = crgMySqlgetRowArr($SQL);


    $retArr['status'] = 'Success';
} catch (exception $e) {
    $retArr['status'] = 'Error';
    print_r($e, true);  
}

echo json_encode($retArr, JSON_PRETTY_PRINT);