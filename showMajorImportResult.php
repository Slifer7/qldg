<?php
if(!isset($_SESSION)){
	session_start();
}
	
if(isset($_SESSION["MAJOR_IMPORT_RESULT"])){
	$result = json_decode($_SESSION["MAJOR_IMPORT_RESULT"]);
	echo "<h1>Kết quả import các chuyên ngành</h1><br/>";
	echo "Số lượng chuyên ngành cần import: " . $result->TotalRecords . "<br/>";
	echo "Số lượng chuyên ngành đã import thành công:" . $result->SuccessCount . "<br/>";
	
	if ($result->FailureCount > 0){
		echo "Số lượng chuyên ngành import thất bại: " . $result->FailureCount . "<br/>";
		echo "Danh sách các chuyên ngành đã có sẵn nên không import: ";
		
		$count = count($result->DuplicateIDs);
		for($i = 0; $i < $count - 1; $i++){
			echo $result->DuplicateIDs[$i] . ", ";
		}
		echo $result->DuplicateIDs[$count - 1];
	}
}
else{
	header("Location: admincp.php");
}

?>