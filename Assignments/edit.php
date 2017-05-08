<?php
require_once("../Services/DatabaseProvider.php");
require_once("../students/student.php");
require_once("../Teachers/teacher.php");
require_once("Services/utils.php"); redirectIfNotLoggedIn();
session_start();
if(!isset($_SESSION['current_teacher']) || !isset($_GET['assignmentid'])) {
	header("Location: ../Classes/showClasses.php");
}
$conn = DatabaseProvider::getInstance()->getConnectionString();
$sql = "SELECT * FROM assignments INNER JOIN classes ON assignments.class_name = classes.name where teacher_ID={$_SESSION['current_teacher']->getDirectoryId()} and
assignment_ID={$_GET['assignmentid']}";
$result = $conn->query($sql);
if($result->num_rows == 0) {
	//echo $sql;
	header("Location: ../Classes/showClasses.php");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Edit Assignment</title>

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
	<script>
		function validateform(){
		var name=document.getElementById('name').value;
		var max_score=document.getElementById('score').value;
		//var due_date= document.getElementById('date').value;
		//var test_cases= document.getElementById('test_cases').value;

		if ( isNaN(max_score) || max_score ==='') {
			alert("From is invalid");
			return false;
			}
}
</script>
	<body>
		<!--NAVIGATION-->
		<div class="navbar navbar-default navbar-fixed-top nav-color"  role="navigation">
			<div class="container">
			 <!--MOBILE MENU-->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>

						<a href="../" class="navbar-brand"><img src="../img/logo.png" alt="UMD"></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
			<header class="header">
				<h1 class="col-sm-offset-2">Edit Assignment</h1>
			</header>
		</div>
			<?php
			require_once('assignment.php');
			require_once("../Services/DatabaseProvider.php");
				$assignmentid = $_GET['assignmentid'];
				$conn = DatabaseProvider::getInstance()->getConnectionString();
				$sql = "SELECT * FROM Assignments where assignment_ID=$assignmentid";
				$result = $conn->query($sql);
				$assignment = Assignment::parseDbResult($result->fetch_assoc());


			?>
	 	<div class="container">
	 		<form action="creationVerification.php" method="post" class="form-horizontal" onsubmit="return validateform()">

			<div class="form-group">
				<label class="col-sm-2 control-label">Assignment Name: </label>
				<div class="col-sm-4">
				<?php
				$san = $assignment->getName();
					echo "<input id='name' type='text' name='assignmentName' class='form-control' value='{$san}'required>"
				?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Max Score: </label>
				<div class="col-sm-4">
					<?php
					$san = $assignment->getMaxScore();
						echo "<input id='score' type='text' name='maxScore' class='form-control' value='{$san}'required>"
					?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Due Date: </label>
				<div class="col-sm-4">
				<?php
				$san = str_replace (" ", "T", $assignment->getDueDateString());
					echo "<input type='datetime-local' name='dueDate' class='form-control' value='{$san}'required>"
				?>
				</div>
			</div>


			<div class="col-sm-offset-2">
				<input name="submitEditAssignment" type="submit" class="btn btn-success" value="Submit Changes">
			</div>

			<?php
                $toEcho = "<input type='hidden' name='assignmentid' value='{$_GET['assignmentid']}'>";
			echo $toEcho;
			?>
			</form>
	 	</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
