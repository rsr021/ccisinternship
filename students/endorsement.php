<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }




?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Endorsement</h3>
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

<input type="text" style="width:250px;height:30px;" placeholder="search student here..." id="str" />
</div>
<br>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Company</th>
                <th>Student Name</th>
                <th>Course/Section</th>
                <th>Count</th>
				<th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?
		$count=1;
		$q = 'SELECT a.companyid, GROUP_CONCAT(a.studentid) as name, a.studentid, a.sectionid, a.is_cancel,
							GROUP_CONCAT(CONCAT(c.firstname,\' \', c.lastname, \'<br>\') SEPARATOR \'\') as blaire, 
							GROUP_CONCAT(CONCAT(e.coursecode,\' \',d.sectioncode, \'<br>\') SEPARATOR \'\') as paula,
							CONCAT(COUNT(a.studentid)) as persec
							FROM tblcompany_ojt a, tblcompany b, tblstudent c, tblsection d, tblcourse e
							WHERE a.companyid=b.companyid AND a.studentid=c.studentid
							AND a.sectionid=d.sectionid AND d.courseid=e.courseid
							GROUP BY a.companyid ORDER BY d.sectionid';
		//echo $q;
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
			$courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$rw['studentid']);
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.CompanyName($rw['companyid']).'</td>
				<td>'.$rw['blaire'].'</td>
				<td>'.$rw['paula'].'</td>
				<td>'.$rw['persec'].'</td>
				<td><a style="color:blue;" href="javascript:void();" 
				onclick="loadPage(\'students/view_students.php?companyid='.$rw['companyid'].'\',\'maincontent\')">VIEW</a>
			</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>
