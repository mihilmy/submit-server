<?php
require_once("../Services/DatabaseProvider.php");
	session_start();
	$conn = DatabaseProvider::getInstance()->getConnectionString();
	$sql = "SELECT * FROM assignments NATURAL JOIN student_classes where directory_ID='{$_SESSION['current_studentArray']['directoryId']}' and
	assignment_ID='{$_GET['assignmentid']}'";
	$result = $conn->query($sql);
	 if($result->num_rows == 0 && !isset($_SESSION['current_teacher'])) {
		 header("Location: ../Classes/showClasses.php");
	 } else {
		 $row = $result->fetch_assoc();
		 $className = $row['class_name'];
	 }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Assignment</title>

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
				<a href="../Classes/showClasses.php" class="navbar-brand"><img src="../img/logo.png" alt="UMD"> </a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>


				</div>

			</div>
		</div>

		<div id="mainDiv">
		<div class="container-fluid">
			<b> Assignment Info</b>
			<?php


			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			//$className = $_GET['course'];
            $assignmentid = $_GET['assignmentid'];
            $sql = "SELECT * FROM Assignments where assignment_ID=$assignmentid";
            $result = $conn->query($sql);
				echo "(Class: $className)";

	       ?>
			<ul class="list-group">

			<?php


            if ($result->num_rows > 0) {
                    // output data of each row
                $row = $result->fetch_assoc();

                    echo <<<H
                    <li class="list-group-item">
                        <span class="badge badge-info">{$row['name']}</span>
                            Assignment Name
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">{$row['due_date']}</span>
                           Due Date
                    </li>

                    <li class="list-group-item">
                        <span class="badge badge-info">{$row['max_score']}</span>
                           maxScore
                    </li>
H;

            } else {
                echo "0 results";
}

			 if(!isset($_SESSION['current_teacher']))  {
							echo <<<H
							<div class="col-sm">
							<br>

									<input type="submit" onclick="location.href='#';" class="btn btn-success" value="Submit">
							</div>
H;
			} else {
				echo <<<H
				<div class="col-sm">
				<br>

						<input type="submit" onclick="location.href='edit.php?assignmentid={$row['assignment_ID']}';" class="btn btn-success" value="Edit">
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
