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
$max_apply = GetValue('SELECT max_apply FROM tblcompany WHERE companyid='.$companyid);
$moa_img = GetValue('SELECT moa_img FROM tblcompany WHERE companyid='.$companyid);


$address = GetValue('SELECT address FROM tblcompany WHERE companyid='.$companyid);
$provid = GetValue('SELECT provid FROM tblcompany WHERE companyid='.$companyid);
$cityid = GetValue('SELECT cityid FROM tblcompany WHERE companyid='.$companyid);
$brgyid = GetValue('SELECT brgyid FROM tblcompany WHERE companyid='.$companyid);
?>
<style>
	label{font-weight:bold;}
	.scroll-container{
		width: 100%;
		max-height: 400px;
		overflow-y: auto;
	}
</style>


<div class="scroll-container">
<div>
  <div id="cv">
    <div class="header">
      <h3><?=$companyname?></h3>
      <hr>
    </div>

    <div class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="info-group">
            <label>Company Code</label>
            <p><?=$companycode?></p>
          </div>

          <div class="info-group">
            <label>Company Name</label>
            <p><?=$companyname?></p>
          </div>

          <div class="info-group">
            <label>Signatory</label>
            <p><?=$signatory?></p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-group">
            <label>Position</label>
            <p><?=$position?></p>
          </div>

          <div class="info-group">
            <label>Address</label>
            <p><?=$address?>&nbsp;<?=Barangay($brgyid)?>,&nbsp;<?=City($cityid)?>,&nbsp;<?=Province($provid)?></p>
          </div>

          <div class="info-group">
            <label>Notarization Date</label>
            <p><?=date("F j, Y", strtotime($notarizationdate))?></p>
          </div>

          <div class="info-group">
            <label>Max Apply</label>
            <p><?=$max_apply?></p>
          </div>
		  
		  
		  
		  
        </div>
      </div>
    </div>
  </div>
</div>


<div align="center"><div>MOA</div><img src="pages/moa_image/<?=$moa_img?>" height="700"/></div>

</div>
