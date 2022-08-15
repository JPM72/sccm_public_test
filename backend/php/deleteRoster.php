<?php
require_once('libs/crgHeaders.php');
require_once('libs/crgMySqlLibLocal.php');
require_once("libs/crgCommonLib.php");
$logfile = "postRoster";


// file_put_contents($logfile, print_r($_POST,true).PHP_EOL, FILE_APPEND);
doLog(print_r($_POST,true));

$Id = $_POST['Id'];
$SQL = "UPDATE rosters SET isActive = false WHERE Id = $Id";
// file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
doLog($SQL);
crgExecMySql($SQL);

// History
$SQL = "SELECT * FROM rosters WHERE quote_id = 1"; // Get actual quote_id and then loop through all and insert
$SQL = "UPDATE roster_history SET isActive = false WHERE roster_id = $Id";
// file_put_contents($logfile, $SQL.PHP_EOL, FILE_APPEND);
doLog($SQL);
crgExecMySql($SQL);
crgCommitMySql();

$retArr['status'] = 'Success';

echo json_encode($retArr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
