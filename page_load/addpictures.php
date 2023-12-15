<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid=$_GET['studentid'];





	
	
?>


<form method="POST" id="myForm" >
	<input type="text" id="des" placeholder="input description..." name="des" /><br><br>
	<input type="file" id="pic5" name="pic5" />
	<a style="text-decoration:none;" href="javascript:void();" onclick="upload_pic_entry();">Upload</a>
</form>