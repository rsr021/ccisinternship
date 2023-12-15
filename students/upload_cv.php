<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid=$_GET['studentid'];





	
	
?>


<form method="POST" id="myForm" >
	<input type="file" id="pic2" name="pic2" />
	<input hidden type="text" id="xxx" name="xxx" />
	<a style="text-decoration:none;" href="javascript:void();" onclick="upload_cv(<?=$studentid?>);">Upload</a>
</form>