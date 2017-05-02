
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
            <a href="#" class="navbar-brand"><img src="../img/logo.png" alt="UMD"></a>
        </div>
        
          
      </div>
    </div>
   	
    <div id="mainDiv">
    <?php
require_once('assignment.php');
require_once("../Services/DatabaseProvider.php");
if(isset($_POST['submitNewAssignment'])) {
    $newAssignment = Assignment::createNew($_POST['assignmentName'],$_POST['courseName'], str_replace ("T", " ", $_POST['dueDate']), $_POST['maxScore']);
      if(isset($_FILES['uploaded_file'])) {
        // Make sure the file was sent without errors
        if($_FILES['uploaded_file']['error'] == 0) {
          // Connect to the database
          $dbLink = DatabaseProvider::getInstance()->getConnectionString(); 
          if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
          }
       
          // Gather all required data
          $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
          $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
          $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
          $size = intval($_FILES['uploaded_file']['size']);
          
          // Create the SQL query
          $query = "
            INSERT INTO `tests` (
              `test_file_name`, `test_file`, `number_of_test_cases`, `assignment_ID`)
            VALUES (
              '{$name}', '{$data}',{$_POST['numTestCases']},{$newAssignment->getId()})";
        //echo "<pre>{$query}</pre>";;
          // Execute the query
          $result = $dbLink->query($query);
       
          // Check if it was successfull
          if($result) {
            
          }
          else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
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
    
    if($newAssignment != null) {
        echo 'The assignment has been succefully created, do not update the page';
        sleep(1);
        header("Location: ../Classes/showAssignments.php?course={$_POST['courseName']}");  
    } else {
        echo 'failed';
    }
} else if(isset($_POST['submitEditAssignment'])){
    $sql = "SELECT * FROM Assignments where assignment_id={$_POST['assignmentid']}";
    $conn = DatabaseProvider::getInstance()->getConnectionString();
    $result = $conn->query($sql);
    if($result != null) {
        $newAssignment = Assignment::parseDbResult($result->fetch_assoc());
        $newAssignment->setDueDate(str_replace ("T", " ", $_POST['dueDate']));
        $newAssignment->setName($_POST['assignmentName']);
        $newAssignment->setMaxScore($_POST['maxScore']);

        echo 'success';
    } else {
        echo 'fail';
    }
    $conn->close();
}

?>
  
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?php 



?>




