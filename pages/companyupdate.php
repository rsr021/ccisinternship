<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$companyid = $_GET['companyid'];

//companycode, companyname, signatory, position, address, notarizationdate, max_apply
$companycode = GetValue('SELECT companycode FROM tblcompany WHERE companyid='.$companyid);
$companyname = GetValue('SELECT companyname FROM tblcompany WHERE companyid='.$companyid);
$signatory = GetValue('SELECT signatory FROM tblcompany WHERE companyid='.$companyid);
$position = GetValue('SELECT position FROM tblcompany WHERE companyid='.$companyid);
$address = GetValue('SELECT address FROM tblcompany WHERE companyid='.$companyid);
$notarizationdate = GetValue('SELECT notarizationdate FROM tblcompany WHERE companyid='.$companyid);
$start_date = GetValue('SELECT start_date FROM tblcompany WHERE companyid='.$companyid);
$end_date = GetValue('SELECT end_date FROM tblcompany WHERE companyid='.$companyid);
$company_link = GetValue('SELECT company_link FROM tblcompany WHERE companyid='.$companyid);
$moa_img = GetValue('SELECT moa_img FROM tblcompany WHERE companyid='.$companyid);
$max_apply = GetValue('SELECT max_apply FROM tblcompany WHERE companyid='.$companyid);

$provid = GetValue('SELECT provid FROM tblcompany WHERE companyid='.$companyid);
$cityid = GetValue('SELECT cityid FROM tblcompany WHERE companyid='.$companyid);
$brgyid = GetValue('SELECT brgyid FROM tblcompany WHERE companyid='.$companyid);
$typeid = GetValue('SELECT typeid FROM tblcompany WHERE companyid='.$companyid);
?>

<div class="container mt-5">
  <form method="post" id="myForm">
    <h3><? if($companyid){echo $companyname;} else {echo'Company Information';} ?></h3><hr>
    <div class="form-row">
      <!-- Company Code -->
      <div class="form-group col-md-4">
        <label for="companyCode">Company Code</label>
        <input type="text" class="form-control" value="<?=$companycode?>" name="companycode" id="companycode" placeholder="Enter company code">
      </div>

      <!-- Company Name -->
      <div class="form-group col-md-4">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" value="<?=$companyname?>" name="companyname" id="companyname" placeholder="Enter company name">
      </div>

      <!-- Signatory -->
      <div class="form-group col-md-4">
        <label for="signatory">Signatory</label>
        <input type="text" class="form-control" value="<?=$signatory?>" name="signatory" id="signatory" placeholder="Enter signatory">
      </div>

      <!-- Position -->
      <div class="form-group col-md-4">
        <label for="position">Position</label>
        <input type="text" class="form-control" value="<?=$position?>" name="position" id="position" placeholder="Enter position">
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="position">Province</label>
       <?php echo '<select  class="form-control" id="provid" onchange="loadPage(\'pages/selectcity.php?provid=\'+this.value,\'tmp_city\');">';
                echo '<option value="0" style="color:gray">Select Province</option>';
				$rs1 = mysqli_query($db_connection,'SELECT provid, provincename from tblloc_province order by provincename');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($provid==$rw1['provid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['provid'].'" '.$sel.'>'.$rw1['provincename'].'</option>';
				}
            echo '</select>'; ?>
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="position">City</label>
       <?php echo '<span id="tmp_city"><select class="form-control" id="cityid" onchange="loadPage(\'pages/selectbarangay.php?cityid=\'+this.value+\'&provid=\'+object(\'provid\').value,\'tmp_brgy\');">';
                echo '<option value="0">Select City</option>';
				$rs1 = mysqli_query($db_connection,'SELECT cityid,cityname from tblloc_city where
													provid='.$provid.' ORDER BY cityname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($cityid==$rw1['cityid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['cityid'].'" '.$sel.'>'.$rw1['cityname'].'</option>';
				}
            echo '</select></span>'; ?>
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="position">Barangay</label>
       <?php echo '<span id="tmp_brgy"><select class="form-control" id="brgyid">';
                echo '<option value="0">Select Barangay</option>';
				$rs1 = mysqli_query($db_connection,'SELECT brgyid,barangayname from tblloc_brgy where
													cityid='.$cityid.' ORDER BY barangayname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($brgyid==$rw1['brgyid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['brgyid'].'" '.$sel.'>'.ucwords(strtolower($rw1['barangayname'])).'</option>';
				}
            echo '</select></span>'; ?>
      </div>
	  

      <!-- Address -->
      <div class="form-group col-md-4">
        <label for="address">Street #</label>
        <input type="text" class="form-control" value="<?=$address?>" name="address" id="address" placeholder="Enter street">
      </div>

      <!-- Notarization Date -->
      <div class="form-group col-md-4">
        <label for="notarizationDate">Notarization Date</label>
        <input type="date" class="form-control" value="<?=$notarizationdate?>" name="notarizationdate" id="notarizationdate">
      </div>


	<div class="form-group col-md-4">
        <label for="notarizationDate">Start Date</label>
        <input type="date" class="form-control" value="<?=$start_date?>" name="start_date" id="start_date">
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="notarizationDate">End Date</label>
        <input type="date" class="form-control" value="<?=$end_date?>" name="end_date" id="end_date">
      </div>
			 <!-- company link -->
       <div class="form-group col-md-4">
        <label for="company_link">Company Link</label>
        <input type="text" class="form-control"  value="<?=$company_link?>" name="company_link" id="company_link" placeholder="Enter Company Link">
      </div>
 <!-- upload image -->
      <div class="form-group col-md-4">
        <label for="moa_img">Moa Image</label>
        <input type="file" class="form-control" name="moa_img" id="moa_img" placeholder="Enter Company Image">
</div>
      <!-- Max Apply -->
      <div class="form-group col-md-4">
        <label for="maxApply">Max Apply</label>
        <input type="number" class="form-control" value="<?=$max_apply?>" name="max_apply" id="max_apply" placeholder="Enter max apply">
      </div>
	  <div class="form-group col-md-4">
        <label for="position">Internship Type</label>
       <?php echo '<select  class="form-control" id="typeid">';
                echo '<option value="0" style="color:gray">Select Intern Type</option>';
				$rs1 = mysqli_query($db_connection,'SELECT typeid, type from tblinterntype order by type');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($typeid==$rw1['typeid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['typeid'].'" '.$sel.'>'.$rw1['type'].'</option>';
				}
            echo '</select>'; ?>
      </div>
<br>
       
      <div class="form-group col-md-12">
          <a href="javascript:void();" onclick="loadPage('pages/company.php','maincontent');" class="btn btn-secondary">Back</a>
          <a href="javascript:void();" onclick="updatecompany(<?=$companyid?>);" class="btn btn-primary">Update</a>
      </div>
	</form>
  </div>
