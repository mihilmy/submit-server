<?php
	require_once("../Students/student.php");
	require_once("../Teachers/teacher.php");
	require_once("DatabaseProvider.php");
	session_start();

	login();

	/*
	Function handles student login.
	On success it returns the result. On failure it returns null. If no data exists it returns false.
	*/
	function student_login() {
		global $db;
		$directoryId = trim($_POST['directoryId']);
		$password = trim($_POST['password']);

		$student_query = <<<QUERY
		SELECT * FROM STUDENTS
		WHERE DIRECTORY_ID = $directoryId AND PASSWORD = '$password';
QUERY;


		$result = mysqli_query($db->getConnectionString(), $student_query);

		if($result) {
			$numberOfRows = mysqli_num_rows($result);

			if ($numberOfRows == 0) {
				return false;
			} else {
				return $result;
			}

		}

		return null;

	}

	/*
	Function handles teacher login.
	On success it returns the result. On failure it returns null. If no data exists it returns false.
	*/
	function teacher_login() {
		global $db;
		$directoryId = trim($_POST['directoryId']);
		$password = trim($_POST['password']);

		$teacher_query = <<<QUERY
		SELECT * FROM TEACHERS
		WHERE DIRECTORY_ID = $directoryId AND PASSWORD = '$password';
QUERY;

		$result = mysqli_query($db->getConnectionString(), $teacher_query);

		if($result) {
			$numberOfRows = mysqli_num_rows($result);

			if ($numberOfRows == 0) {
				return false;
			} else {
				return $result;
			}

		}

		return null;
	}
	/*
	This is a wrapper to handle both student and teacher log in.
	*/
	function login() {
		$result = student_login();
		$isStudent = true;

		if ($result === null) {

			$_SESSION['message'] = "Fetching records failed.".mysqli_error($_SESSION['db']);
			header("Location: ../");
			return false;
		}

		if ($result === false) {
			$isStudent = false;
			$result = teacher_login();
		}

		if ($result === false) {
			$_SESSION['message'] = "Directory ID and/or password incorrect. Please try again!";
			header("Location: ../");
			return false;
		}

		$array = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$name = $array['name'];
		$email = $array['email'];
		$directoryId = $array['directory_ID'];
		/* what I added here is a dictionary (hashmap) instead of the custom Student & Teacher
		// classes. The reason is becuase objects are not stored as they are. Thet are seralized.
		*/
		if($isStudent) {
			
			$student = new Student($name,$email,$directoryId);
			$studentArray = array('name'=>$name,'directoryId'=>$directoryId,'email'=> $email);
			$_SESSION['current_student'] = $student;
			$_SESSION['current_studentArray'] = $studentArray;
			header("Location: ../Students/show.php");
		} else {
			$teacher = new Teacher($name,$email,$directoryId);
			$teacherArray = array('name'=>$name,'directoryId'=>$directoryId,'email'=> $email);
			$_SESSION['current_teacher'] = $teacher;
			$_SESSION['current_teacherArray'] = $teacherArray;
			header("Location: ../Teachers/show.php");
		}

		return true;
	}


?>
