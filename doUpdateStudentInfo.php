<?php
include_once("RegistrationInfo.php");

if (isset($_POST["oldID"],
          $_POST["newID"],
          $_POST["newFullName"]))
{
  $oldID = $_POST["oldID"];
  $newID = $_POST["newID"];
  $newFullName = $_POST["newFullName"];

  RegistrationInfo::Update($oldID, $newID, $newFullName);
  echo "Success";
}
?>
