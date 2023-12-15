<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if (isset($_GET['d1'])) {
	$monday_time_in = $_GET['monday_time_in'];
	$monday_time_out = $_GET['monday_time_out'];
	$startTime = DateTime::createFromFormat('H:i', $monday_time_in);
	$endTime = DateTime::createFromFormat('H:i', $monday_time_out);
		if ($startTime !== false && $endTime !== false) {
			if($endTime->format('H:i') == '12:00'){
				$timeDifference = $endTime->diff($startTime);
				$totalHours = $timeDifference->h + ($timeDifference->i / 60);
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			} else {
				$timeDifference = $endTime->diff($startTime);
				$totalHours = ($timeDifference->h + ($timeDifference->i / 60)) - 1;
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			}
		}
}

if(isset($_GET['monday_del'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_dtr'].' WHERE day=\''.$_GET['del'].'\'';
	mysqli_query($db_connection,$q);
}

/************************************************************************************************************/


if (isset($_GET['d2'])) {
	$monday_time_in = $_GET['monday_time_in'];
	$monday_time_out = $_GET['monday_time_out'];
	$startTime = DateTime::createFromFormat('H:i', $monday_time_in);
	$endTime = DateTime::createFromFormat('H:i', $monday_time_out);
		if ($startTime !== false && $endTime !== false) {
			if($endTime->format('H:i') == '12:00'){
				$timeDifference = $endTime->diff($startTime);
				$totalHours = $timeDifference->h + ($timeDifference->i / 60);
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			} else {
				$timeDifference = $endTime->diff($startTime);
				$totalHours = ($timeDifference->h + ($timeDifference->i / 60)) - 1;
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			}
		}
}

if(isset($_GET['monday_del'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_dtr'].' WHERE day=\''.$_GET['del'].'\'';
	mysqli_query($db_connection,$q);
}
		
/************************************************************************************************************/


if (isset($_GET['d3'])) {
	$monday_time_in = $_GET['monday_time_in'];
	$monday_time_out = $_GET['monday_time_out'];
	$startTime = DateTime::createFromFormat('H:i', $monday_time_in);
	$endTime = DateTime::createFromFormat('H:i', $monday_time_out);
		if ($startTime !== false && $endTime !== false) {
			if($endTime->format('H:i') == '12:00'){
				$timeDifference = $endTime->diff($startTime);
				$totalHours = $timeDifference->h + ($timeDifference->i / 60);
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			} else {
				$timeDifference = $endTime->diff($startTime);
				$totalHours = ($timeDifference->h + ($timeDifference->i / 60)) - 1;
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			}
		}
}

if(isset($_GET['monday_del'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_dtr'].' WHERE day=\''.$_GET['del'].'\'';
	mysqli_query($db_connection,$q);
}


/************************************************************************************************************/


if (isset($_GET['d4'])) {
	$monday_time_in = $_GET['monday_time_in'];
	$monday_time_out = $_GET['monday_time_out'];
	$startTime = DateTime::createFromFormat('H:i', $monday_time_in);
	$endTime = DateTime::createFromFormat('H:i', $monday_time_out);
		if ($startTime !== false && $endTime !== false) {
			if($endTime->format('H:i') == '12:00'){
				$timeDifference = $endTime->diff($startTime);
				$totalHours = $timeDifference->h + ($timeDifference->i / 60);
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			} else {
				$timeDifference = $endTime->diff($startTime);
				$totalHours = ($timeDifference->h + ($timeDifference->i / 60)) - 1;
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			}
		}
}

if(isset($_GET['monday_del'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_dtr'].' WHERE day=\''.$_GET['del'].'\'';
	mysqli_query($db_connection,$q);
}


/************************************************************************************************************/


if (isset($_GET['d5'])) {
	$monday_time_in = $_GET['monday_time_in'];
	$monday_time_out = $_GET['monday_time_out'];
	$startTime = DateTime::createFromFormat('H:i', $monday_time_in);
	$endTime = DateTime::createFromFormat('H:i', $monday_time_out);
		if ($startTime !== false && $endTime !== false) {
			if($endTime->format('H:i') == '12:00'){
				$timeDifference = $endTime->diff($startTime);
				$totalHours = $timeDifference->h + ($timeDifference->i / 60);
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			} else {
				$timeDifference = $endTime->diff($startTime);
				$totalHours = ($timeDifference->h + ($timeDifference->i / 60)) - 1;
				$q = 'INSERT INTO '.$_SESSION['tmp_dtr'].' SET day=\''.
									$_GET['monday_day'].'\',timein=\''.
									$monday_time_in.'\',timeout=\''.
									$monday_time_out.'\',totalhours=\''.
									$totalHours.'\'  ';
				mysqli_query($db_connection, $q);
				//echo $q;
				//echo $totalHours;
			}
		}
}

if(isset($_GET['monday_del'])){
	$q = 'DELETE FROM '.$_SESSION['tmp_dtr'].' WHERE day=\''.$_GET['del'].'\'';
	mysqli_query($db_connection,$q);
}
	
	
	
?>

