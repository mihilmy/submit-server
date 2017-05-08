<?php

	//Score for this assignment
	$score = 0;
	//File for this assignment
	$submission_file = null;

	require_once("../Services/DatabaseProvider.php");
	require_once('../students/student.php');
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

		if(isset($_POST['upload_submission'])) {
		    //$newAssignment = Assignment::createNew($_POST['assignmentName'],$_POST['courseName'], str_replace ("T", " ", $_POST['dueDate']), $_POST['maxScore']);
		      if(isset($_FILES['uploaded_file'])) {

		        if($_FILES['uploaded_file']['error'] == 0) {

							$sid = $_SESSION['current_student']->getDirectoryId();
							$aid = $_POST['assignmentid'];
		          $mainDir = "../files/".$_POST['courseName']."/".$aid."/".$sid."/";
							//echo $_POST['courseName'];
		          // Gather all required data
		          $name = $_FILES['uploaded_file']['name'];
		          $mime = $_FILES['uploaded_file']['type'];
		          $data = file_get_contents($_FILES  ['uploaded_file']['tmp_name']);
		          $size = intval($_FILES['uploaded_file']['size']);
		          $tmp_name = $_FILES["uploaded_file"]["tmp_name"];
							if(!file_exists($mainDir)) {
		          mkdir($mainDir, 0755, true);
						}
		          move_uploaded_file($tmp_name, "$mainDir/file.rb");
		          //rename()
		          // Create the SQL query
		          $query = "
		            INSERT INTO `submissions` (
		              `assignment_ID`, `directory_ID`, `score`, `submission_file`)
		            VALUES (
		              '{$aid}', '{$sid}',0, '$name' )";
		        //echo "<pre>{$query}</pre>";;
		          // Execute the query
		          $result = $conn->query($query);

		          // Check if it was successfull
		          if($result) {
								header("Location:"."../Assignments/show.php?assignmentid=$aid");
		          }
		          else {
		            echo 'Error! Failed to insert the file'
		               . "<pre>{$conn->error}</pre>";
		          }
		        }
		        else {
		          echo 'No file was uploaded';
		         // echo 'An error accured while the file was being uploaded. '
		          //   . 'Error code: '. intval($_FILES['uploaded_file']['error']);
		        }

		        // Close the mysql connection

		      }
		      else {
		        echo 'Error! A file was not sent!';
		      }


		}

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
