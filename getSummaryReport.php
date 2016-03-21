<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"]) ){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];
	
	// Lấy dữ liệu thống kê
	$result = VisitInfo::GetVisits($from, $to, $room, $major);

	// Xuất ra tập tin excel	
	$filename = VisitInfo::Export2Excel($result, $from, $to, $room, $major);
	
	// Tr? v? du?ng d?n
	echo $filename;
}
?>