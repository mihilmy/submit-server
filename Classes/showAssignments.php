<?php
	require_once("../Services/DatabaseProvider.php");
	require_once("../students/student.php");
	require_once("../Teachers/teacher.php");
	require_once("../Services/utils.php"); redirectIfNotLoggedIn();
	session_start();
	if(!isset($_GET['course']) || (!isset($_SESSION['current_student']) && !isset($_SESSION['current_teacher']))) {
		header("Location: ./showClasses.php");
	}
	$conn = DatabaseProvider::getInstance()->getConnectionString();

	if(isset($_SESSION['current_teacher'])) {
		$sql = "SELECT * FROM classes where teacher_ID='{$_SESSION['current_teacher']->getDirectoryId()}' and
		name='{$_GET['course']}'";
	} else {
		$sql = "SELECT * FROM student_classes where directory_ID='{$_SESSION['current_student']->getDirectoryId()}' and
		class_name='{$_GET['course']}'";
	}
	$result = $conn->query($sql);
	 if($result->num_rows == 0 && !isset($_SESSION['current_teacher'])) {
		 header("Location: ./showClasses.php");
	 }



?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Assignments</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../style.css">
	 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<!--NAVIGATION-->
		<div class="navbar navbar-default navbar-fixed-top nav-color"  role="navigation">
			<div class="container">
			 <!--MOBILE MENU-->
				<div class="navbar-header">
				<a href="../"  class="navbar-brand"><img src="../img/logo.png" alt="UMD"> </a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
				</div>
				<div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div>
			</div>
		</div>

		<div id="mainDiv">
		<div class="container">
			<b> Current Assignments</b>
			<?php


			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$className = $_GET['course'];
            $sql = "SELECT * FROM Assignments where class_name='$className'";
            $result = $conn->query($sql);
				echo "(Class: $className)";

	       ?>
			<ul class="list-group">
			<?php

            if ($result->num_rows > 0) {
                    // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo <<<H
				<li class="list-group-item"><a href="../Assignments/show.php?assignmentid={$row['assignment_ID']}">{$row['name']}</a> <span style="float:right;" class="label label-warning">Due Date: {$row['due_date']}</span></li>
H;
                }
            } else {
                echo "No assignments";}

			if(isset($_SESSION['current_teacher'])) {
				echo <<<H

				<div class="col-sm">
				<br>

						<input type="submit" onclick="location.href='../Assignments/new.php?course={$_GET['course']}';" class="btn btn-success" value="Create">
				</div>

H;
			}
			?>


			</ul>
		</div>



		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
