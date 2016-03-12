<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"], $_GET["Room"], $_GET["Major"])){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];
	$room = $_GET["Room"];
	$major = $_GET["Major"];
	
	// Lấy dữ liệu thống kê
	$result = VisitInfo::GetVisits($from, $to, $room, $major);

	// Đổ ra tập tin excel	
	$filename = VisitInfo::Export2Excel($result, $from, $to, $room, $major);
	
	// Trả về đường dẫn
	echo $filename;
}
?>