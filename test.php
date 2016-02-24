<?php
require_once("controller/db.php");

$result = DB::GetAllMajors();

foreach($result as $value)
{
	echo var_dump($value) . "<br/>"; 
}
?>