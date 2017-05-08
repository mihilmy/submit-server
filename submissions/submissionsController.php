<?php
	require_once("../Services/DatabaseProvider.php");
	session_start();
	
	$conn = DatabaseProvider::getInstance()->getConnectionString();

	function index() {
		global $conn;
		
		$assignmentID = $_GET['assignment'];
		
		$query = <<<QUERY
		SELECT * FROM SUBMISSIONS
		WHERE assignment_ID = $assignmentID;
QUERY;
		
		$result = mysqli_query($conn, $query);
		
		if($result) {
			
			$submissions = [];
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$submissions[] = $row;
			}
			
			return $students;
			
		} else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false; 
		}
	}


	function 
?>