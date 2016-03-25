<?php
if(!isset($_SESSION)){
	session_start();
}
	
if(isset($_SESSION["REGISTRATION_IMPORT_RESULT"])){
	$result = $_SESSION["REGISTRATION_IMPORT_RESULT"];
	echo "<h1>Kết quả import thông tin đăng kí sử dụng thư viện</h1><br/>";
	echo "Số lượng sinh viên đăng kí: " . $result->TotalRecords . "<br/>";
	echo "Số lượng sinh viên đã import thành công:" . $result->SuccessCount . "<br/>";
	
	if ($result->FailureCount > 0){
		echo "Số lượng sinh viên import thất bại: " . $result->FailureCount . "<br/>";
		echo "Danh sách các sinh viên đã có sẵn nên không import:<br/>";
		echo "<ol>";
		$count = count($result->DuplicateIDs);
		for($i = 0; $i < $count; $i++){
			echo "<li>" . $result->DuplicateIDs[$i] . "</li>";
		}
		echo "</ol>";
	}
}
else{
	header("Location: admincp.php");
}

?>