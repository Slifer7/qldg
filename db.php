<?php

require_once("LoginResult.php");
require_once("VisitInfo.php");
require_once("MajorInfo.php");
require_once("RegistrationInfo.php");

class DB
{
	public static $server = "localhost";
	public static $database = "qldg";
	public static $dbUser = "root";
	public static $dbPass = "";	
	
	public static function Connect() {
		$connection = new mysqli(self::$server, self::$dbUser, self::$dbPass, self::$database);
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}
		$connection->query("set names 'utf8'");
		
		return $connection;
	}
	
	public static function Login($username, $password){ 
		$result = new stdClass();
		
		$connection = self::Connect();
		
		$username = $connection->real_escape_string($username);
		$password = $connection->real_escape_string($password);		
		$sql = "select * from user where username='$username' and password='$password'";
		$reader = $connection->query($sql);				
		
		if ($reader->num_rows > 0){
			$result->Success = true;
			
			$row = $reader->fetch_assoc();			
			$result->Username = $username;			
			$result->Room = $row["room"];
		}
				
		$connection->close();
		return $result;
	}
	
	// Thêm một lượt truy cập vào CSDL
	public static function InsertNewVisit($studentID, $room) //: VisitInfo
	{		
		$majorName = self::ExtractMajorCodeFromStudentID($studentID);				
		$visitInfo = new VisitInfo(-1, $studentID, $majorName, NULL);
		
		// Do tách bảng nên phải vào bảng đăng kí để lấy tên đầy đủ của sinh viên
		$reginfo = self::GetRegistrationInfoByStudentID($studentID);
		
		if (strlen($reginfo->FullName) == 0) // Chưa đăng kí nên không có tên
			return $visitInfo;
		else {
			$visitInfo->FullName = $reginfo->FullName;
			$connection = self::Connect();
			
			$sql = "insert into Visit(studentid, major, timestamp, room) values('$studentID', '$majorName', now(), '$room')";
			$result = $connection->query($sql);
			
			if ($result == TRUE) {
				$visitInfo->VisitID = $connection->insert_id;
				
				// Vấn đề với việc tạo ra ngày giờ từ php, nên phải lấy ngày giờ từ mysql cho lẹ
				$sql = "select now()";
				$reader = $connection->query($sql);
				$row = $reader->fetch_array();
				$visitInfo->Date = $row[0];			
			}		
			
			$connection->close();		
		}	
		
		return $visitInfo;
	}	
	
	private static function ExtractMajorCodeFromStudentID($id){
		$code = "";

		if(strlen($id) == 7) { // Mã số sinh viên bình thường
			$code = substr($id, 2, 2); // Kí tự thứ 3 và 4 là mã ngành
		}
		else if (strlen($id) == 8) { // Sinh viên đào tạo từ xa
			$code = substr($id, 2, 1); // Kí tự thứ 3 là mã ngành
		}
		else if (strpos($id, "C") != false) { // Cao học
			$code = "C";
		}
		else if (strpos($id, "B") != false) { // Cán bộ
			$code = "B";
		}
		else if (strpos($id, "N") != false) { // Ngoài trường
			$code = "N";
		}

		$majorName = "";
		if (strlen($code) != 0)
			$majorName = self::_getMajorName($code);
		error_log($majorName);
		return $majorName;
	}
	
	private static function _getMajorName($code){
		$majorName = "";
		
		$connection = self::Connect();
		$sql = "select majorname from major where code='$code'";				
		$reader = $connection->query($sql);
		
		if ($reader->num_rows > 0) {
			$row = $reader->fetch_assoc();
			$majorName = $row["majorname"];
		}
		
		$connection->close();
		return $majorName;
	}
	
	public static function GetRegistrationInfoByStudentID($studentID) {
		$reginfo = new RegistrationInfo("", "", "", NULL);
		$connection = self::Connect();
		$sql = "select * from Registration where studentid='$studentID'";	
		$reader = $connection->query($sql);
		
		if ($reader->num_rows > 0) {
			$row = $reader->fetch_assoc();
			$id = $row["studentid"];
			$name = $row["fullname"];
			$major = $row["majorname"];
			$date = $row["registerdate"];
			
			$reginfo = new RegistrationInfo($id, $name, $major, $date);
		}
		
		$connection->close();
		return $reginfo;
	}
	
	public static function GetAllMajors() // :MajorInfo[]
	{
		$majors = array();
		$connection = self::Connect();

		$sql = "select * from major";	
		$reader = $connection->query($sql);
		
		if($reader->num_rows > 0) {
			while ($row = $reader->fetch_assoc()){
				$code = $row["code"];
				$name = $row["majorname"];
			
				$item = new MajorInfo($code, $name);
				array_push($majors, $item);
			}		
		}
		
		$connection->close();
		return $majors;
	}
}
	
?>