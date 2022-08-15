<?php

include('config.php');

global $dbName;

if(isset($dbName)) {;} else {$dbName = $databaseName;}

$mysqli = new mysqli($server, $username, $password, $dbName);

if ($mysqli->connect_errno) {
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    //exit;
}

$mysqli->autocommit(FALSE);

$SqlCnt=0;

function crgCommitMySql() {
    global $mysqli,$SqlCnt;
    $mysqli->commit();
    $SqlCnt=0;
}

// function crgExecMySql($SQL) {
//     global $mysqli,$SqlCnt;
//     if (!$result = $mysqli->query($SQL)) {
//         echo "Error: Our query failed to execute and here is why: \n";
//         echo "Query: " . $SQL . "\n";
//         echo "Errno: " . $mysqli->errno . "\n";
//         echo "Error: " . $mysqli->error . "\n";
//         exit;
//     }
// $SqlCnt++;
// if ($SqlCnt%100==0){ $mysqli->commit();}
// }

function crgMySqlgetRowArr ($SQL) {
    global $mysqli,$SqlCnt;
    $result = $mysqli->query($SQL);
   // $rows = $result->fetch_array(MYSQLI_ASSOC);
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $rows[] = $row;
    }
//    print_r($rows);
    return $rows;
}

function isValueSet($var){
        if(strlen($var) >= 0) {
                return true;
        } else {
                return false;
        }
}

function crgMySqlAffectedRows(){
    global $mysqli;
    return $mysqli->affected_rows;
}

function getTypeofValues($valArr){
    $string = '';
    foreach($valArr as $value) {
            if(is_float($value)){
                    $string .= "d";
            }elseif(is_integer($value)){
                    $string .= "i";
            }elseif(is_string($value)){
                    $string .= "s";
            }else{
                    $string .= "b";
            }
    }
    return $string;
}

function crgExecMySql($SQL, $valArr=[]) {
    global $mysqli,$SqlCnt;
    $type = getTypeofValues($valArr);
    $stmt = $mysqli->prepare($SQL);
    if(count($valArr) > 0) {
            $stmt->bind_param($type, ...$valArr);
    }
    $stmt->execute();

    $result = $stmt->get_result();
    if($mysqli->errno) {
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $SQL . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            //exit;
    }
    $SqlCnt++;
    if ($SqlCnt%100==0){ $mysqli->commit();}
}

function nullIfBlank ($val){
	if($val==""){
		return null;
	} else {
		return $val;
	}
}



?>
