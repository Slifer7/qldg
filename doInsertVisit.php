<?php
require_once("db.php");
session_start();

if (isset($_GET["StudentID"])){
	$studentID = $_GET["StudentID"];	
	$room = $_SESSION["LOGIN_INFO"]->Room;	
	$result = db::InsertNewVisit($studentID, $room);
	
	echo json_encode($result);
}
?>