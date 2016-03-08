<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"], $_GET["Room"], $_GET["Major"])){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];
	$room = $_GET["Room"];
	$major = $_GET["Major"];
	
	$result = VisitInfo::GetVisits($from, $to, $room, $major);
	echo json_encode($result);
}
else {
	header("Location: index.php");
}  
?>