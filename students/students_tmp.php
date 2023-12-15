<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }




?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Student Application</h3>
	<!--<div align="left">Search:&nbsp;<input type="text" id="search_ref" name="search_ref" 
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	-->
	<!--<div align="right">
<a href="javascript:void();" onclick="save_entry()" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 2px;"></i> 
    </span>
    <span class="text">Add Student Ojt</span>-->
</a>
</div> 	
</div>
<?
$jscript = 'loadSubContent(\'students/tmplist_student_tmp.php?courseid=\'+object(\'courseid\').value+\'&sectionid=\'+object(\'sectionid\').value,\'show_list\')';
?>
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
echo '</select>&nbsp;'; ?>
<? echo'<button onclick="openCustom(\'forms/generate_report.php?courseid=\'+object(\'courseid\').value
													+\'&sectionid=\'+object(\'sectionid\').value,1000,1000)">Generate Report</button>';?> 

<button hidden onclick="loadPage('students/send_endorseV2.php','maincontent');">SEND ENDORSEMENT</button>


</div><br>

<div id="show_list">
	<? include('tmplist_student_tmp.php');?>
</div>
