<?php
require_once("db.php");

if (isset($_POST["StudentID"]))
{
	$studentID = $_POST["StudentID"];	
	$reginfo = db::GetRegistrationInfoByStudentID($studentID);
	
	echo json_encode($reginfo);
}
?>