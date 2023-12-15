<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];

// echo $studentid;

$bio = GetValue('SELECT bio FROM tblstudent WHERE studentid='.$studentid);
$skills = GetValue('SELECT skills FROM tblstudent WHERE studentid='.$studentid);
$other_info = GetValue('SELECT other_info FROM tblstudent WHERE studentid='.$studentid);
?>
<h4><?=StudentName($studentid)?></h4>
<p>Basic Information:<br><?=$bio?></p>
<p>My Skills:<br><?=$skills?></p>
<p>Other Information:<br><?=$other_info?></p>

