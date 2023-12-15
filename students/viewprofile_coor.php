<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];
?>


<style>
        .scroll-container {
            width: 100%;
            max-height: 600px;
            overflow-y: auto;
        }
</style>
</head>

<div class="container-fluid">

<?
if($_SESSION['facultyid']==1){
	echo '<button class="btn btn-sm btn-secondary" onclick="loadPage(\'students/ojt_students.php\',\'maincontent\')">Back</button>';
} else {
	echo '<button class="btn btn-sm btn-secondary" onclick="loadPage(\'faculty/studentlist.php\',\'maincontent\')">Back</button>';
}
?>
<br><br>
  <div class="row">
    <!-- Upper Left - Profile -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <!-- Your profile content goes here -->
          <h5 class="card-title">Profile</h5>
		  <? $profilepic = GetValue('SELECT profilepic FROM tblstudent WHERE studentid='.$studentid);?>
		  <? $courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$studentid);?>
		  <? $sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$studentid);?>
		  <img style="border-radius:50%;border:1px solid maroon;" src="page_load/profilepic/<?=$profilepic?>" height="100"/>
		  <span style="margin-top:100px"><?=StudentName($studentid)?></span><br>
		  <span>OJT at <?=CompanyName(GetValue('SELECT companyid FROM tblstudent WHERE studentid='.$studentid));?></span>
		  <? $xxx = GetValue('SELECT start_intern FROM tblcompany_ojt WHERE studentid='.$studentid);?>
		  <? $yyy = GetValue('SELECT end_intern FROM tblcompany_ojt WHERE studentid='.$studentid);?>
		  <div style="font-size:12px;margin-top:7px;">Internship Start:&nbsp;
		  <? if($yyy){date("F j, Y", strtotime($xxx));} else {}?></div>
		  <div style="font-size:12px;">Internship End&nbsp;
		  <? if($yyy){date("F j, Y", strtotime($yyy));} else {}?></div>
		  <span style="margin-top:100px"><?=CourseName($courseid).' ('.SectionCode($sectionid).')'?></span><br>
		  <span style="margin-top:100px"><?=GetValue('SELECT bio FROM tblstudent where studentid='.$studentid)?></span><br>
		  <? $view_o = 'openCustom(\'forms/view_other_info.php?studentid='.$studentid.'\',700,600)';?>
		    <span style="cursor:pointer;margin-top:100px;font-size:12px;"><i onclick="<?=$view_o?>">Click here to see other information</i></span><br>
		 
		  <? $viewm = 'openCustom(\'forms/viewm.php?studentid='.$studentid.'\',900,900)';?>
		  <? $viewr = 'openCustom(\'forms/viewr.php?studentid='.$studentid.'\',900,900)';?>
		  <div style="cursor:pointer;"><img src="images/resume.png" alt="Icon 3" height="25">&nbsp;<span onclick="<?=$viewr?>" >VIEW</span> <span style="font-size:10px;">Resume</span></div>
		  <div  style="cursor:pointer;"><img  src="images/medical-certificate.png" alt="Icon 3" height="25">&nbsp;<span onclick="<?=$viewm?>">VIEW</span> <span style="font-size:10px;">Mediccal Certificate</span></div>
		  
		  <?
		  $dars = 'openCustom(\'forms/view_completion.php?studentid='.$studentid.'\',1000,1000)';            

		  $is_have_certi = GetValue('SELECT certificate_completion FROM tblstudent WHERE studentid='.$studentid);
		  if($is_have_certi){
			  echo' <div style="cursor:pointer;"><span style="color:green;font-size:14px;" onclick="'.$dars.'">Certificate of Completion</span></div>';
		  }
		  ?>
			
			 <?
		  $port = 'openCustom(\'forms/view_portfolio.php?studentid='.$studentid.'\',1000,1000)';            
		  echo' <div style="cursor:pointer;"><span style="color:blue;font-size:14px;" onclick="'.$port.'">View Portfolio</span></div>';
		  
		  ?>
        </div>
      </div>
    </div>

    <!-- Upper Right - Other Info rgb(128,0,0)-->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <!-- Other info content goes here -->
          <h4 class="card-title">Related Images</h4>
          <?
		  $rs = mysqli_query($db_connection,'SELECT idnum,picturedate, picture FROM tblaccomplishment_photo
					WHERE studentid='.$studentid.' ORDER BY picturedate DESC LIMIT 7' );
			while ($rw = mysqli_fetch_array($rs)){
				$openme = 'openCustom(\'forms/view.php?idnum='.$rw['idnum'].'\',500,500)';
				
				echo substr($rw['picture'],0,30).'<img style="cursor:pointer;"  onclick="'.$openme.'" src="images/eye.png" alt="Icon 3" height="19"/><br>';
			}
		  ?><br>
		  <? $openme2 = 'openCustom(\'forms/viewpictures2.php?studentid='.$studentid.'\',900,900)';?>
		 
		  <span style="cursor:pointer;" onclick="<?=$openme2?>">VIEW ALL</span><br><br>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <!-- Lower Left - Dates and Entries -->
    <div class="col-md-6">
      <div class="jumbotron">
        <!-- Dates and entries content goes here -->
        <h4 class="display-5">Weekly Accomplishment Report</h4>
        <!-- Add your date and entry information here -->
		<?
		$rs2 = mysqli_query($db_connection,'SELECT * FROM tblaccomplishmentreport WHERE studentid='.$studentid);
		while ($rw2 = mysqli_fetch_array($rs2)){
			
			 $openme3 = 'openCustom(\'forms/task.php?reportid='.$rw2['reportid'].'\',900,900)';
			echo '<span onclick="'.$openme3.'" style="cursor:pointer;" title="Click to View Accomplishment Report">'.date('M d, Y', strtotime($rw2['datefrom'])).'&nbsp;-&nbsp;'.date('M d, Y', strtotime($rw2['dateto'])).'</span>&nbsp;DONE<br>';
		}
		?>
		
      </div>
    </div>

    <!-- Lower Right - Pictures -->
    <!--<div class="col-md-6">
      <div class="card">
        <div class="card-body">
          
          <h5 class="card-title">Related Images</h5>
          picture (eye icon)<br>
          picture (eye icon)<br>
          picture (eye icon)<br>
          picture (eye icon)<br>
		  VIEW ALL
        </div>
      </div>
    </div>
  </div>-->

</div>

