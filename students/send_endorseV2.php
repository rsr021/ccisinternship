<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$jscript = 'loadSubContent(\'students/send_endorseV2_tmp.php?fromdate=\'+object(\'fromdate\').value
										+\'&todate=\'+object(\'todate\').value
										+\'&stat=\'+object(\'stat\').value
										+\'&courseid=\'+object(\'courseid\').value
										+\'&sectionid=\'+object(\'sectionid\').value
										+\'&companyid=\'+object(\'companyid\').value
										+\'&str=\'+object(\'str\').value,\'x_x\')';

$from = date('Y-m-d', strtotime('-20 days'));
//$from = date('Y-m-d');
$to = date('Y-m-d');


?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Application of Students</h3>
<div><a style="text-decoration:none;" href="javascript:void();" onclick="loadPage('students/a_endorsement.php','maincontent');">View Endorsement</a></div>
</div> 	
</div>

<div align="right">
FROM:&nbsp;<input onchange="<?=$jscript?>" style="width:129px;height:30px;" value="<?=$from?>" type="date" id="fromdate" />
TO:&nbsp;<input onchange="<?=$jscript?>" style="width:129px;height:30px;" value="<?=$to?>" type="date" id="todate" />
<select onchange="<?=$jscript?>" id="stat" style="width:129px;height:30px;">
	<option value="0">ALL</option>
	<option value="1">DEPLOYED</option>
	<option value="2">PENDING</option>
	<option value="3">REJECTED</option>
</select>
<button><?=Excel();?></button>
</div><br>
<div align="right">
<? echo '<select style="width:250px;height:30px;" id="courseid" onchange="'.$jscript.'">';
				echo '<option value="0">ALL COURSES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse order by coursename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
				}
            echo '</select>&nbsp;'; ?>
<? echo '<select style="width:250px;height:30px;" id="sectionid" onchange="'.$jscript.'">';
	echo '<option value="0">ALL SECTIONS</option>';
	$rs1 = mysqli_query($db_connection,'SELECT sectionid, sectioncode from tblsection order by sectioncode');
	while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
		if ($sectionid==$rw1['sectionid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw1['sectionid'].'" '.$sel.'>'.$rw1['sectioncode'].'</option>';
	}
echo '</select>'; ?>

<? echo '<select style="width:250px;height:30px;" id="companyid" onchange="'.$jscript.'">';
				echo '<option value="0">ALL COMPANIES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT companyid, companyname from tblcompany order by companyname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($companyid==$rw1['companyid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['companyid'].'" '.$sel.'>'.$rw1['companyname'].'</option>';
				}
            echo '</select>&nbsp;'; ?>
<input style="height:30px;" type="text" id="str" onkeyup="<?=$jscript?>" placeholder="search student here..."/>
</div><br>

<div id="x_x">
	<? include('send_endorseV2_tmp.php'); ?>
</div>
