<?php

$date=date("Y-m-d H:i:s") ;
// $logDir = "/tmp/";

require_once __DIR__.'/../config.php';


function doLog($txt) {
    global $date;
    global $logFile;
    global $logDir;
    $logFilePtr = fopen($logDir.$logFile.".log", "a+");
        fwrite($logFilePtr, $date);
        fwrite($logFilePtr, " : ");
        fwrite($logFilePtr, $txt);
        fwrite($logFilePtr, "\n");
        fclose($logFilePtr);
};


function mssql_escape($unsafe_str) {
    // if (get_magic_quotes_gpc()) {
    $unsafe_str = trim($unsafe_str);
    $unsafe_str = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $unsafe_str);
    $unsafe_str = stripslashes($unsafe_str);
    // }
    return $escaped_str = str_replace("'", "''", $unsafe_str);
}
?>