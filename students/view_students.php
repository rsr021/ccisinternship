<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$companyid = $_GET['companyid'];

if(isset($_GET['get_student'])){
	include('../email/endorse.php');
}
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center"><?=CompanyName($companyid)?></h3>
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

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Course/Section</th>
				<th hidden>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?
		$count=1;
		$q = 'SELECT companyid, studentid, 
			sectionid, is_cancel FROM tblcompany_ojt
			WHERE companyid='.$companyid;
		//echo $q;
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
			$courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$rw['studentid']);
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.CourseCode($courseid).'-'.SectionCode($rw['sectionid']).'</td>
				<td hidden><input type="text" hidden id="get_name'.$rw['studentid'].'"/></td>';
				$is_endorse = GetValue('SELECT is_endorse FROM tblstudent WHERE studentid='.$rw['studentid']);
				if($is_endorse) {
					echo'<td hidden>DONE</td>';
				} else {
				echo'<td hidden><span id="show_e'.$rw['studentid'].'"><a style="color:blue;" href="javascript:void();" 
				onclick="send_endorsement('.$rw['studentid'].')">SEND ENDORSEMENT LETTER</a></span></td>';
				}
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>

<button class="btn btn-sm btn-secondary" onclick="loadPage('students/endorsement.php','maincontent');">Back</button>
