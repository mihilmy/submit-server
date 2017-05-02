<?php
	session_start();
		//if(!isset($_SESSION['username'])) {
		//	header('Location:'.$_SERVER['REQUEST_URI'].'/../../login.php');
		//}
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
			<b> My Classes:</b>
			<?php
            require_once("../Services/DatabaseProvider.php");
			$directoryID = "253754205";
			$conn = DatabaseProvider::getInstance()->getConnectionString();
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
            $sql = "SELECT * FROM student_classes where directory_ID=$directoryID";
            $result = $conn->query($sql);
			echo "(Directory ID: $directoryID)";
			
	       ?>
			<ul class="list-group">
			<?php
			
            if ($result->num_rows > 0) {
                    // output data of each row
                while($row = $result->fetch_assoc()) {
					$className = $row['class_name'];
					
					
					$sql = "SELECT * FROM Assignments where class_name='$className'";
					$result2 = $conn->query($sql);
					$number_of_assignments = $result2->num_rows;
                    echo <<<H
				<li class="list-group-item"><a href="../Classes/showAssignments.php?course=$className">$className</a> <span class="badge">Assignments: $number_of_assignments</span></li>
H;
                }
            } else {
                echo "0 results";
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