<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


if(isset($_GET['facultyid'])){
	mysqli_query($db_connection,'UPDATE tblfaculty SET 
			sectionid='.$_GET['sectionid'].' WHERE facultyid='.$_GET['facultyid']);
}
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Faculty List</h3>
	<div align="right">
	<!--<a href="javascript:void();" onclick="loadPage('pages/addfaculty.php','show_facultyadd')" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 3px;"></i>
    </span>
    <span class="text">Add Faculty</span>
</a>-->
</div> 	
</div>

<div id="show_facultyadd">
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Full Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Course</th>
						<th>Assign Sec</th>
					</tr>
				</thead>
				<tbody>
				<?
				$count=1;
				$rs = mysqli_query($db_connection,'SELECT facultyid, username, firstname, middlename,
						lastname, email, sectionid, courseid FROM tblfaculty WHERE is_approve=1 AND facultyid!=1
						ORDER BY firstname');
				while($rw=mysqli_fetch_array($rs)){
					echo'<tr>
						<td>'.$count++.'</td>
						<td>'.$rw['firstname'].' '.$rw['lastname'].'</td>
						<td>'.$rw['username'].'</td>
						<td>'.$rw['email'].'</td>
						<td>'.CourseCode($rw['courseid']).'</td>';
						
						
						
						$link = "TINY.box.show({url:'pages/getsection.php?facultyid=".$rw['facultyid']."',width:600,height:90 })";

						echo'</td>
						<td><a href="javavascript:void();" onclick="'.$link.'">Approve</a></td>
					</tr>';
				}
				?>
				</tbody>	
			</table>
		</div>
	</div>
</div>
</div>