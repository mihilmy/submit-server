<?php
	session_start();

	function getMessage() {
		if(isset($_SESSION['message'])){
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
			return $message;
		}

		return false;
	}

	function redirectIfLoggedIn() {

		if(isset($_SESSION['current_teacher'])) {
			header("Location: Teachers/show.php");
		} elseif (isset($_SESSION['current_student'])) {
			header("Location: Students/show.php");
		}
	}

	function redirectIfNotLoggedIn(){
    if(!isset($_SESSION['current_teacher']) && !isset($_SESSION['current_student'])) {
			header("Location: index.php");
		}
  }
?>
