<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

	
?>
<style>
   
   
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
<?php

	$link = "TINY.box.show({url:'page_load/addpictures.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
	$link2 = "TINY.box.show({url:'page_load/addreport.php?studentid=".$_SESSION['studentid']."',width:800,height:450 })";
    echo '<div style="margin-left:150px;margin-top:60px;">
            <h5><a href="javsacript:void();"
			<>Endorsement Letter</a><h5><br><br><br>';
	
 

    echo '<div style="display:inline-block; width: 45%; float: left;">';
    echo '<h5>Endorsement Letter</h5>';
    echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>Company</th>
                <th>ACTION</th>
            </tr>';
            $courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
            $sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
			$rs2 = mysqli_query($db_connection,'SELECT idnum,studentid, courseid, sectionid,
									companyid, is_endorse, is_reject, is_selected
									FROM tblapplication_tmp WHERE is_endorse=1 
									AND sectionid='.$sectionid.' 
									AND courseid='.$courseid.' AND studentid='.$_SESSION['studentid'].' GROUP BY companyid ');
			while($rw2 = mysqli_fetch_array($rs2)){
				echo'<tr>
					<td>'.CompanyName($rw2['companyid']).'</td>
					<td><a href="javacsript:void()" 
			onclick="openCustom(\'forms/endorsementletter.php?companyid='.$rw2['companyid'].'&sectionid='.$rw2['sectionid'].'&courseid='.$rw2['courseid'].'\',900,900)">Generate Endorsement</a></td>
				</tr>';
			}
			
        echo'</table>';
    echo '</div>';

    echo '</div>';

?>
