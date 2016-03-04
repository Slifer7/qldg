<?php
require_once("db.php");
session_start();

if (isset($_POST["StudentID"])){
	$studentID = $_POST["StudentID"];	
	$room = $_SESSION["LOGIN_INFO"]->Room;	
	$visitInfo = db::InsertNewVisit($studentID, $room);
	
	echo json_encode($visitInfo);
}
?>