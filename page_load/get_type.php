<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


	


$typeid=GetValue('SELECT typeid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); 
?>

<select style="" id="typeid">
   <? echo '<option value="0" style="color:gray">Internship Type</option>';
	$rs1 = mysqli_query($db_connection,'SELECT typeid, type from tblinterntype order by type');
	while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
		if ($typeid==$rw1['typeid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw1['typeid'].'" '.$sel.'>'.$rw1['type'].'</option>';
	}
echo '</select>'; ?>

<a  style="font-size:12px;text-decoration:none;" href="javascript:void()" 
onclick="save_type(<?=$_SESSION['studentid']?>)">Save</a>

