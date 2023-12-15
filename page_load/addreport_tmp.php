<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if (isset($_GET['actid'])) {
  
	$q = 'INSERT INTO '.$_SESSION['tmp_report'].' SET actid=\''.$_GET['actids'].'\'';
	mysqli_query($db_connection, $q);
					
}

if(isset($_GET['actidtodelete'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_report'].' WHERE actid='.$_GET['del'];
	mysqli_query($db_connection,$q);
}



?>

