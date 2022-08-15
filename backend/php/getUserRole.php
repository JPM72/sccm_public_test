<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");
require_once("config.php");

$logFile = '/tmp/getUserRole.log';
$name="";
$retArr["status"] = "Success";


file_put_contents($logFile, print_r($_POST,true), FILE_APPEND);


if (isset($_POST["userId"])) { 
	$userId = $_POST["userId"];
}

try {

	$SQL = "
		SELECT  
			user.first_name,
			user.surname,
			cellphone_number,
			name role,
			username email,
			role.role_id
		FROM $scDbName.user
		LEFT JOIN $scDbName.role ON user.role_id = role.role_id
		WHERE id = $userId
	";
	file_put_contents($logFile, $SQL, FILE_APPEND);
	// doLog($SQL);
	$retArr['data'] = crgMySqlgetRowArr($SQL);

	
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
};

echo json_encode($retArr, JSON_PRETTY_PRINT);
?>

