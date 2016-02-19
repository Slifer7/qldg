<?php
	
require_once("db.php");
session_start();

$username = $_POST["txtUsername"];
$password = $_POST["txtPassword"];

$result = DB::Login($username, $password);

if ($result->Success == true)
{	
	$_SESSION["LOGGED_IN"] = true;
	$_SESSION["LOGIN_INFO"] = $result;
	
	if($result->RoleName == "admin")
		header("Location: ../admincp.php");
	else
		header("Location: ../visitman.php");
}
else
{
	header("Location: ../login.php?error=INVALID_LOGIN_INFO");	
}

?>