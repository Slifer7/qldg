<?php
require_once("db.php");
require_once("Excel.php");

class MajorInfo
{
	public $MajorID;
	public $Code;
	public $MajorName;
	
	public function __construct($code, $name)
	{
		$this->Code = $code;
		$this->MajorName = $name;
	}
	
	public static function Import($filename){
		$importResult = new stdClass();
		$importResult->TotalRecords = 0;
		$importResult->SuccessCount = 0;
		$importResult->FailureCount = 0;
		$importResult->DuplicateIDs = array();
		
		$connection = db::Connect();
		$connection->query("set names 'utf8'");
		
		$sql = "insert into Major values(?, ?)";
		$statement = $connection->prepare($sql);
		
		$excel = new Excel($filename);
		$importResult->TotalRecords = $excel->Rows - 1; // Không tính dòng tiêu đề
		
		// Rows: 1 -> n trong khi đó Cols: 0 -> n-1
		for($i = 2; $i <= $excel->Rows; $i++){
			$code = $excel->ActiveSheet->getCellByColumnAndRow(0, $i)->getValue();
			$name = $excel->ActiveSheet->getCellByColumnAndRow(1, $i)->getValue();
			
			$statement->bind_param("ss", $code, $name);
			
			if ($statement->execute() == false){
				$importResult->FailureCount++;
				array_push($importResult->DuplicateIDs, $code . "-" . $name);
			}
			else {
				$importResult->SuccessCount++;
			}
		}		
		
		$connection->close();
		return $importResult;
	}
}
?>