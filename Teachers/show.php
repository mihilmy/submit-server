<?php require_once("teachersController.php");
require_once("../Services/utils.php"); redirectIfNotLoggedIn(); ?>
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
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="#" class="navbar-brand"><img src="../img/logo.png" alt="UMD"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
    	<header>
				<h3><u><?php echo $_SESSION['current_teacher']->getName(); ?></u></h3>
    	</header>

    	<div class="row">
    		<label class="col-md-2">Email: </label>
    		<p><?php echo $_SESSION['current_teacher']->getEmail(); ?></p>
    	</div>

    	<div class="row">
    		<label class="col-md-2">Directory ID: </label>
    		<p><?php echo $_SESSION['current_teacher']->getDirectoryId(); ?></p>
    	</div>

    	<div class="row">
    		<h3 class="col-md-2"><u>Classes</u></h3>
    	</div>

    	<div class="row">
            <div class="col-md-3">
    		<table class="table">
    			<?php $classes = show(); foreach($classes as $class) {
					$assignmentsUrl = "\"../Classes/showAssignments.php?course=".$class."\"";
                    $studentsUrl = "\"../students/index.php?course=".$class."\"";
                ?>
                    <tr>
                    <td><h4><?php echo $class ?></h4></td>
                    <td><a href=<?php echo $studentsUrl; ?> ><button type="button" class="btn btn-danger">Students</button></a></td>
                    <td><a href=<?php echo $assignmentsUrl; ?> ><button type="button" class="btn btn-danger">Assignments</button></a></td>
                    </tr>
                    <?php
                } ?>
    		</table>
            </div>
    	</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
