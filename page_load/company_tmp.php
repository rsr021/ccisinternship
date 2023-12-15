<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

	
$is_ojt = GetValue('SELECT is_ojt FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
?>

    <table id="companies"  class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Company Name</th>
				<th>Slot</th>
				<th>Intern Type</th>
				<th>Feedback</th>
				<th>VIEW</th>
				<?
				if($is_ojt){
					echo'<th hidden>&nbsp;</th>';
				} else {
					echo'<th>ACTION</th>';
				}
				?>
			</tr>
		</thead>

	<tbody>
	<?
	//typeid
	$q = 'SELECT * FROM tblcompany WHERE is_active=1 ';
	
	if(isset($_GET['typeid'])){
		if($_GET['typeid']==0){
			$q .= '';
		} else {
			$q .= ' AND typeid='.$_GET['typeid'].' ';
		}
	}
	
	if(isset($_GET['str'])){
		if($_GET['str']){
			$q .= ' AND companyname LIKE \'%'.$_GET['str'].'%\'';
		}
	}
		
	
	$q .= ' ORDER BY companyname';
	$rs = mysqli_query($db_connection,$q);
	$count=1;
	while($rw = mysqli_fetch_array($rs)){
		$link = "TINY.box.show({url:'pages/companyview2.php?hide_it&companyid=".$rw['companyid']."',width:800,height:650 })";
		$link2 = "TINY.box.show({url:'pages/rating.php?hide_it&companyid=".$rw['companyid']."',width:800,height:450 })";
		
		echo'<tr>
			<td>'.$count++.'</td>
			<td>'.$rw['companyname'].'</td>
			<td>'.$rw['max_apply']-$rw['applicants'].'</td>
			<td>'.Type($rw['typeid']).'</td>';
			echo'<td><a href="javascript:void();" onclick="'.$link2.'">Rate Me!!</a></td>';
			echo'<td><a href="javascript:void();" onclick="'.$link.'">VIEW</a></td>';
			$is_updated = GetValue('SELECT is_updated FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
			$is_apply = GetValue('SELECT studentid FROM tblapplication WHERE companyid='.
											$rw['companyid'].' AND studentid='.
											$_SESSION['studentid'].' AND status=0');
											
			if($is_ojt){
				echo'<td hidden>&nbsp;</td>';
			} else {
				if($is_updated){
					echo'<td><a href="javascript:void();" onclick="apply('.$rw['companyid'].');">SELECT</a></th>';
				} else if($is_apply == 1){
					echo'<td>Applied</td>';
				} else {
					echo'<td><a href="javascript:void();" onclick="swal(\'Error\',\'Please update first your profile.\',\'error\');">APPLY</a></th>';
				}
			}
		echo'</tr>';
	}
	?>
        </tbody>
    </table>

