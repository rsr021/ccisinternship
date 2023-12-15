<?php
if (file_exists('includes/database.php')) { 
    include_once('includes/database.php'); 
}
if (file_exists('../../includes/database.php')) { 
    include_once('../../includes/database.php'); 
}


$newp = $_GET['newp'];
$email = $_GET['email'];

mysqli_query($db_connection,'UPDATE tblstudent SET studentpassword=\''.md5($newp).'\' WHERE email=\''.$email.'\' ');

echo'<span>Success. &nbsp; <a href="../">Click here to login...</a></span>'
?>



