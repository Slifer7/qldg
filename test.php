<?php
require_once ("Classes/PHPExcel.php");

$filename = "ma nganh.xlsx";
$type = PHPExcel_IOFactory::identify($filename);
$reader = PHPExcel_IOFactory::createReader($type);
$spreadsheet = $reader->load($filename);
$sheet = $spreadsheet->getSheet(0);
$rows = $sheet->getHighestRow();
$cols = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());

echo $rows . " " . $cols . "<br/>" ;


for($i = 0; $i < $rows; $i++){
	for($j = 0; $j < $cols; $j++){
		$cell = $sheet->getCellByColumnAndRow($j, $i);
		echo $cell->getValue() . " ";
	}		
	
	echo "<br/>";
}


?>