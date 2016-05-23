<?php
include_once("db.php");
session_start();

if(isset($_POST["date"],
         $_POST["list"])){
  // Đổi từ dd/mm/yyyy thành yyyy-mm-dd
  $date = $_POST["date"];
  $tokens = explode("/", $date);
  $date = $tokens[2] . "-" . $tokens[1] . "-" . $tokens[0];

  $list = explode("\n", $_POST["list"]);
  $result = $_SESSION["LOGIN_INFO"];
  $room = $result->Room;

  $count = 0;
  foreach($list as $id){ //if($id != "") để không nhập những dòng trống
	if($id != ""){
		$result = db::InsertVisit($date, $id, $room);
		if ($result->VisitID != -1)
		  $count++;
	}
  }

  echo "Đã thêm " . $count . " lượt truy cập!";
  if ($count != count($list)){
    echo "Số lượt truy cập không thành công: ";
    echo count($list) - $count;
  }
}
?>
