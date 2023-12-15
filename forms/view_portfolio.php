<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];

$rs = mysqli_query($db_connection,'SELECT * FROM tblstudent WHERE studentid='.$studentid);
$rw = mysqli_fetch_array($rs);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
			padding:15;
            
        }

        .container {
            width: 100%;
            max-width: 612px; /* Short bond paper size: 8.5in */
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="container"><br><br><br><br><br>
        <p style="font-size:100px;">Portfolio</p>
		<h4><?=CourseName($rw['courseid'])?>&nbsp;(<?=CourseCode($rw['courseid'])?>)</h4><br><br><br>
		
		
		<h5>Submitted by:</h5>
		<h5><?=StudentName($rw['studentid'])?></h5>
		<h5><?=CourseCode($rw['courseid'])?>&nbsp;<?=SectionCode($rw['sectionid'])?></h5>
    </div><br><br><br><br><br>
	
	
    <div style="page-break-before: always;"></div>
	
	<div style="width:8.5in;height:11in;border: 2px solid darkslateblue;  padding:10px;box-sizing: border-box;" class="ojt">
		<h3 align="center">OJT STUDENT PROFILE</h3>
		<img style="float:right;margin-top:-25px;border:2px solid black;" height="160" src="../page_load/profilepic/<?=$rw['profilepic']?>" />
		<p>Name:&nbsp;<?=StudentName($rw['studentid'])?></p>
		<? $age = GetValue('SELECT TIMESTAMPDIFF(YEAR,dateofbirth,NOW()) as age FROM tblstudent WHERE studentid='.$studentid);?>
		<p>Age:&nbsp;<?=$age?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<? $sex = GetValue('SELECT gender FROM tblstudent WHERE studentid='.$studentid); ?>
		
		<span>Gender:&nbsp;
		
		<?
		if($sex=='M'){
			echo'M<u><img src="../images/check_.png" height="15"/></u>&nbsp;&nbsp;&nbsp;';
			echo'F';
		} else {
			echo'M&nbsp;&nbsp;&nbsp;';
			echo'F<u><img src="../images/check_.png" height="15"/></u>';
		}
		?>
		</span></p>
		
		
		<p>Address:&nbsp;<?=$rw['address']?>&nbsp;<?=ucwords(strtolower(Barangay($rw['brgyid'])))?></p>
		<p><?=City($rw['cityid'])?>&nbsp;<?=Province($rw['provid'])?></p>
		<p>Landline: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Mobile:&nbsp;<?=$rw['contactno']?></span></p>
		<p>Email:&nbsp;<?=$rw['email']?></p>
		<p>Contact Person in case of Emergency:</p>
		<p>Relationship:</p>
		<p>Contact Number:</p><br>
		
		<p>Educational Background:</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		<p>Special Trainings/Certifications</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		<p>Company Name:&nbsp;<?=CompanyName($rw['companyid'])?></p>
		<p>Company Address:&nbsp;</p>
		<p>Job Title:&nbsp;</p>
		<p>Job Description:&nbsp;</p>
		<p>Division/Department:&nbsp;</p>
		<p>Training Supervisor:&nbsp;</p>
		<p>Position:&nbsp;</p><br><br>
		
		
		<p style="text-align:right;"><?=StudentName($rw['studentid'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		<p style="text-align:right;margin-top:-25px;margin-bottom:-10px;">________________________</p>
		<p style="text-align:right;">Signature over Printed Name</p>
	</div><br>
	
	
	<div style=" page-break-before: always;"></div>
	
	<div style="width:8.5in;height: 11in;border: 2px solid darkslateblue;  padding:10px;box-sizing: border-box;" class="ojt">
		<h3 align="center">TRAINING SUPERVISOR'S PROFILE</h3>
		<p>Name: </p>
		<p>Nickname:</p>
		<p>Position:</p>
		<p>Company Address:</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>Division/Department:</p>
		<p>&nbsp;</p><br>
		
		<p>Email Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Gender:</span></p>
		<p>Landline: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Mobile:</span></p><br>
		<p>Education Background</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		<p>Special Trainings/Certifications</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		
		<p style="text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		<p style="text-align:right;margin-top:-25px;margin-bottom:-10px;">________________________</p>
		<p style="text-align:right;">Signature over Printed Name</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p><br><br><br><br><br><br><br><br><b><br>	
	
		
	<div><br>
	
	
	<div style="page-break-before:always;"></div>
	
	<?
	
	$v = 'SELECT a.reportid, a.studentid, a.title,
						a.dateto, a.datefrom, a.timein, a.timeout, a.description
					    FROM
						tblaccomplishmentreport a, tblaccomplishmentreport_dtr c
						WHERE a.reportid=c.reportid  AND a.studentid='.$studentid.' GROUP BY a.reportid ';
	
	$result = mysqli_query($db_connection,$v );
	while($row = mysqli_fetch_array($result)){
		$tot = GetValue('SELECT SUM(totalhours) FROM tblaccomplishmentreport_dtr WHERE reportid='.$row['reportid']);
		$activity = GetValue('SELECT GROUP_CONCAT(\'-&nbsp;\',b.act SEPARATOR \'\<br>\') FROM tblaccomplishmentreport_details a, tblactivity b WHERE
                    a.actid=b.actid AND a.reportid='.$row['reportid']);

		echo'<div style="width:8.5in;height: 11in;margin-left:-12px;border: 2px solid darkslateblue; padding:10px;box-sizing: border-box;" class="ojt">
			<h3 align="center">Weekly Accomplishment Report</h3>
			<table width="100%">
				<tr>
					<td>Title:&nbsp;'.$row['title'].'</td>
					<td>Inclusive Dates:&nbsp;'.date('M d', strtotime($row['datefrom'])).'&nbsp;-&nbsp;'.date('M d, Y', strtotime($row['dateto'])).'</td>
				</tr>
				<tr>
					<td>Time In:&nbsp;'.date('h:i a', strtotime($row['timein'])).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time Out:&nbsp;'.date('h:i a', strtotime($row['timeout'])).'</td>
					<td>Total no. of Hours:&nbsp;'.$tot.'</td>
				</tr>
			</table>
			<br>
			<table>
				<tr><td>'.$activity.'</td></tr>
			</table><br><br><br>';
			echo'<table align="center" style="width:50%;">
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;'.substr($row['description'],0,130).'</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;'.substr($row['description'],131,261).'</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;'.substr($row['description'],262,392).'</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid black;">&nbsp;</td>
				</tr>		
		</table>
			
		</div>';
		echo'<br>';
	}
	
	
	
	?>
	
	
		
		
	<div style="page-break-before:always;"></div>
	
	
	<div style="width:8.5in;height: 11in;margin-left:-12px;border: 2px solid darkslateblue; padding:10px;box-sizing: border-box;" class="ojt">
				<h3 style="text-align:center;">Me at online work/My workstation</h3>
	<?
			$res = mysqli_query($db_connection,'SELECT idnum, picture, picturedate,description
							FROM tblaccomplishment_photo WHERE studentid='.$studentid);
			while($row_cat = mysqli_fetch_array($res)){
				echo'
				<p style="text-align:center;">Description: '.$row_cat['description'].'</p>
				<div align="center"><img src="../page_load/pictures_entry/'.$row_cat['picture'].'" height="200" widht="200"/></div>
		';
	}
	?>
	
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div>
	
	
	<div style="page-break-before:always;"></div>
	
	
	<div style="width:8.5in;height: 11in;margin-left:-12px;border: 2px solid darkslateblue; padding:10px;box-sizing: border-box;" class="ojt">
		<h3 style="text-align:center;">Certificate of Completion</h3>
		<?
		$pic = GetValue('SELECT certificate_completion FROM tblstudent WHERE studentid='.$studentid);
		?>
		<? echo'<img src="../page_load/certificate_completion/'.$pic.'" height="960" width="780"/>';?>
	<div>
    <!-- Include additional content or modify as needed -->
</body>
</html>
