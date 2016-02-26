<?php

require_once("db.php");

if (isset($_POST["StudentID"])){
	$fullname = db::CheckStudentExist($_POST["StudentID"]);
	
	echo $fullname;
}

?>