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
	public static function InsertNewVisit($studentID, $room){
		$result = new stdClass();
		$result->VisitID = -1;
		$result->StudentID = $studentID;
		$result->FullName = "";
		$result->Major = self::ExtractMajorNameFromStudentID($studentID);
		$reginfo = self::GetRegistrationInfoByStudentID($studentID);

		// Trường hợp đặc biệt không cần kiểm tra có đăng kí hay chưa
		if(strpos("CBN", $studentID) !== false){ // Có tồn tại 1 trong số các kí tự đb
			$result->FullName = self::_getMajorName($studentID); // Trường hợp mã đặc biệt thì tên cũng là tên ngành
			$connection = self::Connect();
			$sql = "insert into Visit(studentid, major, timestamp, room) values('$studentID', '$result->Major', now(), '$room')";
			$reader = $connection->query($sql);

			if ($reader == TRUE) {
				$result->VisitID = $connection->insert_id;

				// Vấn đề với ngày giờ từ php - time zone, nên phải lấy ngày giờ từ mysql cho lẹ
				$sql = "select now()";
				$result->Date = $connection->query($sql)->fetch_array()[0];
			}

			$connection->close();
			return $result;
		}
		else if($reginfo->StudentID == -1){ // Chưa đăng kí
			return $result;
		}
		else{
			$result->FullName = $reginfo->FullName; // Lấy tên từ thông tin đăng kí, phục vụ việc trả về thôi
			$connection = self::Connect();
			$sql = "insert into Visit(studentid, major, timestamp, room) values('$studentID', '$result->Major', now(), '$room')";
			$reader = $connection->query($sql);

			if ($reader == TRUE) {
				$result->VisitID = $connection->insert_id;

				// Vấn đề với ngày giờ từ php, nên phải lấy ngày giờ từ mysql cho lẹ
				$sql = "select now()";
				$result->Date = $connection->query($sql)->fetch_array()[0];
			}

			$connection->close();
			return $result;
		}
	}

	private static function ExtractMajorNameFromStudentID($id){
		$code = "";

		if(strlen($id) == 7) { // Mã số sinh viên bình thường
			$code = substr($id, 2, 2); // Kí tự thứ 3 và 4 là mã ngành
		}
		else if (strlen($id) == 8) { // Sinh viên có mã 3 đầu tiên là cao học
			$code = substr($id, 0, 1); // Kí tự đầu tiên
		}
		else if (strlen($id) == 1){
			$code = $id;
		}

		$majorName = self::_getMajorName($code);
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
		$reginfo = new RegistrationInfo(-1, "", "", NULL);
		$connection = self::Connect();
		$sql = "select * from Registration where studentid='$studentID'";
		$reader = $connection->query($sql);

		if ($reader->num_rows > 0) {
			$row = $reader->fetch_assoc();
			$id = $studentID;
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

	public static function InsertVisit($date, $studentID, $room){
		$result = new stdClass();
		$result->VisitID = -1;
		$result->StudentID = $studentID;
		$result->FullName = "";
		$result->Major = self::ExtractMajorNameFromStudentID($studentID);
		$reginfo = self::GetRegistrationInfoByStudentID($studentID);

		// Trường hợp đặc biệt không cần kiểm tra có đăng kí hay chưa
		if(strpos("CBN", $studentID) !== false){ // Có tồn tại 1 trong số các kí tự đb
			$result->FullName = self::_getMajorName($studentID); // Trường hợp mã đặc biệt thì tên cũng là tên ngành
			$connection = self::Connect();
			$sql = "insert into Visit(studentid, major, timestamp, room) values('$studentID', '$result->Major', '$date', '$room')";
			$reader = $connection->query($sql);

			if ($reader == TRUE) {
				$result->VisitID = $connection->insert_id;
			}

			$connection->close();
			return $result;
		}
		else if($reginfo->StudentID == -1){ // Chưa đăng kí
			return $result;
		}
		else{
			$result->FullName = $reginfo->FullName; // Lấy tên từ thông tin đăng kí, phục vụ việc trả về thôi
			$connection = self::Connect();
			$sql = "insert into Visit(studentid, major, timestamp, room) values('$studentID', '$result->Major', '$date', '$room')";
			$reader = $connection->query($sql);

			if ($reader == TRUE) {
				$result->VisitID = $connection->insert_id;
			}

			$connection->close();
			return $result;
		}
	}
}

?>
