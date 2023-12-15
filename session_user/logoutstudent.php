<?php
session_start();
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
//AuditStudent($_SESSION['studentid'],'Logout');
session_destroy();


header("location:../");

?>