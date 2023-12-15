<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

session_destroy();


header("location: ../");

?>