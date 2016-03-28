<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"]) ){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];
	
	// Lấy dữ liệu thống kê của phòng linhtrung
	$room = "linhtrung";
	$result = VisitInfo::GetVisitsByRoom($from, $to, $room);
	
	/* $room = "thamkhao";
	$result = VisitInfo::GetVisitsByRoom($from, $to, $room);
	
	$room = "luuhanh";
	$result = VisitInfo::GetVisitsByRoom($from, $to, $room);	 */
	
	echo json_encode($result);
}
?>