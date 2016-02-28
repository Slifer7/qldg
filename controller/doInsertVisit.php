<?php

require_once("db.php");

if (isset($_POST["StudentID"]))
{
	$studentID = $_POST["StudentID"];	
	$visitInfo = db::InsertNewVisit($studentID);
	
	echo json_encode($visitInfo);
}

?>