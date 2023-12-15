<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$jscript = 'loadSubContent(\'students/liststudents_tmp.php?courseid=\'+object(\'courseid\').value
										+\'&sectionid=\'+object(\'sectionid\').value+\'&stat=\'+object(\'stat\').value
										+\'&str=\'+object(\'str\').value,\'x_x\')';

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Student List</h3>
</div> 	
</div>

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
	
	<select  onchange="<?=$jscript?>" style="width:100px;height:30px;" id="stat">
		<option value="0">ALL</option>
		<option value="1">DEPLOYED</option>
		<option value="2">PENDING/NO-OJT</option>
	</select>
	
	<input style="height:30px;" type="text" id="str" onkeyup="<?=$jscript?>" placeholder="search student here..."/>
</div><br>
<div id="x_x">
	<? include('liststudents_tmp.php'); ?>
</div>

