<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



?>



<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <!--<th>Appli. Date</th>-->
                <th>Student Name</th>
                <th>Course/Section</th>
				<th>Apply To - Date Of Application</th>
            </tr>
        </thead>
        <tbody>
        <?
		$q = 'SELECT a.idnum, a.studentid, b.firstname, a.companyid, a.applicationdate, b.courseid,b.sectionid,
		GROUP_CONCAT(CONCAT(c.companyname,\' - \',DATE_FORMAT(a.applicationdate, "%b. %d, %Y - %l:%i %p"), \'<br>\') SEPARATOR \'\') as blaire,
		a.is_endorse, a.is_reject, a.is_selected 
		FROM tblapplication_tmp a, tblstudent b, tblcompany c
		WHERE a.studentid=b.studentid AND a.companyid=c.companyid ';


		if(isset($_GET['courseid'])){
			if($_GET['courseid']==0){
				$q .= '';
			} else {
				$q .= ' AND b.courseid='.$_GET['courseid'].' ';
			}
		}

		if(isset($_GET['sectionid'])){
			if($_GET['sectionid']==0){
				$q .= '';
			} else {
				$q .= ' AND b.sectionid='.$_GET['sectionid'].' ';
			}
		}


		$q .= ' GROUP BY a.studentid ORDER BY b.firstname';


		$count=1;
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
		$courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$rw['studentid']);
		$sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$rw['studentid']);
		  
			echo'<tr >
				<td>'.$count++.'</td>
				<td hidden>'.date("M j, Y", strtotime($rw['applicationdate'])).'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.CourseCode($courseid).''.SectionCode($sectionid).'</td>
				<td>'.$rw['blaire'].'</td>';
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>
