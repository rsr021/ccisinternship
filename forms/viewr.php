<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];

// echo $studentid;

$picture = GetValue('SELECT cv FROM tblstudent WHERE studentid='.$studentid);
?>
<?
echo'<img src="../page_load/cv/'.$picture.'" height="600"/>';
?>