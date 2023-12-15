<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



?>
<div class="container">
	<div class="row">
	<?
	
	$q = 'SELECT a.companyid, a.studentid, a.sectionid, a.is_ojt, a.is_cancel,
					b.profilepic,b.email
					FROM tblcompany_ojt a, tblstudent b 
					WHERE a.is_ojt=1 AND a.studentid=b.studentid';
					
		
	if(isset($_GET['str'])){
		$q .= ' AND (b.firstname LIKE \'%'.$_GET['str'].'%\'
					OR b.lastname LIKE \'%'.$_GET['str'].'%\' )';
	}
	
	if(isset($_GET['courseid'])){
		if($_GET['courseid']==0){
			$q .= '';
		}else{
			$q .= ' AND b.courseid='.$_GET['courseid'].'';
		}
	}
	
	if(isset($_GET['sectionid'])){
		if($_GET['sectionid']==0){
			$q .= '';
		}else{
			$q .= ' AND b.sectionid='.$_GET['sectionid'].'';
		}
	}
	
	if(isset($_GET['companyid'])){
		if($_GET['companyid']==0){
			$q .= '';
		}else{
			$q .= ' AND a.companyid='.$_GET['companyid'].'';
		}
	}
	

	
	
	$q .= '  ORDER BY b.lastname'; 
	
	
	$count=1;
	$rs = mysqli_query($db_connection,$q);
	while($rw = mysqli_fetch_array($rs)){
		//$reportid = GetValue('SELECT reportid FROM tbl');
		echo '<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
				<center>
					<div class="card">
						<div class="card__img" style="background-image: linear-gradient(45deg, #9e1e1e, #800000, red);">
						<div class="dropdown">
						<button class="dropdown-btn"><img src="images/dots.svg" alt=""></button>
						</div>
						</div>
						<div class="card__avatar">
						<img class="rounded-circle" height="100px" width="100px" src="page_load/profilepic/'.$rw['profilepic'].'" alt="">
						</div>
						<div class="card__title">'.StudentName($rw['studentid']).'</div>
						<div class="card__subtitle">'.$rw['email'].'</div>
						<a href="javascript:void();" class="btn btn-info btn-sm" 
						onclick="loadPage(\'students/viewprofile_coor.php?studentid='.$rw['studentid'].'\',\'maincontent\')">View Profile</a>
						<div class="my-3">
							<button hidden class="btn btn-outline-danger btn-sm">Notify</button>
							<button class="btn btn-outline-success btn-sm" 
							onclick="openCustom(\'forms/alltask.php?studentid='.$rw['studentid'].'\',900,900)">Weekly Report</button>
						</div>
					</div>
				</center>
				</div>';
	}
	?>
	</div>
</div>


<!-- <div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Application Date</th>
                <th>Student Name</th>
                <th>Course/Section</th>
				<th>Apply To</th>
				<th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?
		$count=1;
		$rs = mysqli_query($db_connection,'SELECT a.applicationid, a.applicationdatetime, a.studentid,
								a.companyid, a.status, a.is_reject,
								b.courseid, b.sectionid
								FROM tblapplication a, tblstudent b
								WHERE a.studentid=b.studentid AND a.status=0');
		while($rw = mysqli_fetch_array($rs)){
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.date("M j, Y", strtotime($rw['applicationdatetime'])).'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.CourseCode($rw['courseid']).'-'.SectionCode($rw['sectionid']).'</td>
				<td>'.CompanyName($rw['companyid']).'</td>
				<td hidden><input type="text" hidden id="getname" value="'.StudentName($rw['studentid']).'"/></td>
				<td><span id="showy'.$rw['applicationid'].'"><a style="color:red;" href="javascript:void();">Reject</a>
				&nbsp;&nbsp;&nbsp;<a href="javascript:void();" onclick="approve_student('.$rw['applicationid'].')">Approve</a></span></td>
			</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div> -->
