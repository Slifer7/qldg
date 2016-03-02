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
		$importResult->TotalRecords = 0;
		$importResult->SuccessCount = 0;
		$importResult->FailureCount = 0;
		$importResult->DuplicateIDs = array();
		
		$connection->db::Connect();
		$connection->query("set names 'utf8'");
		
		$sql = "insert into Major values(?, ?)";
		$statement = $connection->prepare($sql);
		
		$excel = new Excel($filename);
		
		$connection->close();
		return $importResult;
	}
	
}
?>