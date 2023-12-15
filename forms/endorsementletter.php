<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$studentid = $_GET['studentid'];
//$_GET, $_POST

$companyid = $_GET['companyid'];
$courseid = $_GET['courseid'];
$sectionid = $_GET['sectionid'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endorsement Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 60px;
        }
        .letter-header {
            text-align: left;
            margin-bottom: 20px;
        }
        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 50px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .letter-body {
            margin-bottom: 20px;
        }
        .closing {
            text-align: left;
        }
		
		.head{
			margin-left:130px;
			margin-top:-125px;
		}
		#d{
			text-align:justify;
		}
		.x{
			margin-top:-15px;
		}
    </style>
</head>
<body>

    <div class="letter-header">
        <img src="../images/Logo.png" style="width:110px;height:110px;" alt="Icon" class="logo">
    </div>

	<div class="head"><p>Republic of the Philippines<br>
        POLYTECHNIC UNIVERSITY OF THE PHILIPPINES<br>
        OFFICE of the VICE PRESIDENT for ACADEMIC AFFAIRS<br>
        COLLEGE OF COMPUTER AND INFORMATION SCIENCES</p>
	</div>
	<hr>
	<div>
	<h4>November 16, 2023</h4>
	<? $signatory = GetValue('SELECT signatory FROM tblcompany WHERE companyid='.$companyid); 
		$position = GetValue('SELECT position FROM tblcompany WHERE companyid='.$companyid);
		$companyname = GetValue('SELECT companyname FROM tblcompany WHERE companyid='.$companyid);
		$address = GetValue('SELECT address FROM tblcompany WHERE companyid='.$companyid);
	
	?>
        <p><b><?=$signatory?></b><br>
        <?=$position?><br>
        <?=$companyname?><br>
        <?=$address?></p>
	</div>
	
    <div class="letter-body">
        <p>Dear <b>Mr/Ms. <?=$signatory?></b>,</p>
        <p>Greetings from CCIS!</p>
        <p id="d">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Listed below are student applicants of <?=CourseName($courseid)?> of the Polytechnic University of the Philippines, who are requesting for an on-the-job training. They are currently in their fourth year and have gainfully acquired substantial knowledge in programming and other Information Communication Technology (ICT) subjects.</p>
        <p id="d">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The on-the-job training aims to provide the students a chance to experience working in an actual business environment and gain necessary skills requisite to being a productive leader in the ICT industry. In this regard, we would like to request that they be given the opportunity to render 500 hours of work in major phases of ICT development in your office.</p>
        <p id="d">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We look forward to a joint endeavor with your company in enhancing skills, honing knowledge, and developing desirable attitudes that will make our students responsive to the changing needs of the industry and society.</p>
        <p>Thank you very much.</p>
    </div>

    <div class="closing">
        <p>Very truly yours,</p><br>
        <p><b>MARIAN G. ARADA, MIT</b><br>
        Chairperson, Department of Information Technology</p><br><br>
		
		<p>Noted By:</p><br><br>
		
		<p><b>DR. BENILDE ELEONOR V. COMENDADOR</b></p>
		<p style="margin-top:-20px;">Dean, CCIS<p><br>
    </div>


	<div>
        <p class="x">2nd Floor Room North Wing, PUP A. Mabini Campus, Anonas Street, Sta. Mesa, Manila 1016</p>
        <p class="x">Trunk Line: 335-1787 or 335-1777 local 272</p>
        <p class="x">Website: <a href="www.pup.edu.ph">www.pup.edu.ph</a> | Email: <a href="mailto:ccis@pup.edu.ph">ccis@pup.edu.ph</a></p>
        <p class="x">THE COUNTRY’S 1st POLYTECHNICU</p>
    </div>
	<img src="../images/bbb.png" style="width:200px;height:200px;margin-left:850px;margin-top:-200px;" alt="Icon" class="logo">
	
	
	<br><br><br>
	<div style="break-after:page"></div>
	<div>
		<h5>List of Students:</h5>
		<?
		$count = 1;
		$rs = mysqli_query($db_connection,'SELECT idnum,studentid,
					courseid, sectionid,companyid, is_endorse, 
					is_reject, is_selected
					FROM tblapplication_tmp WHERE is_endorse=1 AND is_reject=0
					AND sectionid='.$sectionid.' 
					AND courseid='.$courseid.' AND companyid='.$companyid.'');
		while($rw = mysqli_fetch_array($rs)){
			echo'<p class="x">'.$count++.'.&nbsp;&nbsp;'.StudentName($rw['studentid']).'</p>';
		}
		
		?>
			
      
    </div>

</body>
</html>




