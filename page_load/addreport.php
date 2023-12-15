<?php
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$is_ojt = GetValue('SELECT is_ojt FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
?>

<style>
    body {
        /*background-color: #f2f2f2;*/
        font-family: Arial, sans-serif;
    }

    .container {
        width: 50%;
        margin: 50px auto;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input, textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: rgb(128, 0, 0);
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #800000;
    }
	.button-link {
        display: inline-block;
        padding: 10px 15px;
        background-color: rgb(128, 0, 0);
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
	.button-link2 {
        display: inline-block;
        padding: 10px 15px;
        background-color: grey;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
</style>

<?

$_SESSION['tmp_report'] = 'tmp_report'.$_SESSION['studentid'];
mysqli_query($db_connection,"drop table if exists ".$_SESSION['tmp_report']) or die(mysqli_error($db_connection));
	mysqli_query($db_connection,"CREATE TABLE ".$_SESSION['tmp_report']." (".
	  "`idnum` int(11) NOT NULL AUTO_INCREMENT, ".  
	  "`actid` int(11) default 0, ". 
	  "PRIMARY KEY(idnum)". 
	") ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysqli_error($db_connection));


$_SESSION['tmp_dtr'] = 'tmp_dtr'.$_SESSION['studentid'];
mysqli_query($db_connection,"drop table if exists ".$_SESSION['tmp_dtr']) or die(mysqli_error($db_connection));
	mysqli_query($db_connection,"CREATE TABLE ".$_SESSION['tmp_dtr']." (".
	  "`idnum` int(11) NOT NULL AUTO_INCREMENT, ".  
	  "`day` VARCHAR(128), ". 
	  "`timein` TIME, ". 
	  "`timeout` TIME, ". 
	  "`totalhours` DECIMAL(10,2), ". 
	  "PRIMARY KEY(idnum)". 
	") ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysqli_error($db_connection));

?>
<div class="container">
    <h2 style="text-align: center;">Weekly Accomplishment Report</h2>
    <form>
        <label for="title">Title of weekly report:</label>
        <input type="text" id="title" name="title">

        <label for="dateFrom">Date From:</label>
        <input type="date" id="datefrom" name="datefrom">

        <label for="dateTo">Date To:</label>
        <input type="date" id="dateto" name="dateto">

        <label for="timeIn">Time In:</label>
        <input type="time" id="timein" name="timein">

        <label for="timeOut">Time Out:</label>
        <input type="time" id="timeout" name="timeout">

        <!--<label for="totalHours" hidden>Total No. of Hours:</label>-->
        <input type="number" hidden id="totalhours" name="totalhours">
		
		<!--<label>Check if applicable:</label>
		<table>
			<?
			$rs = mysqli_query($db_connection,'SELECT actid, act FROM tblactivity');
			while($rw = mysqli_fetch_array($rs)){
				echo'<tr>
					<td><input type="checkbox" value="'.$rw['actid'].'" id="me'.$rw['actid'].'"/></td>
					<td>'.$rw['act'].'</td>
				</tr>';
			}
			?>
		
		</table>--><br><br>
		<table class="mytable">
		<tr>
			<td>Day</td>
			<td>Time In</td>
			<td>Time Out</td>
		</tr>
		<tr>
			<td>Monday</td>
			<td><input style="width:110px;" type="time" id="monday_time_in"></td>
			<td><input style="width:110px;" type="time" id="monday_time_out"></td>
			<td><input style="width:110px;" type="checkbox" id="monday_" onclick="monday()"><span style="margin-left:-40px;">Check to add</span></td>
		</tr>
		<tr>
			<td>Tuesday</td>
			<td><input style="width:110px;" type="time" id="tuesday_time_in"></td>
			<td><input style="width:110px;" type="time" id="tuesday_time_out"></td>
			<td><input style="width:110px;" type="checkbox" id="tuesday_" onclick="tuesday()"><span style="margin-left:-40px;">Check to add</span></td>
		</tr>
		<tr>
			<td>Wednesday</td>
			<td><input style="width:110px;" type="time" id="wednesday_time_in"></td>
			<td><input style="width:110px;" type="time" id="wednesday_time_out"></td>
			<td><input style="width:110px;" type="checkbox" id="wednesday_" onclick="wednesday()"><span style="margin-left:-40px;">Check to add</span></td>
		</tr>
		<tr>
			<td>Thursday</td>
			<td><input style="width:110px;" type="time" id="thursday_time_in"></td>
			<td><input style="width:110px;" type="time" id="thursday_time_out"></td>
			<td><input style="width:110px;" type="checkbox" id="thursday_" onclick="thursday()"><span style="margin-left:-40px;">Check to add</span></td>
		</tr>
		<tr>
			<td>Friday</td>
			<td><input style="width:110px;" type="time" id="friday_time_in"></td>
			<td><input style="width:110px;" type="time" id="friday_time_out"></td>
			<td><input style="width:110px;" type="checkbox" id="friday_" onclick="friday()"><span style="margin-left:-40px;">Check to add</span></td>
		</tr>
	</table>
	<div id="bebi"></div>
		
		<br><br><br>
		<label>Check if applicable:</label>
		<table>
			<?php
			$rs = mysqli_query($db_connection, 'SELECT actid, act FROM tblactivity');
			$count = 0;
			while ($rw = mysqli_fetch_array($rs)) {
				if ($count % 2 == 0) {echo '<tr>';}
				
				echo '<td><input type="checkbox" id="me'.$rw['actid'].'" 
				onclick="save_me('.$rw['actid'].')"/></td><td>'.$rw['act'].'</td>';
					  
				if ($count % 2 == 1) {echo '</tr>';}
				
				$count++;
			}
			
			if ($count % 2 == 1) {echo '<td></td></tr>';}
			?>
		</table>
		<div id="show_"></div>
		
		<label for="description">Description:</label>
        <textarea id="description" name="description" style="height: 110px;"></textarea>
		
		
		<a href="javascript:void();" onclick="loadPage('page_load/report.php','content');" class="button-link2" >Back</a>
        <a href="javascript:void()" class="button-link" onclick="submit_weekly()">Submit</a>
    </form>
</div>
