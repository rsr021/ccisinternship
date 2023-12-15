<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


//companycode, companyname, signatory, position, address, notarizationdate, max_apply
?>

<div class="container">
  <form method="post" id="myForm">
    <h3>Company Information</h3><hr>
    <div class="form-row">
      <!-- Company Code -->
      <div class="form-group col-md-4">
        <label for="companyCode">Company Code</label>
        <input type="text" class="form-control" name="companycode" id="companycode" placeholder="Enter company code">
      </div>

      <!-- Company Name -->
      <div class="form-group col-md-4">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Enter company name">
      </div>

      <!-- Signatory -->
      <div class="form-group col-md-4">
        <label for="signatory">Signatory</label>
        <input type="text" class="form-control" name="signatory" id="signatory" placeholder="Enter signatory">
      </div>

      <!-- Position -->
      <div class="form-group col-md-4">
        <label for="position">Position</label>
        <input type="text" class="form-control" name="position" id="position" placeholder="Enter position">
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
       <?php echo '<span id="tmp_city"><select id="cityid" class="form-control"><option value="0">Select City</option></select></span>'; ?>
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="position">Barangay</label>
       <?php echo '<span id="tmp_brgy"><select id="brgyid" class="form-control"><option option value="0">Select City</option></select></span>'; ?>
      </div>
	  

      <!-- Address -->
      <div class="form-group col-md-4">
        <label for="address">Street #</label>
        <input type="text" class="form-control" name="address" id="address" placeholder="Enter street">
      </div>

      <!-- Notarization Date -->
      <div class="form-group col-md-4">
        <label for="notarizationDate">Notarization Date</label>
        <input type="date" class="form-control" name="notarizationdate" id="notarizationdate">
      </div>

		<div class="form-group col-md-4">
        <label for="notarizationDate">Start Date</label>
        <input type="date" class="form-control" name="start_date" id="start_date">
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="notarizationDate">End Date</label>
        <input type="date" class="form-control" name="end_date" id="end_date">
      </div>
		 <!-- company link -->
     <div class="form-group col-md-4">
        <label for="company_link">Company Link</label>
        <input type="text" class="form-control" name="company_link" id="company_link" placeholder="Enter Company Link">
      </div>
 <!-- upload image -->
      <div class="form-group col-md-4">
        <label for="moa_img">Moa Image</label>
        <input type="file" class="form-control" name="moa_img" id="moa_img" placeholder="Enter Company Image">
</div>
      <!-- Max Apply -->
      <div class="form-group col-md-4">
        <label for="maxApply" >Max Apply</label>
        <input type="number" class="form-control" name="max_apply" id="max_apply" placeholder="Enter max apply">
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
        <div>
          <a href="javascript:void();" onclick="loadPage('pages/company.php','maincontent');" class="btn btn-secondary">Back</a>
          <a href="javascript:void();" onclick="addcompany();" class="btn btn-primary">Save</a>
        </div>
      </div>
	</form>
  </div>
