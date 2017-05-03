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
?>