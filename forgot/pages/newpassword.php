<?php
if (file_exists('includes/database.php')) { 
    include_once('includes/database.php'); 
}
if (file_exists('../../includes/database.php')) { 
    include_once('../../includes/database.php'); 
}


$otp = $_GET['otp'];
$email = $_GET['email'];

$otp_student = GetValue('SELECT token FROM tblreset WHERE token=\''.$otp.'\' AND is_inactive=0');



if($otp_student){
	echo'<form id="forgotPasswordForm">
<h5>New Login Credentials</h5>
<input type="text" style="width:250px;" placeholder="Enter new Password" id="newp"/><br>
<input type="text" style="width:250px;" placeholder="Confirm  Password" id="conp"/><br>
</form>
<a class="button" href="javascript:void();" onclick="save_password(\''.$email.'\')">Submit</a>';
  mysqli_query($db_connection,'UPDATE tblreset SET is_inactive=1 WHERE token=\''.$otp.'\' ');
} else {
	echo'Wrong OTP, <a href="../">please try again...</a>';
	mysqli_query($db_connection,'UPDATE tblreset SET is_inactive=1 WHERE token=\''.$otp.'\' ');
}
?>



