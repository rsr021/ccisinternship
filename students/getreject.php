<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if(isset($_GET['applicationid'])){
	$studentid = GetValue('SELECT studentid FROM tblapplication WHERE applicationid='.$_GET['applicationid']);
	include('../email/reject.php');
}
?>

