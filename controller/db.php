<?php

require_once("LoginResult.php");

class DB
{
	public static $server = "localhost";
	public static $database = "qldg";
	public static $dbUser = "root";
	public static $dbPass = "";	
	
	public static function Login($username, $password)
	{
		$result = new LoginResult();
		
		$connection = new mysqli(self::$server, self::$dbUser, self::$dbPass, self::$database);
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}
		
		$username = $connection->real_escape_string($username);
		$password = $connection->real_escape_string($password);
		
		$sql = "select * from user where username='$username' and password='$password'";
		
		$connection->query("set names 'utf8'");
		$reader = $connection->query($sql);		
		$row = $reader->fetch_assoc();
		
		if ($row != NULL)
		{
			$result->Success = true;
			$result->RoleName = $row["rolename"];
		}
				
		$connection->close();
		return $result;
	}
}
	
?>