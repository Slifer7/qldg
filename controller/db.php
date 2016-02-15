<?php

require_once("LoginResult.php");

class DB
{
	public static $server = "localhost";
	public static $database = "qldg";
	public static $dbUser = "";
	public static $dbPass = "";	
	
	public static function Login($username, $password): 
	{
		$result = new LoginResult();
		
		$connection = new mysqli($server, $dbUser, $dbPass);
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		
		$sql = "select * from user where username=" . 
				mysql_real_escape_string($username) . 
			   " and password=" . 
			    mysql_real_escape_string($password);
		$reader = $connection->query($sql);		
		
		if ($reader->num_rows == 1)
		{
			$row = $reader->fetch_assoc();
			
			$result->Success = true;
			$result->$RoleName = $row["rolename"];
		}
				
		$connection->close();
		return $result;
	}
}
	
?>