<?php
require_once('libs/crgHeaders.php');
require_once('libs/crgMySqlLibLocal.php');
$logFile = 'postRoster';
require_once("libs/crgCommonLib.php");

try {
    if(isset($_POST['quoteId'])){
        $quoteId = $_POST['quoteId'];
    } else {
        $quoteId = 999;
    }
    doLog(print_r($_POST,true));

    // if(isset($_POST['totalContractPrice'])){
    //     $totalContractPrice = $_POST['totalContractPrice'];
    //     $SQL = "UPDATE quote set total_contract_price = '$totalContractPrice' WHERE id = $quoteId";
    //     doLog($SQL);
    //     crgExecMySql($SQL);
    // }

    if(isset($_POST['totalCont'])){
        $serviceDate = $_POST['serviceDate'];
        $SQL = "UPDATE quote set service_start_date = '$serviceDate'";
        doLog($SQL);
        crgExecMySql($SQL);
    }

    if(isset($_POST['template'])){
        $template = $_POST['template'];
        $SQL = "UPDATE quote set template = '$template'";
        doLog($SQL);
        crgExecMySql($SQL);
    }

    if(isset($_POST['salesOffice'])){
        $salesOffice = json_decode($_POST['salesOffice']);


        if(!empty($salesOffice->salesOrg)){
            $salesOrg = $salesOffice->salesOrg;
            $SQL = "UPDATE quote set sales_org = $salesOrg WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesDivision)){
            $salesDivision = $salesOffice->salesDivision;
            $SQL = "UPDATE quote set sales_division = $salesDivision WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->region)){
            $region = $salesOffice->region;
            $SQL = "UPDATE quote set region = $region WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesDistrict)){
            $salesDistrict = $salesOffice->salesDistrict;
            $SQL = "UPDATE quote set sales_district = $salesDistrict WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesExecCode)){
            $salesExecCode = $salesOffice->salesExecCode;
            $SQL = "UPDATE quote set sales_exec_code = '$salesExecCode' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesExecName)){
            $salesExecName = $salesOffice->salesExecName;
            $SQL = "UPDATE quote set sales_exec_name = '$salesExecName' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesGrp)){
            $salesGrp = $salesOffice->salesGrp;
            $SQL = "UPDATE quote set area_manager_code = '$salesGrp' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->areaManagerName)){
            $areaManagerName = $salesOffice->areaManagerName;
            $SQL = "UPDATE quote set area_manager_name = '$areaManagerName' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->profitCenter)){
            $profitCenter = $salesOffice->profitCenter;
            $SQL = "UPDATE quote set profit_center = '$profitCenter' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->regManName)){
            $regManName = $salesOffice->regManName;
            $SQL = "UPDATE quote set regional_manager_name = '$regManName' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->poDate)){
            $poDate = $salesOffice->poDate;
            $SQL = "UPDATE quote set client_order_date = '$poDate' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->validFrom)){
            $validFrom = $salesOffice->validFrom;
            $SQL = "UPDATE quote set valid_from = '$validFrom' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }
        if(!empty($salesOffice->salesDistrictSap)){
            $salesDistrictSap = $salesOffice->salesDistrictSap;
            $SQL = "UPDATE quote set sales_district_sap = '$salesDistrictSap' WHERE id = $quoteId";
            doLog($SQL);
            crgExecMySql($SQL);
        }


    };

    // First inactivate all rosters
    $SQL = "UPDATE rosters SET isActive = false WHERE quote_id = $quoteId";
    doLog($SQL);
    crgExecMySql($SQL);
    if(isset($_POST['rosters'])){
        $rosters = $_POST['rosters'];
    } else {
        $rosters = array();
    }
    foreach((array)$rosters as $roster){
        doLog(print_r($roster,true));

        if(isset($roster['costSheet'])){
            $costSheet = $roster['costSheet'];
        } else {
            $costSheet = "";
        }

        $rosterName = "OO_" . str_replace(" ","",$roster['service']) . time(); // May need to clean up
        $SQL = "
            INSERT INTO rosters 
                (Name, uid, type, tabledata, costSheet, Service, StartDate, CreateDate, quote_id, isActive) 
            VALUES 
                ('$rosterName', '$roster[uid]','$roster[rosterType]', '$roster[tabledata]', '$costSheet', '$roster[service]', '$roster[startDate]',  NOW(), $quoteId, true)
        ";
        doLog($SQL);
        crgExecMySql($SQL);
    }
    crgCommitMySql();
    $retArr['status'] = 'Success';

    
} catch (exception $e) {
    $retArr['status'] = 'Error';
    print_r($e, true);  
}
// Warning: Undefined array key "costSheet" in /var/www/html/marco/SupercareCostingModel/backend/php/postRosters.php on line 126
echo json_encode($retArr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);