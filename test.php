<?php
require_once("controller/db.php");

$visitInfo = new VisitInfo(-1, "1212111", "CNTT", new DateTime());

$insertedID = db::InsertNewVisit($visitInfo);

echo $insertedID;
?>