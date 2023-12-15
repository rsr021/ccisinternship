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
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Course/Section</th>
				<th>Status</th>
				<th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?
		$count=1;
		$q = 'SELECT firstname, lastname, middlename, studentid, courseid, sectionid, 
					is_ojt, is_updated FROM tblstudent WHERE (is_updated=1 OR is_updated=0) ';
		
		if(isset($_GET['courseid'])){
			if($_GET['courseid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND courseid='.$_GET['courseid'].' ';
			}
		}
		
		if(isset($_GET['sectionid'])){
			if($_GET['sectionid']==0){
				$q .= ' ';
			} else {
				$q .= ' AND sectionid='.$_GET['sectionid'].' ';
			}
		}
		
		if(isset($_GET['stat'])){
			if($_GET['stat']==0){
				$q .= ' ';
			} else if($_GET['stat']==1){
				$q .= ' AND is_ojt=1 ';
			} else{
				$q .= ' AND is_ojt=0 ';
			}
		}
		
		
		if(isset($_GET['str'])){
			if($_GET['str']==''){
				$q .= ' ';
			} else {
				$q .= ' AND (firstname LIKE \'%'.$_GET['str'].'%\'
					OR lastname LIKE \'%'.$_GET['str'].'%\'
					OR studentno LIKE \'%'.$_GET['str'].'%\'
				
				)';
			}
		}
		
		$q .= ' ORDER BY firstname';
		
		
		$rs = mysqli_query($db_connection,$q);
		while($rw = mysqli_fetch_array($rs)){
		$x = $rw['is_ojt'];
		if ($x == 1) {$bg = 'bgcolor="#FFF4F3"';}
		
		else {$bg = 'bgcolor:""';}
			//$view = 'openCustom(\'forms/students.php?studentid='.$rw['studentid'].'\',900,900)';
		  
			echo'<tr '.$bg.'>
				<td>'.$count++.'</td>
				<td>'.$rw['firstname'].'</td>
				<td>'.$rw['middlename'].'</td>
				<td>'.$rw['lastname'].'</td>
				<td>'.CourseCode($rw['courseid']).'-'.SectionCode($rw['sectionid']).'</td>';
				/*if($rw['is_ojt']){
					echo'<td><span style="color:green;">Already have OJT</span></td>';
				} else {
					echo'<td><span style="color:red;">No OJT</span></td>';
				}*/
				
				
				if($rw['is_endorse']==1 && $rw['is_ojt']==0){
					//echo'<td><a href="javascript:void();" onclick="is_ojt_start('.$rw['studentid'].');">Click here if the OJT has started.</a></td>';
					echo'<td style="color:blue;">HAVE OJT</td>';
				} else if($rw['is_ojt']==1 && $rw['is_end']==0) {
					//echo'<td><a href="javascript:void();" onclick="is_ojt_end('.$rw['studentid'].');"><span style="color:red;">Click here if the OJT has ended.</span></a></td>';
					echo'<td style="color:green;">DEPLOYED</td>';
				} else if($rw['is_end']==1) {
					//echo'<td><i>ENDED</i></td>';
					echo'<td><i>ENDED</i></td>';
				} else {
					//echo'<td>Waiting for Company to accept</td>';
					echo'<td>PENDING/NO-OJT</td>';
				}
				
				if($rw['is_updated']){
					echo'<td>UPDATED</td>';
				} else {
					echo'<td>NOT UPDATED</td>';
				}
				
				
			echo'</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>