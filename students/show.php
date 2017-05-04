<?php 
require_once("student.php");
session_start();

$student = $_SESSION['current_student'];
echo var_dump($student);
?>