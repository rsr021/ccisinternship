<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$y = GetValue('SELECT other_info FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
				
?>

<textarea style="width:500px;height:150px;" type="text" id="set_other" name="set_other"><?=$y?></textarea>
<button onclick="save_other();">Save</button>