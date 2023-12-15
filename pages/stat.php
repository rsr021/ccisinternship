<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if(isset($_GET['xxx'])){
	include('../email/notify_faculty.php');
}

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">OJT Status of Sections</h3>
	<div align="right">
	<a hidden href="javascript:void();" onclick="loadPage('pages/addfaculty.php','show_facultyadd')" class="btn btn-primary btn-sm btn-icon-split" >
    <!--<span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 3px;"></i>
    </span>
    <span class="text">Add Faculty</span>-->
	</a>
</div> 	
</div>




<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
				<thead>
					<tr>
						<th width="2%">#</th>
						<th width="5%">Course</th>
						<th width="6%">Section</th>
						<th hidden>Max Apply</th>
						<th width="10%">Student Count</th>
						<th width="4%">Applied</th>
						<th width="30%">Faculty-in-charge</th>
						<th hidden>Remaining Slots</th>
						<th width="5%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?
				$count=1;
				$rs = mysqli_query($db_connection,'SELECT COUNT(b.studentid) as ccc,a.sectionid, a.sectioncode, a.courseid
										, a.max_apply, a.applicants 
										FROM tblsection a, tblstudent b
										WHERE a.sectionid=b.sectionid GROUP by a.sectionid
										ORDER BY a.applicants DESC');
				while($rw=mysqli_fetch_array($rs)){
					$facultyid = GetValue('SELECT facultyid FROM tblfaculty WHERE courseid='.
																	$rw['courseid'].' AND sectionid='.
																	$rw['sectionid'].'' );
					echo'<tr>
						<td>'.$count++.'</td>
						<td>'.CourseCode($rw['courseid']).'</td>
						<td>'.$rw['sectioncode'].'</td>
						<td hidden>'.$rw['max_apply'].'</td>
						<td align="center">'.$rw['ccc'].'</td>
						<td>'.$rw['applicants'].'</td>
						<td>'.FacultyName($facultyid).'</td>
						<td hidden>to follow</td>';
						
						$link = 'TINY.box.show({url:\'pages/stat_message.php?facultyid='.$facultyid.'\',width:700,height:100 })';
						echo'<td><a href="javavascript:void();" 
						onclick="'.$link.'">NOTIFY</a></td>
					
					</tr>';
				}
				?>
				</tbody>	
			</table>
		</div>
	</div>
</div>