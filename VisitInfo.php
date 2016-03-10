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
	
	public static function GetTodayVisits($room) { //: VisitInfo	[]
		$result = array();		
		$connection = db::Connect();
		
		$sql = "select * from Visit v join Registration r on v.studentID = r.studentID where year(now()) = year(timestamp) and month(now()) = month(timestamp) and day(now()) = day(timestamp) and room='$room' order by timestamp desc";		
		$reader = $connection->query($sql);
		
		if ($reader->num_rows > 0) {
			while ($row = $reader->fetch_assoc()) {
				$vid = $row["visitid"];
				$studentid = $row["studentid"];
				$major = $row["major"];
				$date = $row["timestamp"];
				
				$item = new VisitInfo($vid, $studentid, $major, $date);				
				$item->FullName = $row["fullname"];
				array_push($result, $item);
			}
		}
		
		$connection->close();		
		return $result;
	}
	
	public static function GetVisits($from, $to, $room, $major){
		$connection = db::Connect();	
		
		$sql = "select * from visit where cast(timestamp as date) between cast('$from' as date) and cast('$to' as date)";
		if (0 != strcmp($room, "all")){
			$sql .= " and room='$room'";
		} 
		
		if (0 != strcmp($major, "all")){
			$sql .= " and major='$major'";
		}
		error_log($sql);
		
		$reader = $connection->query($sql);
		$result = array();
		
		if($reader->num_rows > 0 ){						
			while($row = $reader->fetch_assoc()){
				$item = new stdClass();
				$item->id = $row["studentid"];				
				$item->major = $row["major"];
				$item->room = $row["room"];
				$item->timestamp = $row["timestamp"];
				array_push($result, $item);				
			}
		}
		$connection->close();
		return $result;
	}
	
	
}

?>