<?php
require_once("student.php");
session_start();
if(isset($_SESSION['current_student'])) {
$student = $_SESSION['current_student'];
echo var_dump($student);
}
?>
