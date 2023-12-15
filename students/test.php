<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


if(isset($_GET['insertendorsement'])){
	$companyid = $_GET['companyid'];
	$courseid = $_GET['courseid'];
	$sectionid = $_GET['sectionid'];
	include('../email/endorse.php');
}

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Reports</h3>
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

<div align="right">
<? echo '<select style="width:250px;height:30px;" id="courseid");">';
				echo '<option value="0">ALL COURSES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse order by coursename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
				}
            echo '</select>'; ?>
			
<? echo '<select style="width:250px;height:30px;" id="sectionid");">';
	echo '<option value="0">ALL SECTIONS</option>';
	$rs1 = mysqli_query($db_connection,'SELECT sectionid, sectioncode from tblsection order by sectioncode');
	while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
		if ($sectionid==$rw1['sectionid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw1['sectionid'].'" '.$sel.'>'.$rw1['sectioncode'].'</option>';
	}
echo '</select>'; ?>

<? echo '<select style="width:250px;height:30px;" id="companyid");">';
	echo '<option value="0">ALL COMPANIES</option>';
	$rs1 = mysqli_query($db_connection,'SELECT companyid, companyname from tblcompany order by companyname');
	while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
		if ($companyid==$rw1['companyid']) { $sel = 'selected="selected"'; }
		echo '<option value="'.$rw1['companyid'].'" '.$sel.'>'.$rw1['companyname'].'</option>';
	}
echo '</select>'; ?>
</div>
<br>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%;">Course</th>
				<th>Company</th>
				<th>VIEW</th>
				<th>Count</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
		
        <?
		$q = 'SELECT c.courseid, a.companyid, GROUP_CONCAT(a.studentid) as name, a.studentid, a.sectionid, a.is_cancel,
							GROUP_CONCAT(CONCAT(c.firstname,\' \', c.lastname, \'<br>\') SEPARATOR \'\') as blaire, 
							GROUP_CONCAT(CONCAT(e.coursecode,\' \',d.sectioncode, \'<br>\') SEPARATOR \'\') as paula,
							CONCAT(COUNT(a.studentid)) as persec
							FROM tblcompany_ojt a, tblcompany b, tblstudent c, tblsection d, tblcourse e
							WHERE a.companyid=b.companyid AND a.studentid=c.studentid
							AND a.sectionid=d.sectionid AND d.courseid=e.courseid
							GROUP BY a.companyid,d.sectionid ORDER BY d.sectionid';
		//echo $q;
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
			$courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$rw['studentid']);
			$is_endorse = GetValue('SELECT is_endorse FROM tblstudent WHERE studentid='.$rw['studentid']);
			$link = 'TINY.box.show({url:\'students/send_endorse.php?companyid='.$rw['companyid'].'&sectionid='.$rw['sectionid'].'&courseid='.$rw['courseid'].'\',width:900,height:300 })';
			            

			echo'<tr>
				<td>'.CourseCode($courseid).'-'.SectionCode($rw['sectionid']).'</td>';
				echo'<td>'.CompanyName($rw['companyid']).'</td>';
				echo'<td><a href="javascript:void();" onclick="openCustom(\'forms/view_endorse.php?companyid='.$rw['companyid'].'&sectionid='.$rw['sectionid'].'&courseid='.$rw['courseid'].'\',600,600);">VIEW</a></td>';
				echo'<td>'.$rw['persec'].'</td>';
				if($is_endorse){
					echo'<td>DONE</td>';
				} else {
					echo'<td><a href="javascript:void();" onclick="'.$link.'">SEND ENDORSEMENT</a></td>';
				}
			echo'</tr>';
			//send_endorsement()"
		}
		?>
		</table>
		</div>
	</div>
</div>
