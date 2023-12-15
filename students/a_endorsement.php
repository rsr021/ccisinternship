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

	echo '<div style="margin-left:150px;margin-top:60px;">
            <h5><a href="javsacript:void();"
			<>Endorsement Letter</a><h5><br><br><br>';
	
 

    echo '<div style="display:inline-block; width: 45%; float: left;">';
    echo '<h5>Endorsement Letter</h5>';
    echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>#</th>
                <th>Company</th>
                <th>COURSE/SECTION</th>
                <th>ACTION</th>
            </tr>';
            $count = 1;
			$rs2 = mysqli_query($db_connection,'SELECT a.idnum,a.studentid, a.courseid, a.sectionid,
									a.companyid, a.is_endorse, a.is_reject, a.is_selected,
									b.companyname
									FROM tblapplication_tmp a, tblcompany b
									WHERE a.companyid=b.companyid AND a.is_endorse=1 GROUP BY a.companyid, a.courseid ,a.sectionid ORDER BY b.companyname ');
			while($rw2 = mysqli_fetch_array($rs2)){
				echo'<tr>
					<td>'.$count++.'</td>
					<td>'.CompanyName($rw2['companyid']).'</td>
					<td>'.CourseCode($rw2['courseid']).'-'.SectionCode($rw2['sectionid']).'</td>
					<td><a href="javacsript:void()" 
			onclick="openCustom(\'forms/endorsementletter_all.php?companyid='.$rw2['companyid'].'&sectionid='.$rw2['sectionid'].'&courseid='.$rw2['courseid'].'\',900,900)">Generate Endorsement</a></td>
				</tr>';
			}
			
        echo'</table>';
    echo '</div>';

    echo '</div>';

?>
