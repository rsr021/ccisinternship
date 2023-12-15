<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$facultyid = $_GET['facultyid'];

?>
<h6>Notify <span style="color:blue;"><?=FacultyName($facultyid)?></span></h6>
<input style="width:600px;" type="text" id="textmes" placeholder="input message..."/>&nbsp;
<button onclick="send_notification(<?=$facultyid?>)">Send</button>