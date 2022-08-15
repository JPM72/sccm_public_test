<?php
require_once ("core/controller.Class.php");
require_once ("config.php");

if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
}else{
    header('Location: ../index.php');
    exit();
}

// If invalid, redirect to login page
if(isset($token["error"]) != "invalid_grant"){
	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	// ***********
	// insert data
	// ***********
	$Controller = new Controller;
	echo $Controller -> insertData(array(
		"email" => $userData["email"],
		"avatar" => $userData["picture"],
		"familyName" => $userData["familyName"],
		"givenName" => $userData["givenName"],
	));
	// var_dump($userData)


	// echo "<pre>";
	// var_dump($userData);
	// // var_dump($token);
	// echo "</pre>";
} else {
    header('Location: ../index.php');
    exit();
}



?>