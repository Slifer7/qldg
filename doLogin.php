<?php
	
require_once("db.php");
session_start();

$username = $_POST["txtUsername"];
$password = $_POST["txtPassword"];

$result = DB::Login($username, $password);

if ($result->Success == true){	
	$_SESSION["LOGGED_IN"] = true;
	$_SESSION["LOGIN_INFO"] = $result;	
	
	header("Location: controlpanel.php");	
}
else{
	header("Location: login.php?error=INVALID_LOGIN_INFO");	
}

?>