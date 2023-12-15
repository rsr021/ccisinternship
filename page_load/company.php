<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

	$a = GetValue('SELECT firstname FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$c = GetValue('SELECT resume FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$d = GetValue('SELECT cv FROM tblstudent WHERE studentid='.$_SESSION['studentid']);

	if(($a!='')&&($c!='')&&($d!='')){
		mysqli_query($db_connection,'UPDATE tblstudent SET is_updated=1 WHERE studentid='.$_SESSION['studentid']);
	}
/*
$isExists = GetValue('Select studentid from tblregistration WHERE semid='.
							  $_GET['semid'].' AND studentid='.$_GET['studentid']) + 0;
							  
		if ($isExists==0) {		
*/

/*if (isset($_GET['companyid'])) {
    $isExists = GetValue('SELECT studentid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . ' AND status=0') + 0;
    $isApply = GetValue('SELECT studentid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . '  AND status=1') + 0;
    
    $com = GetValue('SELECT companyid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . ' AND status=0');
    $com2 = GetValue('SELECT companyid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . ' AND status=1');

    if ($isExists == 0) {
        if ($isApply == 0) {
            mysqli_query($db_connection, 'INSERT INTO tblapplication SET applicationdatetime=NOW(), studentid=' . $_SESSION['studentid'] . ',companyid=' . $_GET['companyid'] . ', status=0');
            $success = '<script type="text/javascript">setTimeout(function () { swal("Application", "Successfully Added", "success");}, 200);</script>';
        } else {
            $err = '<script type="text/javascript">setTimeout(function () { swal("Notice", "You already have a Company to OJT which is ' . CompanyName($com2) . '.","info");}, 200);</script>';
        }
    } else {
        $err = '<script type="text/javascript">setTimeout(function () { swal("Notice", "You have already applied to a company (' . CompanyName($com) . '). Please wait for the feedback of OJT Coordinator.", "info");}, 200);</script>';
    }
}*/

if (isset($_GET['companyid'])) {
    //$isExists = GetValue('SELECT studentid FROM tblapplication_tmp WHERE studentid=' . $_SESSION['studentid'] . ' AND status=0') + 0;
    //$isApply = GetValue('SELECT studentid FROM tblapplication_tmp WHERE studentid=' . $_SESSION['studentid'] . '  AND status=1') + 0;
    
    //$com = GetValue('SELECT companyid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . ' AND status=0');
    //$com2 = GetValue('SELECT companyid FROM tblapplication WHERE studentid=' . $_SESSION['studentid'] . ' AND status=1');

	$is_count = GetValue('SELECT COUNT(studentid) FROM tblapplication_tmp WHERE studentid='.$_SESSION['studentid'].' AND is_reject=0');
	$is_exist = GetValue('SELECT studentid FROM tblapplication_tmp WHERE studentid='.$_SESSION['studentid'].' 
														AND companyid='.$_GET['companyid'].' AND is_reject=0') + 0;
	
	if($is_count<3){
		if ($is_exist==0){
			$courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
			$sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
			
			mysqli_query($db_connection,'INSERT INTO tblapplication_tmp SET applicationdate=NOW(), studentid='.
															$_SESSION['studentid'].',companyid='.
															$_GET['companyid'].',courseid='.
															$courseid.',sectionid='.
															$sectionid.'');
			
			include('../email/send_email_apply.php');
			$success = '<script type="text/javascript">setTimeout(function () { swal("Application", "Successfully Added", "success");}, 200);</script>';
		} else {
			$err = '<script type="text/javascript">setTimeout(function () { swal("Notice", "You have already selected this company.", "info");}, 200);</script>';
  
		}
	} else {
		$err = '<script type="text/javascript">setTimeout(function () { swal("Notice", "You have already selected to 3 a companies. Please wait for the feedback of OJT Coordinator.", "info");}, 200);</script>';
  
	}
}



if(isset($_GET['getcompany'])){
	mysqli_query($db_connection,'INSERT INTO tblrating SET studentid='.
									$_SESSION['studentid'].',description=\''.
									$_POST['description'].'\',companyid='.
									$_GET['getcompany'].', datetime_rate=NOW(),rating='.$_GET['rating'].' ');
}
?>
<style>
   

    .d {
        width: 90%;
        margin: auto;
        padding: 15px;
        background-color: #fff6e5;
        border: 1px solid #f3e9d2;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: auto;
    }

    .title {
        color: #d14b28;
        text-align: left;
        font-size: 25px;
        margin-bottom: 10px;
        padding-top: 10px;
    }

    #companies {
        font-family: 'Arial', sans-serif;
        font-size: 0.9rem;
    }

    #companies thead th {
        background-color: #a22a2a;
        color: #fff;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #a22a2a;
        color: #fff;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        color: #d14b28;
        text-decoration: none;
        cursor: pointer;
    }

    a:hover {
        text-decoration: underline;
    }
	.info-group {
        display: flex;
        justify-content: space-between;
    }
    .rank, .company-name, .average-rating {
        margin: 0;
    }

    .rank {
        font-weight: bold;
        font-size: 20px;
        color: #a22a2a;
    }

    .company-name {
        font-size: 18px;
        color: #333;
    }

    .average-rating {
        font-size: 16px;
        color: #666;
    }
</style>
<div class="d" align="left">
	<div>
        Ratings (Top 5 Companies)
        <br><br>

        <?php
        $query = 'SELECT c.companyname, AVG(r.rating) AS avg_rating FROM tblcompany c LEFT JOIN tblrating r ON c.companyid = r.companyid GROUP BY c.companyid ORDER BY avg_rating DESC LIMIT 5';
        $rs = mysqli_query($db_connection, $query);

        $rank = 1; // Initialize rank

        while ($rw = mysqli_fetch_array($rs)) {
            echo '<div class="info-group">';
            echo '<p class="rank"><b>Rank:</b> ' . $rank++ . '</p>'; // Increment rank after each iteration
            echo '<p class="company-name" align="left"> ' . $rw['companyname'] . '</p>';
            echo '<p class="average-rating"><b>Average Rating:</b> ' . number_format($rw['avg_rating'], 2) . '</p>';
            echo '</div>';
        }
        ?>
    </div><br>
	
	
	<div style="font-size:12px;">
		<? $provid = GetValue('SELECT provid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
        <i>Nearby companies to your address:
        <br>
		<?
		if($provid){
			$count = 1;
			$rs = mysqli_query($db_connection,'SELECT companyid,provid,cityid FROM tblcompany WHERE provid='.$provid);
			while($rw = mysqli_fetch_array($rs)){
				echo $count++.'.&nbsp;'.CompanyName($rw['companyid']).'&nbsp;-&nbsp;('.City($rw['cityid']).',&nbsp;'.Province($rw['provid']).')<br>';
			}
		} else {
			echo'n/a';
		}
		?>
		
		</i>
    </div>
	
	<? if($success){echo $success;} ?>
	<? if($err){echo $err;} ?>
	<div class="title">
		LIST OF INTERNSHIP ESTABLISHMENT
	</div>
	<div align="right">
		<? echo'<input style="width:250px;height:28px;" onkeyup="loadSubContent(\'page_load/company_tmp.php?str=\'+this.value+\'&typeid=\'+object(\'typeid\').value,\'show_company\');" type="text" id="str" placeholder="search company here..."/>';?>
		<?php echo '<select style="width:120px;height:28px; class="form-control" id="typeid" 
				onchange="loadSubContent(\'page_load/company_tmp.php?typeid=\'+this.value+\'&str=\'+object(\'str\').value,\'show_company\');" >';
                echo '<option value="0" style="color:gray">ALL TYPES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT typeid, type from tblinterntype order by type');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($typeid==$rw1['typeid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['typeid'].'" '.$sel.'>'.$rw1['type'].'</option>';
				}
            echo '</select>'; ?>
	</div>
	<div id="show_company">
		<? include('company_tmp.php'); ?>
	</div>
  </div>
</div>
