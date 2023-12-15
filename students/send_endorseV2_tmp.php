<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if (!isset($_GET['fromdate'])) {
    $_GET['fromdate'] = date('Y-m-d', strtotime('-20 days'));
}


if (isset($_GET['fromdate'])){$from = date('Y-m-d',strtotime($_GET['fromdate']));}
if (isset($_GET['todate'])){$to = date('Y-m-d',strtotime($_GET['todate']));}

?>

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th style="width:2%;">#</th>
                <th style="width:15%;">Application  Date</th>
                <th style="width:25%;">Student Name</th>
                <th style="width:10%;">Course/Section</th>
				<th style="width:40%;">Company</th>
				<th style="width:10%;">Status</th>
            </tr>
        </thead>
        <tbody>
		
        <?
		$count=1;
		$q = 'SELECT a.idnum, a.companyid, a.applicationdate, a.is_endorse, a.studentid,
				a.is_reject, a.is_selected, d.sectionid,e.coursecode,d.sectioncode,d.courseid
				FROM tblapplication_tmp a, tblcompany b, tblstudent c, tblsection d, tblcourse e
				WHERE a.companyid=b.companyid AND a.studentid=c.studentid
				AND c.sectionid=d.sectionid AND d.courseid=e.courseid AND
				date(a.applicationdate) >=\''.$from.'\' and date(a.applicationdate) <=\''.$to.'\'   ';
		
		if(isset($_GET['stat'])){
			if($_GET['stat']==0){
				$q .= ' ';
			} else if($_GET['stat']==1){//deployed
				$q .= ' AND a.is_selected=1 ';
			} else if($_GET['stat']==2){//pending
				$q .= ' AND a.is_reject=0 AND a.is_selected=0 ';
			} else {//rejected
				$q .= ' AND a.is_reject=1  ';
			}
		}
		
		if(isset($_GET['courseid'])){
			if($_GET['courseid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.courseid='.$_GET['courseid'].' ';
			}
		}
		
		if(isset($_GET['sectionid'])){
			if($_GET['sectionid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.sectionid='.$_GET['sectionid'].' ';
			}
		}
		
		if(isset($_GET['companyid'])){
			if($_GET['companyid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.companyid='.$_GET['companyid'].' ';
			}
		}
		
		if(isset($_GET['str'])){
			if($_GET['str']==''){
				$q .= ' ';
			} else {
				$q .= ' AND (c.firstname LIKE \'%'.$_GET['str'].'%\'
					OR c.lastname LIKE \'%'.$_GET['str'].'%\'
					OR c.studentno LIKE \'%'.$_GET['str'].'%\'
				
				)';
			}
		}
		//echo $q;
				
		$q .= ' ORDER BY a.applicationdate';
					
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
		$link = 'TINY.box.show({url:\'students/send_endorse.php?companyid='.$rw['companyid'].'&sectionid='.$rw['sectionid'].'&courseid='.$rw['courseid'].'\',width:900,height:300 })';
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.date('M d, Y', strtotime($rw['applicationdate'])).'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.$rw['coursecode'].''.$rw['sectioncode'].'</td>';
				echo'<td>'.CompanyName($rw['companyid']).'</td>';
				
				if($rw['is_reject']==0 && $rw['is_selected']==0){
					echo'<td><span>PENDING</span></td>';
				} else if($rw['is_reject']==1 && $rw['is_selected']==0) {
					echo'<td><span style="color:red;">REJECTED</span></td>';
				} else {
					echo'<td><span style="color:green;">DEPLOYED</span></td>';
				}
				
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>







<table id="headerTable" hidden border="1" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%;">#</th>
                <th style="width:10%;">Apply Date</th>
                <th style="width:20%;">Student Name</th>
                <th style="width:5%;">Course/Section</th>
				<th style="width:55%;">Company</th>
				<th style="width:5%;">Status</th>
            </tr>
        </thead>
        <tbody>
		
        <?
		$count=1;
		$q = 'SELECT a.idnum, a.companyid, a.applicationdate, a.is_endorse, a.studentid,
				a.is_reject, a.is_selected, d.sectionid,e.coursecode,d.sectioncode,d.courseid
				FROM tblapplication_tmp a, tblcompany b, tblstudent c, tblsection d, tblcourse e
				WHERE a.companyid=b.companyid AND a.studentid=c.studentid
				AND c.sectionid=d.sectionid AND d.courseid=e.courseid AND
				date(a.applicationdate) >=\''.$from.'\' and date(a.applicationdate) <=\''.$to.'\'   ';
		
		if(isset($_GET['stat'])){
			if($_GET['stat']==0){
				$q .= ' ';
			} else if($_GET['stat']==1){//deployed
				$q .= ' AND a.is_selected=1 ';
			} else if($_GET['stat']==2){//pending
				$q .= ' AND a.is_reject=0 AND a.is_selected=0 ';
			} else {//rejected
				$q .= ' AND a.is_reject=1  ';
			}
		}
		
		if(isset($_GET['courseid'])){
			if($_GET['courseid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.courseid='.$_GET['courseid'].' ';
			}
		}
		
		if(isset($_GET['sectionid'])){
			if($_GET['sectionid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.sectionid='.$_GET['sectionid'].' ';
			}
		}
		
		if(isset($_GET['companyid'])){
			if($_GET['companyid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND a.companyid='.$_GET['companyid'].' ';
			}
		}
		
		if(isset($_GET['str'])){
			if($_GET['str']==''){
				$q .= ' ';
			} else {
				$q .= ' AND (c.firstname LIKE \'%'.$_GET['str'].'%\'
					OR c.lastname LIKE \'%'.$_GET['str'].'%\'
					OR c.studentno LIKE \'%'.$_GET['str'].'%\'
				
				)';
			}
		}
		//echo $q;
				
		$q .= ' ORDER BY a.applicationdate';
					
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.date('M d, Y', strtotime($rw['applicationdate'])).'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.$rw['coursecode'].''.$rw['sectioncode'].'</td>';
				echo'<td>'.CompanyName($rw['companyid']).'</td>';
				
				if($rw['is_reject']==0 && $rw['is_selected']==0){
					echo'<td><span>PENDING</span></td>';
				} else if($rw['is_reject']==1 && $rw['is_selected']==0) {
					echo'<td><span style="color:red;">REJECTED</span></td>';
				} else {
					echo'<td><span style="color:green;">DEPLOYED</span></td>';
				}
				
			echo'</tr>';
		}
		?>
		</table>