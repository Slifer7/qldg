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
		
		
		
		$connection->close();
		return ;
	}
}

?>