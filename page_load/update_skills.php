<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$x = GetValue('SELECT skills FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
				
?>

<textarea style="width:500px;height:150px;" type="text" id="set_skills" name="set_skills"><?=$x?></textarea>
<button onclick="save_skills();">Save</button>