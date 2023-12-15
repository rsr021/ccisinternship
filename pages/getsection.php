<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$facultyid = $_GET['facultyid'];
$name = FacultyName($facultyid);
?>
<input type="text" hidden value="<?=$name?>" id="name"/>
<div class="form-row align-items-center">
    &nbsp;&nbsp;&nbsp;<label>Assigning Section</label>&nbsp;&nbsp;
  <div class="form-group col-md-5">
    <select class="form-control" id="sectionid" name="sectionid">
      <?php
      echo '<option value="0">Select Section</option>';
      $rs1 = mysqli_query($db_connection, 'SELECT sectionid, sectioncode from tblsection ORDER BY sectioncode');
      while ($rw1 = mysqli_fetch_array($rs1)) {
        $sel = '';
        if ($sectionid == $rw1['sectionid']) {
          $sel = 'selected="selected"';
        }
        echo '<option value="' . $rw1['sectionid'] . '" ' . $sel . '>' . $rw1['sectioncode'] . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <a href="javascript:void();" onclick="assign_section(<?=$facultyid?>);" class="btn btn-primary btn-block">Save</a>
  </div>
</div>

