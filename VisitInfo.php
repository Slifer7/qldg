<?php
require_once("db.php");

class VisitInfo
{
	public $VisitID;
	public $StudentID;
	public $Major;
	public $Date;

	public function __construct($id, $student, $mj, $d)
	{
		$this->VisitID = $id;
		$this->StudentID = $student;
		$this->Major = $mj;
		$this->Date = $d;
	}
	
	public static function GetVisits($from, $to, $room, $major){
		$connection = db::Connect();	
		
		$sql = "select * from visit where timestamp between $from and $to";
		if (strlen($room) != 0){
			$sql .= " and room='$room'";
		} 
		
		if (strlen($major) != 0){
			$sql .= " and major='$major'";
		}
		
		$reader = $connection->query($sql);
		if($reader->num_rows > 0 ){
			$result = array();
			$count = 0;
			while($row = $reader->fetch_assoc()){
				$item = new stdClass();
				$item->id = $row["studentid"];
				$item->name = $row["fullname"];
				$item->major = $row["major"];
				$item->room = $row["room"];
				
				array_push($result, $item);
				$count++;
			}
			
			$result->TotalRecords = $count;
		}
		$connection->close();
		return $result;
	}
}

?>