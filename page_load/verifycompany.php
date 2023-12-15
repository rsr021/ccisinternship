<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

	
	
if(isset($_GET['idnum'])){
	$companyid = $_GET['companyid'];
	$courseid = $_GET['courseid'];
	$sectionid = $_GET['sectionid'];
	
	$max_apply_per_sectiond = GetValue('SELECT max_slots FROM tblsection WHERE sectionid='.$sectionid.'');
	$is_max = GetValue('SELECT COUNT(studentid) FROM tblcompany_ojt WHERE sectionid='.$sectionid.' 
											AND companyid='.$companyid.'');
	//2 == 2
	if($is_max == $max_apply_per_sectiond){
		$s = '<div style="color:red;" class="blink">Section is full.</div>';
	} else {
			//mysqli_query($db_connection,'UPDATE tblapplication_tmp SET is_selected=1 WHERE idnum='.$_GET['idnum']);
			mysqli_query($db_connection,'UPDATE tblapplication_tmp SET is_reject=1 WHERE studentid='.
																		$_SESSION['studentid'].' AND courseid='.
																		$courseid.' AND sectionid='.
																		$sectionid.' ');
			mysqli_query($db_connection,'UPDATE tblapplication_tmp SET is_selected=1, is_reject=0 WHERE idnum='.$_GET['idnum']);
			
			//Here insert to tblapplication && tblcompany_ojt && update tblstudent
			mysqli_query($db_connection,'INSERT INTO tblapplication SET applicationdatetime=NOW(),
															studentid='.
												$_SESSION['studentid'].',companyid='.
												$companyid.',status=1  ');
			mysqli_query($db_connection,'INSERT INTO tblcompany_ojt SET studentid='.
												$_SESSION['studentid'].',companyid='.
												$companyid.',is_endorse=1,courseid='.
												$courseid.',sectionid='.
												$sectionid.'  ');
			mysqli_query($db_connection,'UPDATE tblstudent SET is_endorse=1,companyid='.$companyid.' WHERE studentid='.
												$_SESSION['studentid']);
			
			$applicants = GetValue('SELECT applicants FROM tblsection WHERE courseid='.$courseid.' AND sectionid='.$sectionid.' ') + 1;
			mysqli_query($db_connection,'UPDATE tblsection SET applicants='.$applicants.' WHERE sectionid='.$sectionid);

			$applicantsv2 = GetValue('SELECT applicants FROM tblcompany WHERE companyid='.$companyid.' ') + 1;
			mysqli_query($db_connection,'UPDATE tblcompany SET applicants='.$applicantsv2.' WHERE companyid='.$companyid);
			$s =  '<div style="color:green;" class="blink">Successfully Added</div>';
	}
}


if(isset($_GET['reject'])){
	mysqli_query($db_connection,'UPDATE tblapplication_tmp SET is_reject=1 WHERE idnum='.$_GET['reject']);
}
?>
<style>
   .blink {
			animation: 1s linear infinite condemned_blink_effect;
		}
		@keyframes condemned_blink_effect {
			  0% {
				visibility: hidden;
			  }
			  50% {
				visibility: hidden;
			  }
			  100% {
				visibility: visible;
			  }
		}
   
    a {
        text-decoration: none;
        color: #007bff;
        cursor: pointer;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Additional styling for links within the table */
    td a {
        color: #007bff;
    }

    /* Container for each table */
    .table-container {
        display: inline-block;
        width: 45%;
        float: left;
        margin-right: 5%;
    }

    /* Optional: Add styling for the "VIEW ALL" row */
    td[onclick] {
        cursor: pointer;
        background-color: rgb(128,0,0);
        color: #ffffff;
        font-weight: bold;
    }
</style>
<? if($success){echo $success;} ?>
<?php

	$link = "TINY.box.show({url:'page_load/addpictures.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
	$link2 = "TINY.box.show({url:'page_load/addreport.php?studentid=".$_SESSION['studentid']."',width:800,height:450 })";
    echo '<div style="margin-left:150px;margin-top:60px;">
            <h5><a href="javsacript:void();"
			>Choose company where you accepted to</a><h5><br><br><br>';
	
 

    echo '<div style="display:inline-block; width: 45%; float: left;">';
	if($s){
		echo $s;
	}
    echo '<h5>Companies Apply</h5>';
    echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>Company</th>
                <th>REJECT</th>
                <th>&nbsp;</th>
            </tr>';
            $courseid2 = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
            $sectionid2 = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
			
			$q = 'SELECT * FROM tblapplication_tmp WHERE studentid='.$_SESSION['studentid'].'
							AND is_endorse=1 AND sectionid='.$sectionid2.' 
							AND courseid='.$courseid2.'';
			//echo $q;
			$rs2 = mysqli_query($db_connection,$q);
			while($rw2 = mysqli_fetch_array($rs2)){
				echo'<tr>
					<td>'.CompanyName($rw2['companyid']).'</td>';
					
					if($rw2['is_reject']==1 && $rw2['is_selected']==0){
						echo'<td>Rejected</td>';
						echo'<td>Rejected</td>';
						
					}
					
					if($rw2['is_reject']==0 && $rw2['is_selected']==0){
						echo'<td><a style="color:red;" href="javacsript:void(0)" onclick="reject_company('.$rw2['idnum'].');">REJECT</a></td>';
					
						echo'<td><a href="javacsript:void(0)" 
						onclick="accept_company('.$rw2['idnum'].','.$rw2['companyid'].',
								'.$rw2['courseid'].','.$rw2['sectionid'].');">ACCEPT</a></td>';
					
					}
					
					if($rw2['is_selected']==1){
						echo'<td><span style="color:green;">ACCEPTED</span></td>';
						echo'<td><span style="color:green;">ACCEPTED</span></td>';
					
					}
				echo'</tr>';
			}
			
        echo'</table>';
    echo '</div>';

    echo '</div>';

?>
