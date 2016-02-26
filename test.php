<?php
require_once("controller/db.php");

$fullname = db::GetRegistrationInfoByStudentID("1461100");

echo var_dump($fullname);
?>