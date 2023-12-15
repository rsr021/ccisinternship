<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$sectionid = $_GET['sectionid'];

if (isset($_GET['sectionid']) && isset($_GET['sectioncode'])) {
	if($_GET['sectionid']== 0) { //Adding
		mysqli_query($db_connection,'INSERT INTO tblsection SET sectioncode=\''.
									 urldecode($_GET['sectioncode']).'\',courseid='.
									 $_GET['courseid'].',max_slots='.
									 $_GET['max_slots'].' ');
		
	} else { //Updating
		mysqli_query($db_connection,'UPDATE tblsection SET sectioncode=\''.
									 urldecode($_GET['sectioncode']).'\',courseid='.
									 $_GET['courseid'].',max_slots='.
									 $_GET['max_slots'].' WHERE sectionid='.$sectionid);
	}
	$sectionid=0;
}



$sectioncode = GetValue('SELECT sectioncode FROM tblsection WHERE sectionid='.$_GET['sectionid']);
$courseid = GetValue('SELECT courseid FROM tblsection WHERE sectionid='.$_GET['sectionid']);
$max_apply = GetValue('SELECT max_apply FROM tblsection WHERE sectionid='.$_GET['sectionid']);
$max_slots = GetValue('SELECT max_slots FROM tblsection WHERE sectionid='.$_GET['sectionid']);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Section List</h3>
	<div align="right">
	<a hidden href="javascript:void();" onclick="loadPage('pages/addfaculty.php','show_facultyadd')" class="btn btn-primary btn-sm btn-icon-split" >
    <!--<span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 3px;"></i>
    </span>
    <span class="text">Add Faculty</span>-->
	</a>
</div> 	
</div>

<div align="right">
   <? echo '<select style="width:300px;height:25px;" id="courseid");">';
				echo '<option value="0">Select Course</option>';
				$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse order by coursename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
				}
            echo '</select>'; ?>&nbsp;
			<input style="width:250px;height:25px;" type="text" value="<?=$sectioncode?>" placeholder="Input section code..." id="sectioncode">
			<input type="number" hidden value="<?=$max_apply?>" placeholder="Input maximum application..." id="max_apply">
			<input type="number" hidden value="<?=$max_slots?>" placeholder="Input maximum application..." id="max_slots">
			<button class="btn btn-primary" onclick="addedit_section(<?=$sectionid?>)">
				<? if ($sectionid){ echo 'Update';} else {echo 'Add'; } ?>
				</button>
	
</div><br>



<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Course</th>
						<th>Section </th>
						<th hidden>Max Apply</th>
						<th>Applied</th>
						<th hidden>Remaining Slots</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?
				$count=1;
				$rs = mysqli_query($db_connection,'SELECT sectionid, sectioncode, courseid,max_slots
										, max_apply, applicants FROM tblsection ORDER BY sectioncode');
				while($rw=mysqli_fetch_array($rs)){
					echo'<tr>
						<td>'.$count++.'</td>
						<td>'.CourseCode($rw['courseid']).'</td>
						<td>'.$rw['sectioncode'].'</td>
						<td hidden>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$rw['max_slots'].'</td>
						<td>'.$rw['applicants'].'</td>
						<td hidden>to follow</td>
						<td><a href="javavascript:void();" 
						onclick="loadSubContent(\'pages/section.php?sectionid='.$rw['sectionid'].'\',\'maincontent\');">Edit</a></td>
					</tr>';
				}
				?>
				</tbody>	
			</table>
		</div>
	</div>
</div>