<?php
require_once("db.php");
require_once("Helper.php");

class VisitInfo{
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

	public static function GetVisitsByRoom($from, $to, $room){
		$connection = db::Connect();

		$sql = "select majorname, count(major) as total " .
				"from major as m left join " .
					"(select major, room, timestamp from visit where room='$room' and " .
					"cast(timestamp as date) between cast('$from' as date) and cast('$to' as date)) as v " .
				"on m.majorname = v.major " .
			    "group by m.majorname, v.major";

		$reader = $connection->query($sql);
		$result = array();

		if($reader->num_rows > 0 ){
			while($row = $reader->fetch_assoc()){
				$item = new stdClass();
				$item->major = $row["majorname"];
				$item->total = $row["total"];
				array_push($result, $item);
			}
		}
		$connection->close();
		return $result;
	}

	// Lấy tổng số lượt truy cập không phân ra phòng đọc
	public static function GetTotalVisits($from, $to){
		$connection = db::Connect();

		$sql = "select majorname, count(major) as total " .
				"from major as m left join " .
					"(select major, timestamp from visit " .
					"where cast(timestamp as date) ".
					"between cast('$from' as date) and cast('$to' as date)) as v ".
				"on m.majorname = v.major " .
			    "group by m.majorname, v.major";

		$reader = $connection->query($sql);
		$result = array();

		if($reader->num_rows > 0 ){
			while($row = $reader->fetch_assoc()){
				$item = new stdClass();
				$item->major = $row["majorname"];
				$item->total = $row["total"];
				array_push($result, $item);
			}
		}
		$connection->close();
		return $result;
	}

	public static function Export2Excel($data, $from, $to, $room, $major){ //: filename
		// Xóa sạch các file cũ
		Helper::DeleteAllFiles("download/*");

		// Tạo tên file duy nhất dựa trên ngày giờ
		$filename = sprintf("download/export_%s_%s_%s.xlsx",
						str_replace("-", "", $from),
						str_replace("-", "", $to),
						date("his")); // "Giờ phút giây"
		// Tạo bản sao từ template
		copy("template/visit.xlsx", $filename);

		$filetype = "Excel2007";
		$reader = PHPExcel_IOFactory::createReader($filetype);
		$excel = $reader->load($filename);
		$sheet = $excel->setActiveSheetIndex(0);
		$sheet->setCellValue("C4", str_replace("-", "/", $from));
		$sheet->setCellValue("E4", str_replace("-", "/", $to));
		$sheet->setCellValue("C5", $room == "all" ? "Tất cả" : $room);
		$sheet->setCellValue("E5", $major == "all" ? "Tất cả" : $room);

		$count = count($data);
		$sheet->setCellValue("C6", $count);

		// Đổ dữ liệu vào bảng
		for($i = 0; $i < $count; $i++){
			$sheet->setCellValue("B" . (9 + $i) , $i + 1); // Số thứ tự
			$sheet->setCellValue("C" . (9 + $i) , $data[$i]->timestamp);
			$sheet->setCellValue("D" . (9 + $i) , $data[$i]->room);
			$sheet->setCellValue("E" . (9 + $i) , $data[$i]->major);
			$sheet->setCellValue("F" . (9 + $i) , $data[$i]->id);
		}

		$writer = PHPExcel_IOFactory::createWriter($excel, $filetype);
		$writer->save($filename);

		return $filename;
	}

	// Tạo ra báo cáo tổng kết
	public static function GenerateSummaryReport($from, $to){
		// Xóa sạch các file cũ
		Helper::DeleteAllFiles("download/*");

		// Tạo tên file duy nhất dựa trên ngày giờ
		$filename = sprintf("download/TongKet_%s_%s_%s.xlsx",
						str_replace("-", "", $from),
						str_replace("-", "", $to),
						date("his")); // "Giờ phút giây"
		// Tạo bản sao từ template
		copy("template/summary.xlsx", $filename);

		$filetype = "Excel2007";
		$reader = PHPExcel_IOFactory::createReader($filetype);
		$excel = $reader->load($filename);

		// Tổng hợp
		$data = self::GetTotalVisits($from, $to);
		self::_flushSummaryData($excel, $data, 0);

		$rooms = array('', 'luuhanh', 'thamkhao', 'linhtrung');

		for($i = 1; $i <= 3; $i++)
		{
			$data = self::GetVisitsByRoom($from, $to, $rooms[$i]);
			self::_flushSummaryData($excel, $data, $i);
		}

		$writer = PHPExcel_IOFactory::createWriter($excel, $filetype);
		$writer->save($filename);

		return $filename;
	}

	// Đổ dữ liệu vào bảng
	private static function _flushSummaryData($excel, $data, $index){
		$sheet = $excel->setActiveSheetIndex($index);
		$count = count($data);
		$total = 0;

		for($i = 0; $i < $count; $i++){
			$sheet->setCellValue("C" . (8 + $i) , $i + 1); // Số thứ tự
			$sheet->setCellValue("D" . (8 + $i) , $data[$i]->major); // Tên chuyên ngành
			$sheet->setCellValue("E" . (8 + $i) , $data[$i]->total); // Số lượt truy cập
			$total += $data[$i]->total;
		}

		$sheet->setCellValue("D" . (8 + $count + 1), "Tổng cộng");
		$sheet->setCellValue("E" . (8 + $count + 1), $total);
	}

	
}
?>
