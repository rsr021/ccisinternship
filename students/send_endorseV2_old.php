<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }






if(isset($_GET['insertendorsement'])){
	$companyid = $_GET['companyid'];
	$courseid = $_GET['courseid'];
	$sectionid = $_GET['sectionid'];
	mysqli_query($db_connection,'UPDATE tblapplication_tmp 
							SET is_endorse=1 WHERE companyid='.
							$companyid.' AND courseid='.
							$courseid.' AND sectionid='.
							$sectionid.' AND is_endorse=0');
	include('../email/endorse.php');
}



?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Sending Endorsement Letter</h3>
	<!--<div align="left">Search:&nbsp;<input type="text" id="search_ref" name="search_ref" 
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	-->
	<!--<div align="right">
<a href="javascript:void();" onclick="save_entry()" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 2px;"></i> 
    </span>
    <span class="text">Add Student Ojt</span>-->
<!--</a>-->

<div><a style="text-decoration:none;" href="javascript:void();" onclick="loadPage('students/a_endorsement.php','maincontent');">View Endorsement</a></div>
</div> 	
</div>

<br>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%;">#</th>
                <th style="width:10%;">Course/Section</th>
				<th>Company</th>
				<th>Students - Date of Application</th>
				<th>Status</th>
            </tr>
        </thead>
        <tbody>
		
        <?
		$count=1;
		$q = 'SELECT a.idnum, GROUP_CONCAT(a.studentid) as name, a.companyid, a.applicationdate, a.is_endorse, 
				a.is_reject, a.is_selected, d.sectionid,e.coursecode,d.sectioncode,d.courseid
				,GROUP_CONCAT(CONCAT(c.firstname,\' \', c.lastname,\' - \', DATE_FORMAT(a.applicationdate, "%b. %d, %Y - %l:%i %p"), 
				 CASE WHEN a.is_endorse = 1 THEN "  <span style=\'color:green;\'>ENDORSED</span>" ELSE " <span style=\'color:red;\'>NOT ENDORSED YET</span>" END,\'<br>\') SEPARATOR \'\') as blaire
				,GROUP_CONCAT(CONCAT(e.coursecode,\' \',d.sectioncode, \'<br>\') SEPARATOR \'\') as paula
				FROM tblapplication_tmp a, tblcompany b, tblstudent c, tblsection d, tblcourse e
				WHERE a.companyid=b.companyid AND a.studentid=c.studentid
				AND c.sectionid=d.sectionid AND d.courseid=e.courseid
				GROUP BY a.companyid,d.sectionid ORDER BY d.sectionid';
					
		//echo $q;
		//GROUP BY a.companyid,d.sectionid ORDER BY d.sectionid';
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
		$link = 'TINY.box.show({url:\'students/send_endorse.php?companyid='.$rw['companyid'].'&sectionid='.$rw['sectionid'].'&courseid='.$rw['courseid'].'\',width:900,height:300 })';
		//$is_endorse = GetValue('SELECT is_endorse FROM tblapplication_tmp WHERE companyid='.$rw['companyid'].' AND sectionid='.$rw['sectionid'].' AND courseid='.$rw['courseid'].' ');	
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.$rw['coursecode'].''.$rw['sectioncode'].'</td>';
				echo'<td>'.CompanyName($rw['companyid']).'</td>';
				echo'<td>'.$rw['blaire'].'</td>';
				
				//if($is_endorse){
				//	echo'<td>Sent</td>';
				//} else {
					echo'<td><span><a href="javascript:void();" onclick="'.$link.'">Send Endorsement</a></span></td>';
				//}
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>
