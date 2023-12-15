<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



?>

<div class="container">
	<div class="row">
	<?
	
	
	$q = 'SELECT a.companyid, a.studentid, a.sectionid, a.is_ojt, a.is_cancel,
					b.profilepic,b.email
					FROM tblcompany_ojt a, tblstudent b 
					WHERE a.is_ojt=1 AND a.studentid=b.studentid
					AND b.courseid='.$_SESSION['courseid'].'
					AND b.sectionid='.$_SESSION['sectionid'].'';
	
	if (isset($_GET['str'])) { 
		$q .= ' AND (b.firstname LIKE \'%'.$_GET['str'].'%\' 
				or b.lastname LIKE \'%'.$_GET['str'].'%\') ';
	}
	
	if (isset($_GET['companyid'])) {
		if($_GET['companyid']==0){
			$x = ' ';
		} else {
			$x = ' AND a.companyid='.$_GET['companyid'].'';
		}
	}

	$q .= ''.$x.' ORDER BY b.lastname';
	
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
