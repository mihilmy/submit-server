<?php
require_once("teacher.php");
session_start();

$teacher = $_SESSION['current_teacher'];
echo var_dump($teacher);
?>