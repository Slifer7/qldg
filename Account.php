<?php
include_once("db.php");

class Account{
  public static function GetAll(){
    $list = array();

    $connection = db::Connect();
    $sql = "select * from User";
    $reader = $connection->query($sql);

    if ($reader->num_rows > 0){
      while ($row = $reader->fetch_assoc()){
				$username = $row["username"];
				$room = $row["room"];

				$item = new stdClass();
        $item->Username = $username;
        $item->Room = $room;
				array_push($list, $item);
			}
		}

    return $list;
  }
}

?>
