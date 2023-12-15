<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$studentid = $_GET['studentid'];


if(isset($_GET['studentid'])){
	$q = 'UPDATE tblstudent SET is_president=0 WHERE courseid='.$_SESSION['courseid'].' AND sectionid='.$_SESSION['sectionid'].' ';
	mysqli_query($db_connection,$q);
	mysqli_query($db_connection,'UPDATE tblstudent SET is_president=1 WHERE studentid='.$_GET['studentid']);
}



if(isset($_GET['get_ss'])){
	mysqli_query($db_connection,'UPDATE tblcompany_ojt SET is_ojt=1 WHERE studentid='.$_GET['get_ss']);
	mysqli_query($db_connection,'UPDATE tblcompany_ojt SET start_intern=NOW() WHERE studentid='.$_GET['get_ss']);
	mysqli_query($db_connection,'UPDATE tblstudent SET is_ojt=1 WHERE studentid='.$_GET['get_ss']);
	
}

if(isset($_GET['get_ending'])){//studentid
	mysqli_query($db_connection,'UPDATE tblcompany_ojt SET is_end=1 WHERE studentid='.$_GET['get_ending']);
	mysqli_query($db_connection,'UPDATE tblcompany_ojt SET end_intern=NOW() WHERE studentid='.$_GET['get_ending']);
	mysqli_query($db_connection,'UPDATE tblstudent SET is_end=1 WHERE studentid='.$_GET['get_ending']);
	
	$minus = 1;
	$companyid = GetValue('SELECT companyid FROM tblstudent WHERE studentid='.$_GET['get_ending']);
	mysqli_query($db_connection,'UPDATE tblcompany SET applicants = applicants - 1 WHERE companyid='.$companyid);
	
	$sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$_GET['get_ending']);
	mysqli_query($db_connection,'UPDATE tblsection SET applicants = applicants - 1 WHERE sectionid='.$sectionid);
	
	
}


?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Class &nbsp; <?=CourseCode($_SESSION['courseid'])?>&nbsp; <?=SectionCode($_SESSION['sectionid'])?></h3>
	<div align="right">
	<a  hidden href="javascript:void();" onclick="loadPage('pages/addfaculty.php','show_facultyadd')" class="btn btn-primary btn-sm btn-icon-split" ></a>
</div> 	
</div>
<div align="left">

<? $class=GetValue('SELECT studentid FROM tblstudent WHERE is_president=1 AND courseid='.$_SESSION['courseid'].' AND sectionid='.$_SESSION['sectionid'].''); ?>
<h5 hidden>Class President:&nbsp; <? if($class) {echo StudentName($class);}?>


<? /*echo '<select id="studentid");">';
				echo '<option value="0">Select Class Representative</option>';
				$rs1 = mysqli_query($db_connection,'SELECT studentid,firstname from tblstudent WHERE courseid='.$_SESSION['courseid'].' AND sectionid='.$_SESSION['sectionid'].' order by firstname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($studentid==$rw1['studentid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['studentid'].'" '.$sel.'>'.StudentName($rw1['studentid']).'</option>';
				}
            echo '</select>
			
			<button onclick="assign_president();">Save</button>
			
			';*/ ?>
			
</h5>
</div>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Student Name</th>
						<th hidden>Assign Class President</th>
						<th>OJT Status</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?
				$q = 'SELECT is_end,firstname,studentid, is_endorse, is_ojt, is_president FROM tblstudent WHERE 
									courseid='.$_SESSION['courseid'].' AND sectionid='.$_SESSION['sectionid'].' ORDER BY firstname';
						//echo $q;
				
				$count=1;
				$rs = mysqli_query($db_connection,$q);
				while($rw=mysqli_fetch_array($rs)){
					echo'<tr>
						<td>'.$count++.'</td>
						<td>'.StudentName($rw['studentid']).'</td>
						<td hidden>';
						$is_presi = GetValue('SELECT is_president FROM tblstudent WHERE studentid='.$rw['studentid']);
						
						$is_presss = GetValue('SELECT is_president FROM tblstudent WHERE studentid='.$rw['studentid'].' AND courseid='.$_SESSION['courseid'].' AND sectionid='.$_SESSION['sectionid'].'' );
						echo'<input hidden type="text" id="studentname'.$rw['studentid'].'" value="'.StudentName($rw['studentid']).'"/>';
						if($is_presi){
							echo'<span style="color:green;">Class President</span>';
						} else {
							echo'<a href="javascript:void();" onclick="assign_president('.$rw['studentid'].');">Assign</a>';
						}
						
						echo'</td>';
						
						if($rw['is_endorse']==1 && $rw['is_ojt']==0){
							echo'<td><a href="javascript:void();" onclick="is_ojt_start('.$rw['studentid'].');">Click here if the OJT has started.</a></td>';
							echo'<td style="color:blue;">HAVE OJT</td>';
						} else if($rw['is_ojt']==1 && $rw['is_end']==0) {
							echo'<td><a href="javascript:void();" onclick="is_ojt_end('.$rw['studentid'].');"><span style="color:red;">Click here if the OJT has ended.</span></a></td>';
							echo'<td style="color:green;">DEPLOYED</td>';
						} else if($rw['is_end']==1) {
							echo'<td><i>ENDED</i></td>';
							echo'<td><i>ENDED</i></td>';
						} else {
							echo'<td>Waiting for Company to accept</td>';
							echo'<td>PENDING/NO-OJT</td>';
						}
					echo'</tr>';
				}
				?>
				</tbody>	
			</table>
		</div>
	</div>
</div>