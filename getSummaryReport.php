<?php
require_once("VisitInfo.php");

if(isset($_GET["FromDate"], $_GET["ToDate"]) ){
	$from = $_GET["FromDate"];
	$to = $_GET["ToDate"];	
	$link = VisitInfo::GenerateSummaryReport($from, $to);
	
	echo $link;
}
?>