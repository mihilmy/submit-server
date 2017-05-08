<?php
	require_once("../Services/DatabaseProvider.php");
	require_once("../Classes/class.php");
	require_once("student.php");
	session_start();
	
	$conn = DatabaseProvider::getInstance()->getConnectionString();

	function show() {
		global $conn;
		
		$directoryId = $_SESSION['current_student']->getDirectoryId();
		
		$query = <<<QUERY
		SELECT * FROM STUDENT_CLASSES 
		WHERE DIRECTORY_ID = $directoryId;
QUERY;
		
		$result = mysqli_query($conn, $query);
		
		if ($result) {
			$numberOfRows = mysqli_num_rows($result);
			
			if ($numberOfRows == 0) {
				$_SESSION['message'] = "Student is not registered in any classes.";
				return false;
			}
			
			$classes = [];
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$classes[] = $row["class_name"];
			}
			
			return $classes;
			
		} else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false;
		}
	}

	function index() {
		global $conn;
		
		if (isset($_GET['course'])) {
		$name = $_GET['course'];
		
		$query = <<<QUERY
		SELECT S.directory_ID, S.email, S.name 
		FROM STUDENTS S, STUDENT_CLASSES SC
		WHERE S.DIRECTORY_ID = SC.DIRECTORY_ID AND SC.CLASS_NAME = '$name';
QUERY;
		
		} else {
		
		$query = <<<QUERY
		SELECT * FROM STUDENTS;
QUERY;
			
		}
		
		$result = mysqli_query($conn, $query);
		
		if ($result) {
			$students = [];
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$students[] = $row;
			}
			
			return $students;
		}else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false;
		}
		
	}


	
?>