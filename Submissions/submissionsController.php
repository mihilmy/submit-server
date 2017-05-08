<?php
	
	//Score for this assignment
	$score = 0;
	//File for this assignment
	$submission_file = null;

	require_once("../Services/DatabaseProvider.php");
	session_start();

	$conn = DatabaseProvider::getInstance()->getConnectionString();


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
	function index() {

		
		//Grab the assignment ID from the url
		$assignmentID = $_GET['assignmentid'];
		//Query the database to get the assignment based on the directory id and the assignment id
		$query = <<<QUERY
		SELECT * 
		FROM SUBMISSIONS
		WHERE assignment_id = $assignmentID;
QUERY;
		
		$result = mysqli_query(DatabaseProvider::getInstance()->getConnectionString(), $query);
		//Checking if a submission exists
		if($result->num_rows == 0){
			return false;
		}
		//Garaunteed exactly one result
		echo "<h4>Student Submissions</h4>";
		echo "<ul class=\"list-group\">";
		while($row = $result->fetch_assoc()){
			//Grab the score and the submission file
			$score = $row['score'];
			$student_id = $row['directory_ID'];
			//Get the name of the student
			$name = getStudentName($student_id);
						echo <<<H
						 <li class="list-group-item">
	                        <span class="badge badge-info">{$score}</span>
	                        <a onclick="location.href='students/show.php?directory_id={$student_id}';">$name</a>

	                    </li>
H;
		}
		echo "</ul>";
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

	//Function to grab student name by his student ID
	function getStudentName($id){
		$query = <<<QUERY
		SELECT * FROM STUDENTS
		WHERE DIRECTORY_ID = $id;
QUERY;
		
		$result = mysqli_query(DatabaseProvider::getInstance()->getConnectionString(), $query);
		//Exactly one result
		$student = $result-> fetch_assoc();
		return $student['name'];
		
	}

?>