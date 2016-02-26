<?php
require_once("controller/db.php");

$fullname = db::CheckStudentExist("123");

echo $fullname;
?>