<?php
	
require_once("db.php");
session_start();

$username = $_POST["txtUsername"];
$password = $_POST["txtPassword"];

$result = DB::Login($username, $password);

if ($result->Success)
{
	
}
else
{
	header("Location: login.php");	
}

?>