<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid=$_GET['studentid'];
	
	
?>

<form method="POST" id="myForm" >
	<input type="file" id="pic_c" name="pic_c" />
	<input hidden type="text" id="firstname" name="firstname" />
	<a style="text-decoration:none;" href="javascript:void();" 
	onclick="upload_certificate_completion(<?=$studentid?>);">Upload</a>
</form>