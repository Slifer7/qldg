<?php
	session_start();	
	
	if (isset($_SESSION["LOGGED_IN"]))
	{
		if (0 == strcmp( "admin", strtolower($_SESSION["ROLE"]) ) )
		{
			// Go to default admin page 
			header("Location: admincp.php");
		}
		else // Normal employee of the library
		{
			// Go to visit management page
			header("Location: visitman.php");
		}
	}
	else // Haven't login yet
	{
		// Show log in page
		header("Location: login.php");
	}
	die();
?>