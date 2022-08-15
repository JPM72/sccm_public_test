<?php
require_once("config.php");
global $dbName;
global $serverName;
global $UID;
global $PWD;

if(isset($dbName)) {;} else {$dbName = 'sc_costingModel';}

$mysqli = new mysqli($serverName, $UID, $PWD, $dbName);

if ($mysqli->connect_errno) {
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
}

$mysqli->autocommit(FALSE);

$SqlCnt=0;

function crgCommitMySql() {
    global $mysqli,$SqlCnt;
    $mysqli->commit();
    $SqlCnt=0;
}

function crgRollbackMySql() {
    global $mysqli,$SqlCnt;
    $mysqli->rollback();
    $SqlCnt=0;
}

function crgExecMySql_($SQL) {
    global $mysqli,$SqlCnt;
    if (!$result = $mysqli->query($SQL)) {
        $retArr["status"] = "Error";
        $retArr["description"] = "Query: " . $SQL . "\n" . "Errno: " . $mysqli->errno . "\n" . "Error: " . $mysqli->error;
        echo json_encode($retArr);
        crgRollbackMySql();
    }
$SqlCnt++;
if ($SqlCnt%100==0){ $mysqli->commit();}
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
        $retArr["status"] = "Error";
        $retArr["description"] = "Query: " . $SQL . "\n" . "Errno: " . $mysqli->errno . "\n" . "Error: " . $mysqli->error;
       echo json_encode($retArr);
       crgRollbackMySql();
       exit();
    }
    //$SqlCnt++;
    //if ($SqlCnt%100==0){ $mysqli->commit();}
	
}

function crgMySqlgetRowArr ($SQL) {
    global $mysqli,$SqlCnt;
    $result = $mysqli->query($SQL);
   // $rows = $result->fetch_array(MYSQLI_ASSOC);
   if($mysqli->errno) {
        $retArr["status"] = "Error";
        $retArr["description"] = "Query: " . $SQL . "\n" . "Errno: " . $mysqli->errno . "\n" . "Error: " . $mysqli->error;
       echo json_encode($retArr);
       crgRollbackMySql();
       exit();
    }
   $rows = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $rows[] = $row;
    }

    if (empty($rows)) {
        $retArr["status"] = "Success";
        $retArr["description"] = "no rows returned";

    };
    return $rows;
//    print_r($rows);  
};

function crgMySqlgetRow ($SQL) {
    global $mysqli,$SqlCnt;
    $result = $mysqli->query($SQL);
   // $rows = $result->fetch_array(MYSQLI_ASSOC);
   if($mysqli->errno) {
        $retArr["status"] = "Error";
        $retArr["description"] = "Query: " . $SQL . "\n" . "Errno: " . $mysqli->errno . "\n" . "Error: " . $mysqli->error;
       echo json_encode($retArr);
       crgRollbackMySql();
       exit();
    }
   $rows = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        return $row;
    }

    if (empty($rows)) {
        $retArr["status"] = "Success";
        $retArr["description"] = "no rows returned";

    };
    return $rows;
//    print_r($rows);  
};

function isValueSet($var){
        if(strlen($var) >= 0) {
                return true;
        } else {
                return false;
        };
};

function lastInsertedId() {
    global $mysqli;
    if (!$result = $mysqli->insert_id) {
        $retArr["status"] = "Error";
        $retArr["description"] = "Query: lastInsertedId:\n" . "Errno: " . $mysqli->errno . "\n" . "Error: " . $mysqli->error;
        crgRollbackMySql();
    }
    return $result;
}
function nullIfBlank ($val){
	if($val==""){
		return null;
	} else {
		return $val;
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

?>
