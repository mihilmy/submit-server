<?php
	require_once("../Services/DatabaseProvider.php");
	require_once("../Classes/class.php");
	require_once("teacher.php");
	session_start();
	
	$conn = DatabaseProvider::getInstance()->getConnectionString();

	function show() {
		global $conn;
		
		$directoryId = $_SESSION['current_teacher']->getDirectoryId();
		
		$query = <<<QUERY
		SELECT * FROM CLASSES 
		WHERE TEACHER_ID = $directoryId;
QUERY;
		
		$result = mysqli_query($conn, $query);
		
		if ($result) {
			$numberOfRows = mysqli_num_rows($result);
			
			if ($numberOfRows == 0) {
				$_SESSION['message'] = "Teacher is not teaching any classes";
				return false;
			}
			
			$classes = [];
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$classes[] = $row["name"];
			}
			
			return $classes;
			
		} else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false;
		}
	}

	function index($class = null) {
		global $conn;
		
		$query = <<<QUERY
		SELECT * FROM TEACHERS;
QUERY;
		
		$result = mysqli_query($conn, $query);
		
		if ($result) {
			$teachers = [];
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$teachers[] = $row;
			}
			
			return $teachers;
		}else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false;
		}
		
	}


	
?>