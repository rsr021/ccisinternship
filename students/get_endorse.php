<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }






if(isset($_GET['insertendorsement'])){
	$companyid = $_GET['companyid'];
	$courseid = $_GET['courseid'];
	$sectionid = $_GET['sectionid'];
	include('../email/endorse.php');
}



?>