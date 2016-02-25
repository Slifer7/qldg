<?php

require_once("db.php");

if (isset($_POST["StudentID"], $_POST["Major"]))
{
	$studentID = $_POST["StudentID"];
	$major = $_POST["Major"];
	
	$visitInfo = new VisitInfo(-1, $studentID, $major, NULL);
	$insertID = db::InsertNewVisit($visitInfo);
	
	echo $insertID;
}

?>