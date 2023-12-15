<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


//companycode, companyname, signatory, position, address, notarizationdate, max_apply
	
if (isset($_GET['paula'])){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$notify_date = date('Y-m-d', strtotime('-1 month', strtotime($end_date)));
	
	
	mysqli_query($db_connection,'INSERT INTO tblcompany set companycode=\''.
							$_POST['companycode'].'\',companyname=\''.
							$_POST['companyname'].'\',signatory=\''.
							$_POST['signatory'].'\',position=\''.
							$_POST['position'].'\',address=\''.
							$_POST['address'].'\',notarizationdate=\''.
							$_POST['notarizationdate'].'\',max_apply=\''.
							$_POST['max_apply'].'\',start_date=\''.
							$_POST['start_date'].'\',end_date=\''.
							$_POST['end_date'].'\',notify_date=\''.$notify_date.'\' ');
}


if (isset($_GET['blaire'])){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$notify_date = date('Y-m-d', strtotime('-1 month', strtotime($end_date)));
	$q ='UPDATE tblcompany set companycode=\''.
							$_POST['companycode'].'\',companyname=\''.
							$_POST['companyname'].'\',signatory=\''.
							$_POST['signatory'].'\',position=\''.
							$_POST['position'].'\',address=\''.
							$_POST['address'].'\',notarizationdate=\''.
							$_POST['notarizationdate'].'\',max_apply=\''.
							$_POST['max_apply'].'\',start_date=\''.
							$_POST['start_date'].'\',end_date=\''.
							$_POST['end_date'].'\',notify_date=\''.$notify_date.'\' WHERE companyid='.$_GET['companyid'];
	// echo $q;
	mysqli_query($db_connection,$q);
}







$todays = date('Y-m-d');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Company List</h3>
	<div align="right">
	<a href="javascript:void();" onclick="loadPage('pages/companyadd.php','show_company')" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 3px;"></i>
    </span>
    <span class="text">Add Company</span>
</a>
</div> 	
</div>

<div id="show_company">
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th hidden>Code</th>
						<th>Company Name</th>
						<th>VIEW</th>
						<th>Start Date</th>
						<th>End Date</th>
						<!--<th>Max Slot</th>-->
						<!--<th>Applied Students</th>-->
						<!--<th>Remaining Slots</th>-->
						<th>EDIT INFO</th>
						<th style="width:200px;">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$count=1;
				
				
				$rs = mysqli_query($db_connection,'SELECT notify_date,start_date,end_date,companyid,companycode,  companyname, 
									max_apply, applicants FROM tblcompany ORDER BY companyname');
				while($rw=mysqli_fetch_array($rs)){//include('../email/notify_coordinator.php');
					$startDate = strtotime($rw['start_date']);
					$endDate = strtotime($rw['end_date']);
					$currentDate = $startDate;
					
					// Calculate the difference in seconds
					$difference = $endDate - $currentDate;
					
					// Convert the difference to months
					$differenceInMonths = floor($difference / (30 * 24 * 60 * 60));
					
					echo'<tr>
						<td>'.$count++.'</td>
						<td hidden>'.$rw['companycode'].'</td>
						<td>'.$rw['companyname'].'</td>';
					$link = "TINY.box.show({url:'pages/companyview.php?hide_it&companyid=".$rw['companyid']."',width:800,height:450 })";
						echo'<td><a href="javavascript:void();" onclick="'.$link.'">VIEW</a></td>';
						echo'<td>'.date("M d, Y",strtotime($rw['start_date'])).'</td>';
						echo'<td>'.date("M d, Y",strtotime($rw['end_date'])).'</td>';
						echo'<td><a href="javscript:void();" onclick="loadPage(\'pages/companyupdate.php?companyid='.$rw['companyid'].'\',\'maincontent\')">Edit</a></td>';
					
						// Check if start date is approaching end date
						if ($differenceInMonths <= 1) {
							echo '<td><span style="color: red;">Please renew the MOA for this company.</span></td>';
							//insert
							//include('../email/send_email.');
						} else {
							echo '<td>&nbsp;</td>';
						}
						
					echo'</tr>';
				}
				?>
				</tbody>	
			</table>
		</div>
	</div>
</div>
</div>