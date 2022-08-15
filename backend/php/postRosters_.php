<?php
require_once('libs/crgHeaders.php');
require_once('libs/crgMySqlLibLocal.php');
$logfile = "/tmp/postRoster.log";

try {
    if(isset($_POST['quoteId'])){
        $quoteId = $_POST['quoteId'];
    } else {
        $quoteId = 999;
    }
    foreach($_POST['rosters'] as $roster){
        file_put_contents($logfile, print_r($roster,true).PHP_EOL, FILE_APPEND);

        if(isset($roster['Id'])){
            file_put_contents($logfile, "ROSTER MUST UPDATE ".PHP_EOL, FILE_APPEND);
            file_put_contents($logfile, "This is the roster Id ".$roster['Id'].PHP_EOL, FILE_APPEND);
            // Rosters
            $SQL = "
                UPDATE 
                    rosters 
                SET
                    Service = '$roster[service]',
                    StartDate = '$roster[startDate]',
                    tabledata = '$roster[tabledata]',
                    costSheet = '$roster[costSheet]'
                WHERE
                    Id = $roster[Id]
            ";
            file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
            crgExecMySql($SQL);


            // Roster History
            $SQL = "
                INSERT INTO roster_history 
                    (Name, tabledata, costSheet, Service, StartDate, CreateDate, roster_id, isActive) 
                VALUES 
                    ('$rosterName', '$roster[tabledata]', '$roster[costSheet]', '$roster[service]', '$roster[startDate]',  CURDATE(), $roster[Id], true)
            ";
            file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
            crgExecMySql($SQL);

        } else {
            file_put_contents($logfile, "ROSTER MUST INSERT ".PHP_EOL, FILE_APPEND);
            $rosterName = "OO_" . str_replace(" ","",$roster['service']) . time(); // May need to clean up
            file_put_contents($logfile, $rosterName.PHP_EOL, FILE_APPEND);
            $SQL = "
                INSERT INTO rosters 
                    (Name, tabledata, costSheet, Service, StartDate, CreateDate, quote_id, isActive) 
                VALUES 
                    ('$rosterName', '$roster[tabledata]', '$roster[costSheet]', '$roster[service]', '$roster[startDate]',  CURDATE(), $quoteId, true)
            ";
            file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
            crgExecMySql($SQL);

            // Roster History
            $roster_id = lastInsertedId();
            $SQL = "
                INSERT INTO roster_history 
                    (Name, tabledata, costSheet, Service, StartDate, CreateDate, roster_id, isActive) 
                VALUES 
                    ('$rosterName', '$roster[tabledata]', '$roster[costSheet]', '$roster[service]', '$roster[startDate]',  CURDATE(), $roster_id, true)
            ";
            file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
            crgExecMySql($SQL);

        }


        crgCommitMySql();

        $retArr['status'] = 'Success';

    }

    
} catch (exception $e) {
    $retArr['status'] = 'Error';
    print_r($e, true);  
}

echo json_encode($retArr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
