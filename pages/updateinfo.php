<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$studentid = $_GET['studentid'];

$firstname = GetValue('SELECT firstname FROM tblstudent WHERE studentid='.$studentid);
$middleinitial = GetValue('SELECT middleinitial FROM tblstudent WHERE studentid='.$studentid);
$middlename = GetValue('SELECT middlename FROM tblstudent WHERE studentid='.$studentid);
$lastname = GetValue('SELECT lastname FROM tblstudent WHERE studentid='.$studentid);
$gender = GetValue('SELECT gender FROM tblstudent WHERE studentid='.$studentid);
$email = GetValue('SELECT email FROM tblstudent WHERE studentid='.$studentid);
$contactno = GetValue('SELECT contactno FROM tblstudent WHERE studentid='.$studentid);
$address = GetValue('SELECT address FROM tblstudent WHERE studentid='.$studentid);
$provid = GetValue('SELECT provid FROM tblstudent WHERE studentid='.$studentid);
$cityid = GetValue('SELECT cityid FROM tblstudent WHERE studentid='.$studentid);
$brgyid = GetValue('SELECT brgyid FROM tblstudent WHERE studentid='.$studentid);
?>

<style>
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 800px; /* Adjust the max-width for your desired width */
        margin: 0 auto; /* Center the form */
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    select {
        cursor: pointer;
    }

    textarea {
        resize: vertical;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
</head>

<form>
    <div>
		<span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>First Name:</span>
        <input placeholder="Input firstname" value="<?=$firstname?>" type="text" id="firstname">
        <br>
		<span style="display: inline-block; width: 120px; color:black;"><span class="required"></span>Middle Initial:</span>
        <input placeholder="Input middleinitial" value="<?=$middleinitial?>" type="text" id="middleinitial">
        <br>
		<span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Email:</span>
        <input placeholder="Input your email address" value="<?=$email?>" type="text" id="email">
        <br>
		 <span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Contact No.:</span>
        <input placeholder="Input your contact number" value="<?=$contactno?>" type="text" id="contactno">
    </div>

    <div>
		<span style="display: inline-block; width: 120px; color:black;"><span class="required"></span>Middle Name:</span>
        <input placeholder="Input middlename" value="<?=$middlename?>" type="text" id="middlename">
        <br>
		<span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Last Name:</span>
        <input placeholder="Input lastname" value="<?=$lastname?>" type="text" id="lastname">
        <br>
		 <span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Sex at Birth:</span>
        <?php
        $options = array(
            0 => 'Select Sex',
            'M' => 'Male',
            'F' => 'Female'
        );
        ?>
        <select id="gender">
            <?php
            foreach ($options as $value => $label) {
                $selected = ($gender == $value) ? 'selected="selected"' : '';
                echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
            }
            ?>
        </select>
    </div>

    <div>
        <span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Province:</span>
        <?php echo '<select class="form-control" id="provid" onchange="loadPage(\'pages/selectcity.php?provid=\'+this.value,\'tmp_city\');">';
            echo '<option value="0" style="color:gray">Select Province</option>';
            $rs1 = mysqli_query($db_connection,'SELECT provid, provincename from tblloc_province order by provincename');
            while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                if ($provid==$rw1['provid']) { $sel = 'selected="selected"'; }
                echo '<option value="'.$rw1['provid'].'" '.$sel.'>'.$rw1['provincename'].'</option>';
            }
        echo '</select>'; ?><br>
        
        <span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>City:</span>
        <?php echo '<span id="tmp_city"><select class="form-control" id="cityid" onchange="loadPage(\'pages/selectbarangay.php?cityid=\'+this.value+\'&provid=\'+object(\'provid\').value,\'tmp_brgy\');">';
            echo '<option value="0">Select City</option>';
            $rs1 = mysqli_query($db_connection,'SELECT cityid,cityname from tblloc_city where provid='.$provid.' ORDER BY cityname');
            while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                if ($cityid==$rw1['cityid']) { $sel = 'selected="selected"'; }
                echo '<option value="'.$rw1['cityid'].'" '.$sel.'>'.$rw1['cityname'].'</option>';
            }
        echo '</select></span>'; ?><br>
        
        <span style="display: inline-block; width: 120px; color:black;"><span class="required">*</span>Barangay:</span>
        <?php echo '<span id="tmp_brgy"><select class="form-control" id="brgyid">';
            echo '<option value="0">Select Barangay</option>';
            $rs1 = mysqli_query($db_connection,'SELECT brgyid,barangayname from tblloc_brgy where cityid='.$cityid.' ORDER BY barangayname');
            while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
                if ($brgyid==$rw1['brgyid']) { $sel = 'selected="selected"'; }
                echo '<option value="'.$rw1['brgyid'].'" '.$sel.'>'.ucwords(strtolower($rw1['barangayname'])).'</option>';
            }
        echo '</select></span>'; ?><br>
		 <br>
		 <span style="display: inline-block; width: 120px; color:black;"><span class="required"></span>Street #:</span>
        
        <input placeholder="Input your street" id="address" name="address" value="<?=$address?>" type="text">
   
    </div>
    
</form>
<div align="right"><button class="btn btn-primary btm-sm" onclick="update_info(<?=$studentid?>);">Update</button></div>
