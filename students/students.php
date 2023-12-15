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

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Appli. Date</th>
                <th>Student Name</th>
                <th>Course/Section</th>
				<th>Apply To</th>
				<th>VIEW</th>
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
								WHERE a.studentid=b.studentid');
		while($rw = mysqli_fetch_array($rs)){
		$x = $rw['status'];
		$y = $rw['is_reject'];
		if ($x == 1) {$bg = 'bgcolor="#FFF4F3"';}
		else if ($y == 1) {$bg = 'bgcolor="pink"';}
		else {$bg = 'bgcolor:""';}
		
		$status = GetValue('SELECT status from tblapplication WHERE studentid='.$rw['studentid']);
			 $view = 'openCustom(\'forms/students.php?studentid='.$rw['studentid'].'\',900,900)';
		  
			echo'<tr '.$bg.'>
				<td>'.$count++.'</td>
				<td>'.date("M j, Y", strtotime($rw['applicationdatetime'])).'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.CourseCode($rw['courseid']).'-'.SectionCode($rw['sectionid']).'</td>
				<td>'.CompanyName($rw['companyid']).'</td>
				<td hidden><input type="text" hidden id="getname'.$rw['applicationid'].'" value="'.StudentName($rw['studentid']).'"/></td>
				<td><a href="javascript:void();" onclick="'.$view.'">VIEW</a></td>';
				
				if($status){
					echo'<td>APPLIED</td>';
				} else {
					echo'<td><span id="showy'.$rw['applicationid'].'"><a style="color:red;" href="javascript:void();" onclick="reject_student('.$rw['applicationid'].')">Reject</a>
					&nbsp;&nbsp;&nbsp;<a href="javascript:void();" onclick="approve_student('.$rw['applicationid'].')">Approve</a></span></td>';
				}
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>
