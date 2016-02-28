<?php
require_once("controller/db.php");

$result = db::InsertNewVisit("1461100");

echo json_encode($result);
?>