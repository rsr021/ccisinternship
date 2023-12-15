<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$idnum = $_GET['idnum'];

// echo $studentid;

$picture = GetValue('SELECT picture FROM tblaccomplishment_photo WHERE idnum='.$idnum);
?>
<?
echo'<img src="../page_load/pictures_entry/'.$picture.'" height="420"/>';
?>