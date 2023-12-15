<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];



$courseid = GetValue('select courseid FROM tblstudent where studentid='.$studentid);
$sectionid = GetValue('select sectionid FROM tblstudent where studentid='.$studentid);
$bio = GetValue('select bio FROM tblstudent where studentid='.$studentid);
?>

<span style="font-size:15px;">Course:</span>
<select id="courseid">
   <? echo '<option value="0">Select your Course</option>';
	$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse order by coursename');
	while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
		if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
	}
echo '</select>'; ?>


<span style="font-size:15px;">Section:</span>
<select id="sectionid">
   <? echo '<option value="0">Select your Section</option>';
	$rs2 = mysqli_query($db_connection,'SELECT sectionid, sectioncode from tblsection order by sectioncode');
	while ($rw2 = mysqli_fetch_array($rs2)) { $sel = '';
		if ($sectionid==$rw2['sectionid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw2['sectionid'].'" '.$sel.'>'.$rw2['sectioncode'].'</option>';
	}
echo '</select><br>'; ?>
			
<span style="font-size:15px;">BIO:</span>
<input type="text" style="width:350px;" value="<?=$bio?>" id="bio"/>
<button onclick="update_bio(<?=$studentid?>)">Save</button>


