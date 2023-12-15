<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];

// echo $studentid;

$picture = GetValue('SELECT certificate_completion FROM tblstudent WHERE studentid='.$studentid);
?>
<?
echo'<img src="../page_load/certificate_completion/'.$picture.'" height="420"/>';
?>