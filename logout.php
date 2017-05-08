<?php
if(isset($_SESSION)) {session_unset();};
header("Location: index.php");
?>
