<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



?>

<style>
.card {
  --main-color: #000;
  --submain-color: #78858F;
  --bg-color: #fff;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  position: relative;
  width: 300px;
  height: 410px;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: var(--bg-color);
  margin-top:15px;
}

.card:hover {
	border: 3px solid #ecce60;
}

.card__img {
  height: 192px;
  width: 100%;
}

.card__img svg {
  height: 100%;
  border-radius: 20px 20px 0 0;
}

.card__avatar {
  position: absolute;
  width: 114px;
  height: 114px;
  background: var(--bg-color);
  border-radius: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  top: calc(50% - 57px);
}

.card__avatar svg {
  width: 100px;
  height: 100px;
}

.card__title {
  margin-top: 65px;
  font-weight: 500;
  font-size: 18px;
  color: var(--main-color);
}

.card__subtitle {
  margin-top: -5px;
  font-weight: 400;
  font-size: 15px;
  color: var(--submain-color);
}

.dropdown-btn {
	border: none;
	color: black;
	padding: 10px 15px;
	font-size: 16px;
	cursor: pointer;
	background: none;
	float: right;
}

</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">OJT Students</h3>
	<!--<div align="left">Search:&nbsp;<input type="text" id="search_ref" name="search_ref"
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	-->
	<!--<div align="right">
<a href="javascript:void();" onclick="save_entry()" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 2px;"></i>
    </span>
    <span class="text">Add Student Ojt</span>
</a>-->
</div>
</div>

<div class="container mb-4 d-flex">
	<? echo '<select class="form-control" id="courseid" 
	onchange="loadSubContent(\'students/tmplist_ojt_students.php?str=\'+object(\'str\').value
													+\'&courseid=\'+object(\'courseid\').value
													+\'&sectionid=\'+object(\'sectionid\').value
													+\'&companyid=\'+object(\'companyid\').value,\'show_student\')");">';
				echo '<option value="0">ALL COURSES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT courseid, coursename from tblcourse order by coursename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($courseid==$rw1['courseid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['courseid'].'" '.$sel.'>'.$rw1['coursename'].'</option>';
				}
            echo '</select>&nbsp;'; ?>
	<? echo '<select class="form-control" id="sectionid" 
	onchange="loadSubContent(\'students/tmplist_ojt_students.php?str=\'+object(\'str\').value
													+\'&courseid=\'+object(\'courseid\').value
													+\'&sectionid=\'+object(\'sectionid\').value
													+\'&companyid=\'+object(\'companyid\').value,\'show_student\')">';
				echo '<option value="0">ALL SECTIONS</option>';
				$rs1 = mysqli_query($db_connection,'SELECT sectionid, sectioncode from tblsection order by sectioncode');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($sectionid==$rw1['sectionid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['sectionid'].'" '.$sel.'>'.$rw1['sectioncode'].'</option>';
				}
            echo '</select>&nbsp;'; ?>
	<? echo '<select class="form-control" id="companyid"
	onchange="loadSubContent(\'students/tmplist_ojt_students.php?str=\'+object(\'str\').value
													+\'&courseid=\'+object(\'courseid\').value
													+\'&sectionid=\'+object(\'sectionid\').value
													+\'&companyid=\'+object(\'companyid\').value,\'show_student\')">';
				echo '<option value="0">ALL COMPANIES</option>';
				$rs1 = mysqli_query($db_connection,'SELECT companyid, companyname from tblcompany order by companyname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($companyid==$rw1['companyid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['companyid'].'" '.$sel.'>'.$rw1['companyname'].'</option>';
				}
            echo '</select>&nbsp;'; ?>
	<input type="text" 
	onkeyup="loadSubContent('students/tmplist_ojt_students.php?str='+this.value
													+'&courseid='+object('courseid').value
													+'&sectionid='+object('sectionid').value
													+'&companyid='+object('companyid').value,'show_student')"
	class="form-control" id="str" placeholder="Search Student...">
	<button onclick="loadSubContent('students/tmplist_ojt_students.php?str='+object('str').value
													+'&courseid='+object('courseid').value
													+'&sectionid='+object('sectionid').value
													+'&companyid='+object('companyid').value,'show_student')" type="button" style="background-color: #9e1e1e;" class="btn text-light">Search</button>
</div>



<div id="show_student">
	<? include('tmplist_ojt_students.php'); ?>
</div>
