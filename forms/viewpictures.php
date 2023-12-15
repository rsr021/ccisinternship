<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];
// echo $studentid;
?>
<style>
	
</style>

<?
$rs = mysqli_query($db_connection,'SELECT picturedate, picture, 
			description FROM tblaccomplishment_photo WHERE studentid='.$_SESSION['studentid']);
			while($rw=mysqli_fetch_array($rs)){
				echo'<div align="center">';
				echo date('M d, Y', strtotime($rw['picturedate'])).'<br>';
				echo $rw['description'].'<br>';
				echo'<img src="../page_load/pictures_entry/'.$rw['picture'].'" height="230"/><br><br>';
				echo'</div>';
			}
				?>