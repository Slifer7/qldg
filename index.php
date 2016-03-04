<?php
require_once("LoginResult.php");
session_start();	

if (isset($_SESSION["LOGGED_IN"]))
{
	header("Location: controlpanel.php");
}
else {// Haven't login yet
	// Show log in page
	header("Location: login.php");
}
die();

?>