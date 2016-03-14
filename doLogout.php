<?php
session_start();

session_unset(); // Clear all session

header("Location: ../qldg/index.php");

?>
