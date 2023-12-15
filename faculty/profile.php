<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


if(isset($_POST['firstname'])){
	
	if (isset($_FILES['pic'])) {
        $target_dir = "image_faculty/";
        $pic = basename($_FILES["pic"]["name"]);
        $target_file = $target_dir . $pic;
        if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {} else {}
    } else {$pic = '';}
	
	
	mysqli_query($db_connection,'UPDATE tblfaculty SET sectionid=\''.
						$_POST['sectionid'].'\',firstname=\''.
						$_POST['firstname'].'\',middlename=\''.
						$_POST['middlename'].'\',lastname=\''.
						$_POST['lastname'].'\',courseid=\''.
						$_POST['courseid'].'\',imagefaculty=\''.$pic.'\' WHERE facultyid='.$_SESSION['facultyid']);
}



$firstname = GetValue('SELECT firstname FROM tblfaculty WHERE facultyid='.$_SESSION['facultyid']);
$middlename = GetValue('SELECT middlename FROM tblfaculty WHERE facultyid='.$_SESSION['facultyid']);
$lastname = GetValue('SELECT lastname FROM tblfaculty WHERE facultyid='.$_SESSION['facultyid']);
$courseid = GetValue('SELECT courseid FROM tblfaculty WHERE facultyid='.$_SESSION['facultyid']);

$sectionid = GetValue('SELECT sectionid FROM tblfaculty WHERE facultyid='.$_SESSION['facultyid']);

?>



<div class="container mt-5">
  <form>
  <h3>Basic Information</h3><hr>
    <div class="form-row">
      <!-- First Name -->
      <div class="form-group col-md-4">
        <label for="firstName">First Name</label>
        <input type="text" value="<?=$firstname?>" class="form-control" id="firstname" placeholder="Enter your first name">
      </div>

      <!-- Middle Name -->
      <div class="form-group col-md-4">
        <label for="middleName">Middle Name</label>
        <input type="text" value="<?=$middlename?>" class="form-control" id="middlename" placeholder="Enter your middle name">
      </div>

      <!-- Last Name -->
      <div class="form-group col-md-4">
        <label for="lastName">Last Name</label>
        <input type="text" value="<?=$lastname?>" class="form-control" id="lastname" placeholder="Enter your last name">
      </div>
    </div>

    <!-- Course Dropdown -->
    <div class="form-group col-md-6">
      <label for="course">Course</label>
      <select class="form-control" id="courseid" name="courseid">
		<? echo'<option value="0">Select Course</option>';
		$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse ORDER BY coursename');
		while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
			if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
			echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
		}
	echo '</select>'; ?>
    </div>

	<div class="form-group col-md-6">
      <label for="course">Section</label>
      <select class="form-control" id="sectionid" name="sectionid">
		<? echo'<option value="0">Select Section</option>';
		$rs1 = mysqli_query($db_connection,'SELECT sectionid, sectioncode from tblsection ORDER BY sectioncode');
		while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
			if ($sectionid==$rw1['sectionid']) { $sel = 'selected="selected"'; }
			echo '<option value="'.$rw1['sectionid'].'" '.$sel.'>'.$rw1['sectioncode'].'</option>';
		}
	echo '</select>'; ?>
    </div>

    <!-- Picture Upload -->
    <div class="form-group col-md-6">
      <label for="picture">Upload Picture</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="pic" id="pic">
        <label class="custom-file-label" for="picture">Choose file</label>
      </div>
    </div>

    <div align="right"><a href="javascript:void();" onclick="updateinfo();" class="btn btn-primary">Save</a></div>
  </form>
</div>