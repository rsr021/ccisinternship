<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid=$_GET['studentid'];





	
	
?>


<form method="POST" id="myForm" >
	<input type="file" id="pic3" name="pic3" />
	<input hidden type="text" id="yyy" name="yyy" />
	<a style="text-decoration:none;" href="javascript:void();" onclick="upload_profilepic(<?=$studentid?>);">Upload</a>
</form>