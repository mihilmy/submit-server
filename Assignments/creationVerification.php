<?php
require_once('assignment.php');
if(isset($_POST['submitNewAssignment'])) {
    $newAssignment = Assignment::createNew($_POST['assignmentName'],$_POST['courseName'], str_replace ("T", " ", $_POST['dueDate']), $_POST['maxScore']);
    
    if($newAssignment != null) {
        echo 'success';
    } else {
        echo 'fail';
    }
} else if(isset($_POST['submitEditAssignment'])){
    $sql = "SELECT id, firstname, lastname FROM MyGuests";
    $result = $conn->query($sql);
    
    if(result != null) {
        $newAssignment = Assignment::parseDbResult($result->fetch_assoc());
        echo 'success';
    } else {
        echo 'fail';
    }
}

?>