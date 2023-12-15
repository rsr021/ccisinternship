<?php
if (file_exists('includes/database.php')) { 
    include_once('includes/database.php'); 
}
if (file_exists('../../includes/database.php')) { 
    include_once('../../includes/database.php'); 
}

$email = $_GET['email'];
//echo $email;

$rs = mysqli_query($db_connection, "SELECT email FROM tblfaculty WHERE email='$email'");
$rw = mysqli_fetch_assoc($rs);

if ($rw) {
    echo '<span id="showy">Email Matched<br>';
    echo '<button onclick="send_opt(\''.$rw['email'].'\');">SEND OTP</button></span>';
	
	
	echo'<div hidden id="show_you">';
	echo'<input type="text" style="width:250px;" placeholder="Enter OTP" id="otp"/><br>';
	echo'<button onclick="match_otp(\''.$rw['email'].'\')">Submit</button>';
	echo'</div>';
	
	
} else {
    echo '<span style="color:red;">Invalid Email</span><br>';
    echo '<a href="javascript:void();" onclick="loadPage(\'forgotpassword_faculty.php\',\'content_f\');">Back</a>';
}
?>
