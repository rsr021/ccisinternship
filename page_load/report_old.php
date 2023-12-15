<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



	if(isset($_POST['des'])){
			if (isset($_FILES['pic5'])) {
				$target_dir = "pictures_entry/";
				$pic5 = basename($_FILES["pic5"]["name"]);
				$target_file = $target_dir . $pic5;
				if (move_uploaded_file($_FILES["pic5"]["tmp_name"], $target_file)) {
					
					
				} else {}
			} else {$pic5 = '';}
			
			mysqli_query($db_connection,'INSERT INTO tblaccomplishment_photo SET picture=\''.
								$pic5.'\', studentid='.$_SESSION['studentid'].',
								picturedate=NOW(), description=\''.$_POST['des'].'\'');
			
		}
		
		
	//datefrom, dateto, timein, timeout, totalhours, description
	if(isset($_GET['description'])){
		mysqli_query($db_connection,'INSERT INTO tblaccomplishmentreport SET title=\''.
															$_GET['title'].'\',description=\''.
															$_GET['description'].'\',datefrom=\''.
															$_GET['datefrom'].'\',dateto=\''.
															$_GET['dateto'].'\',timein=\''.
															$_GET['timein'].'\',timeout=\''.
															$_GET['timeout'].'\',totalhours=\''.
															$_GET['totalhours'].'\', studentid='.$_SESSION['studentid']);
	
	
		//$_SESSION['tmp_report']
		$reportid = mysqli_insert_id($db_connection);
		$rs = mysqli_query($db_connection,'select * from '.$_SESSION['tmp_report']);
		while ($rw=mysqli_fetch_array($rs)) {
			mysqli_query($db_connection, 'INSERT INTO tblaccomplishmentreport_details SET 
						reportid='.$reportid.',actid='.$rw['actid'].' ') 
						or die(mysqli_error($db_connection)); 
			
			
		}
	
	
	
	}

	/*if(isset($_GET['get_ss'])){
		mysqli_query($db_connection,'UPDATE tblcompany_ojt SET is_ojt=1 WHERE studentid='.$_GET['get_ss']);
		mysqli_query($db_connection,'UPDATE tblcompany_ojt SET start_intern=NOW() WHERE studentid='.$_GET['get_ss']);
		mysqli_query($db_connection,'UPDATE tblstudent SET is_ojt=1 WHERE studentid='.$_GET['get_ss']);
		
	}*/

$is_ojt = GetValue('SELECT is_ojt FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
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
if($is_ojt){
	$link = "TINY.box.show({url:'page_load/addpictures.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
	$link2 = "TINY.box.show({url:'page_load/addreport.php?studentid=".$_SESSION['studentid']."',width:800,height:450 })";
    echo '<div style="margin-left:150px;margin-top:60px;">
            <a href="javsacript:void();"
			onclick="'.$link.'">Upload Pictures</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javsacript:void();" onclick="loadPage(\'page_load/addreport.php?studentid='.$_SESSION['studentid'].'\',\'content\');">Create a Weekly Accomplishment Report</a><br><br><br>';

    echo '<div style="display:inline-block; width: 45%; float: left; margin-right: 5%;">';
    echo '<h5>Pictures Entry</h5>';
    echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>Date</th>
                <th>Picture</th>
                <th>Description</th>
            </tr>';
            $rs = mysqli_query($db_connection,'SELECT picturedate, picture, 
			description FROM tblaccomplishment_photo WHERE studentid='.$_SESSION['studentid'].' ORDER BY idnum DESC LIMIT 5');
			while($rw=mysqli_fetch_array($rs)){
				echo'<tr>
					<td>'.date('M d, Y', strtotime($rw['picturedate'])).'</td>
					<td>'.substr($rw['picture'],0,10).'</td>
					<td>'.$rw['description'].'</td>
				</tr>';
				
			}
			echo'<tr><td align="center" colspan="3" onclick="openCustom(\'forms/viewpictures.php?studentid='.$_SESSION['studentid'].'\',1000,1000)">VIEW ALL</td></tr>';
        echo' </table><br>';
    echo '</div>';

    echo '<div style="display:inline-block; width: 45%; float: left;">';
    echo '<h5>Week Accomplishment Report</h5>';
    echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>Entry Report</th>
                <th>Entry Date</th>
                <th>Total Hours</th>
                <th>ACTION</th>
            </tr>';
            
			$rs2 = mysqli_query($db_connection,'SELECT * FROM tblaccomplishmentreport WHERE studentid='.$_SESSION['studentid']);
			while($rw2 = mysqli_fetch_array($rs2)){
			$hours = $rw2['totalhours'];
			
			$tot += $hours;
				echo'<tr>
					<td>'.$rw2['reportid'].'</td>
					<td>'.date('M d, Y', strtotime($rw2['datefrom'])).'-'.date('M d, Y', strtotime($rw2['dateto'])).'</td>
					<td>'.$rw2['totalhours'].'</td>
					<td><a href="javacsript:void()" onclick="openCustom(\'forms/task.php?reportid='.$rw2['reportid'].'\',900,900)">VIEW</a></td>
				</tr>';
			}
			echo'<tr>
				<td>&nbsp;</td>
				<td>Total Hours:</td>
				<td>'.$tot.'</td>
				<td>&nbsp;</td>
			</tr>';
			
        echo'</table>';
    echo '</div>';

    echo '</div>';
} else {
	/*if(GetValue('SELECT is_endorse FROM tblstudent WHERE studentid='.$_SESSION['studentid'])){
		echo'<span style="margin-top:300px;margin-left:140px;"><a href="javascript:void();" onclick="is_ojt_start('.$_SESSION['studentid'].');">Click here if the ojt start...</a></span>';
    	
	}*/
	echo '<div style="margin-top:200px;"><span style="margin-left:140px;color:red;font-size:90px;">You haven\'t started OJT yet.</span></div>';
}
?>
