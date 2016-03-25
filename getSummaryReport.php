<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"]) ){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];
	
	// Lấy dữ liệu thống kê của phòng linhtrung
	$room = "linhtrung";
	$major = "all";
	$result = VisitInfo::GetVisits$from, $to, $room, $major);

	
	
	
	echo $filename;
}
?>