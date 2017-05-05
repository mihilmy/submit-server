<?php require_once("Services/utils.php");
session_start();
if(isset($_SESSION['current_teacher'])) {
  header("Location: Teachers/show.php");
} elseif (isset($_SESSION['current_student'])) {
  header("Location: Students/show.php");
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
		<link rel="stylesheet" href="style.css">
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

            <a href="" class="navbar-brand"><img src="img/logo.png" alt="UMD"></a>
        </div>
      </div>
    </div>
    <div class="container">
    	<header>
    		<h1><u>Log In</u></h1>
    	</header>

    <?php $message = getMessage(); if ($message) { ?>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <?php echo $message; ?>
		</div>
   	<?php } ?>

		<form action="Services/authController.php" method="post" class="form-horizontal">

			<div class="form-group">
				<label class="col-sm-1 control-label">Directory ID: </label>
				<div class="col-sm-4">
					<input type="text" name="directoryId" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-1 control-label">Password: </label>
				<div class="col-sm-4">
					<input type="password" name="password" class="form-control" required>
				</div>
			</div>

			<button type="submit" class="col-sm-offset-1 btn btn-primary">Log In</button>
		</form>

  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
