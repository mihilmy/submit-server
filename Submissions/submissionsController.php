<?php
	
	//Score for this assignment
	$score = 0;
	//File for this assignment
	$submission_file = null;

	require_once("../Services/DatabaseProvider.php");
	session_start();

	$conn = DatabaseProvider::getInstance()->getConnectionString();


	function index($class = '', $directory_id = '') {
		global $conn;

		$query = <<<QUERY
		SELECT * FROM SUBMISSIONS;
QUERY;

		$result = mysqli_query($conn, $query);

		if($result) {

			$submissions = [];

			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$submissions[] = $row;
			}

			return $submissions;

		} else {
			$_SESSION['message'] = "Fetching records failed.".mysqli_error($conn);
			return false;
		}

		
	}

	function show() {

		//Grab the srudent ID of the logged in user
		$directoryId = $_SESSION['current_student']->getDirectoryId();
		//Grab the assignment ID from the url
		$assignmentID = $_GET['assignmentid'];
		//Query the database to get the assignment based on the directory id and the assignment id
		$query = <<<QUERY
		SELECT * 
		FROM SUBMISSIONS
		WHERE directory_id = $directoryId AND assignment_id = $assignmentID;
QUERY;
		
		$result = mysqli_query(DatabaseProvider::getInstance()->getConnectionString(), $query);
		//Checking if a submission exists
		if($result == null){
			return false;
		}
		//Garaunteed exactly one result
		$row = $result->fetch_assoc();
		//Grab the score and the submission file
		$score = $row['score'];
		$submission_file = $row['submission_file'];
					echo <<<H
					<h4>Submission Info</h4>
			 		<ul class="list-group">
					 <li class="list-group-item">
                        <span class="badge badge-info">{$score}</span>
                           Current Score
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">{$submission_file}</span>
                           Submission
                    </li>
                    </ul>
H;
		return true;


	}

	function delete() {
		
	}

	function create() {
		global $conn;
		
		$query = <<<QUERY
		INSERT INTO SUBMISSIONS VALUES();
QUERY;

		$result = mysqli_query($conn, $query);
		
	}


	function runTestFile() {
		
	}

?>