<?php
require_once("db.php");
require_once("Excel.php");

class RegistrationInfo {
	public $StudentID;
	public $FullName;
	public $MajorName;
	public $RegisterDate;
	
	public function __construct($id, $name, $major, $date) {
		$this->StudentID = $id;
		$this->FullName = $name;
		$this->MajorName = $major;
		$this->RegisterDate = $date;
	}

	public static function GetAllRegistration(){
		$regs = array();
		
		$connection = db::Connect();
		$connection->query("set names 'utf8'");
		
		$sql = "select * from Registration";		
		$result = $connection->query($sql);
		
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$id = $row["studentid"];
				$name = $row["fullname"];
				$major = $row["majorname"];
				$date = $row["registerdate"];
				
				$item = new RegistrationInfo($id, $name, $major, $date);
				array_push($regs, $item);
			}				
		}
		
		$connection->close();
		return $regs;
	}
	
	public static function Import($filename){
		$importResult = new stdClass();
		$importResult->TotalRecords = 0;
		$importResult->SuccessCount = 0;
		$importResult->FailureCount = 0;
		$importResult->DuplicateIDs = array();
		
		$connection = db::Connect();
		$connection->query("set names 'utf8'");
		
		$sql = "insert into Registration values(?, ?, ?, now())";
		$statement = $connection->prepare($sql);
		
		$excel = new Excel($filename);
		$importResult->TotalRecords = $excel->Rows - 1; // Không tính dòng tiêu đề
		
		// Rows: 1 -> n trong khi đó Cols: 0 -> n-1		
		for($i = 2; $i <= $excel->Rows; $i++){
			$id = $excel->ActiveSheet->getCellByColumnAndRow(0, $i)->getValue();
			$fullname = $excel->ActiveSheet->getCellByColumnAndRow(1, $i)->getValue();
			$majorname = $excel->ActiveSheet->getCellByColumnAndRow(2, $i)->getValue();
			
			$statement->bind_param("sss", $id, $fullname, $majorname);
			
			if ($statement->execute() == false){
				$importResult->FailureCount++;
				array_push($importResult->DuplicateIDs, $id . "-" . $fullname);
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