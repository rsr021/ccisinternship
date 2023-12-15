<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];

// echo $studentid;
$rs = mysqli_query($db_connection,'SELECT * FROM tblstudent WHERE studentid='.$studentid);
$rw=mysqli_fetch_array($rs);
?>
<br>
<div align="center" style="font-family:arial;font-size:20px;">
	<div align="center"><img style="border-radius:50%;" src="../page_load/profilepic/<?=$rw['profilepic']?>" height="300"/></div>
	<br>
	<div class="da">Name:&nbsp;<?=StudentName($rw['studentid'])?></div>
	<div class="da">Course/Section:&nbsp;<?=CourseName($rw['courseid']).'&nbsp;('.SectionCode($rw['sectionid']).')'?></div>
	<div class="da">BIO:&nbsp;<?=$rw['bio']?></div>
	<div class="da">Internship Prefer:&nbsp;<?=Type($rw['typeid'])?></div><br>
	<div class="da" style="font-size:17px;text-align:justify;">Skills:&nbsp;<i><?=$rw['skills']?></i></div>
	
	
	<hr style="width:50%">
	<div class="da">
		<div>Medical Certificate</div>
		<img src="../page_load/resume/<?=$rw['resume']?>" height="500"/>
	</div>
	
	<hr style="width:50%">
	<div class="da">
		<div>Resume/Curriculum Vitae</div>
		<img src="../page_load/cv/<?=$rw['cv']?>" height="500"/>
	</div>
	
	<hr style="width:50%">
	<div class="da">
		<div>Consent Form</div>
		<img src="../page_load/consent/<?=$rw['consent']?>" height="500"/>
	</div>
	
</div>