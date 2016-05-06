<?php
include_once("MajorInfo.php");

if (isset($_POST["oldCode"],
          $_POST["newCode"],
          $_POST["newName"]))
{
  $oldCode = $_POST["oldCode"];
  $newCode = $_POST["newCode"];
  $newName = $_POST["newName"];

  MajorInfo::Update($oldCode, $newCode, $newName);
  echo "Success";
}
?>
