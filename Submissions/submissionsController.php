<?php
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

?>