<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid=$_GET['studentid'];





	
	
?>


<form method="POST" id="myForm" >
	<input type="file" id="pic4" name="pic4" />
	<input hidden type="text" id="ddd" name="ddd" />
	<a style="text-decoration:none;" href="javascript:void();" onclick="upload_consent(<?=$studentid?>);">Upload</a>
</form>