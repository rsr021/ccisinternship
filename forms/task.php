<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$reportid = $_GET['reportid'];
//echo $studentid;
$title = GetValue('SELECT title from tblaccomplishmentreport WHERE reportid='.$reportid);
$datefrom = GetValue('SELECT datefrom from tblaccomplishmentreport WHERE reportid='.$reportid);
$dateto = GetValue('SELECT dateto from tblaccomplishmentreport WHERE reportid='.$reportid);
$timein = GetValue('SELECT timein from tblaccomplishmentreport WHERE reportid='.$reportid);
$timeout = GetValue('SELECT timeout from tblaccomplishmentreport WHERE reportid='.$reportid);
$description = GetValue('SELECT description from tblaccomplishmentreport WHERE reportid='.$reportid);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Accomplishment Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
        }

        h4 {
            color: #333;
        }

        p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<br>
<h4>Weekly Accomplishment Report</h4>

<p><strong>Title:</strong>&nbsp;<?=$title?></p>
<p><strong>Inclusive Date:</strong>&nbsp;<?=date('M d, Y', strtotime($datefrom)).'&nbsp;-&nbsp;'.date('M d, Y', strtotime($dateto))?></p>

<p><strong>Time In:</strong>&nbsp; <u><?=date('h:i a', strtotime($timein))?> </u><strong>Time Out:&nbsp;</strong><u><?=date('h:i a', strtotime($timeout))?></u></p>
<p><strong>Total no of Hours:</strong> &nbsp;<u>

<?
$rs = mysqli_query($db_connection,'SELECT SUM(totalhours) as tot FROM tblaccomplishmentreport_dtr WHERE reportid='.$reportid);
while($rw = mysqli_fetch_array($rs)){
	echo $rw['tot'];
}
?>

</u></p>

<!--<p>Please classify activities as Systems Analysis and Design (SAD), Programming, System Maintenance, System Testing, IT Documentation and Research, Web Design, Networking, PC Troubleshooting, System Implementation, IT Training and Meeting, and other IT-related Activities.</p>-->
<p>Activities:</p
<?php
$result = mysqli_query($db_connection,'SELECT idnum,reportid, actid 
		FROM tblaccomplishmentreport_details WHERE reportid='.$reportid);
while($row = mysqli_fetch_array($result)){
	echo'<p style="margin-top:-10px;">-&nbsp;'.Activity($row['actid']).'</p>';
}		

?>

<table style="width:600px;">
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;<?=substr($description,0,130)?></td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;<?=substr($description,131,261)?></td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;<?=substr($description,262,392)?></td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid black;">&nbsp;</td>
	</tr>
	
</table>


</body>
</html>