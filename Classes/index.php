<?php
	session_start();
		if(!isset($_GET['course'])) {
			header('Location:'.$_SERVER['REQUEST_URI'].'/../../login.php');
		}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Amazos</title>

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
				<a href="#" class="navbar-brand"><img src="../img/logo.png" alt="UMD"> </a>
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
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th>Assignment</th>
						<th>Max Score</th>
						<th>Due Date</th>
						<th>Assignment Link</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					$coursee = [1,"Project1",'100','11/4/2017','aid'];
					$courses = array($coursee , $coursee );
					$courseCode = $_GET['course'];
					foreach ($courses as $course) {
						echo <<<H
						<tr>
							<th scope="row">$course[0]</th>
							<td>$course[1]</td>
							<td>$course[2]</td>
							<td> $course[3]</td>
							<td> <a href="../Assigments/index.php?course=$courseCode&aid=$course[4]">Assignment<a> <td>
						</tr>
H;
					}
					?>
				</tbody>
			</table>
			
		<?php
		$example = [1,"DoublyLinkedList",$_GET['course'],'11/4',100,1,'11/4'];
		
		//echo $example[0];
		?>
			
		</div>
	 	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>