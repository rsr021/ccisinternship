<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


$studentid = $_GET['studentid'];
//echo $studentid;
/*$title = GetValue('SELECT title from tblaccomplishmentreport WHERE reportid='.$reportid);
$datefrom = GetValue('SELECT datefrom from tblaccomplishmentreport WHERE reportid='.$reportid);
$dateto = GetValue('SELECT dateto from tblaccomplishmentreport WHERE reportid='.$reportid);
$timein = GetValue('SELECT timein from tblaccomplishmentreport WHERE reportid='.$reportid);
$timeout = GetValue('SELECT timeout from tblaccomplishmentreport WHERE reportid='.$reportid);
$totalhours = GetValue('SELECT totalhours from tblaccomplishmentreport WHERE reportid='.$reportid);
$description = GetValue('SELECT description from tblaccomplishmentreport WHERE reportid='.$reportid);*/
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

<? echo '<table border="1" style="border-collapse:collapse;">
            <tr>
                <th>Entry Report</th>
                <th>Total Hours</th>
                <th>&nbsp;</th>
            </tr>';
            
			$rs2 = mysqli_query($db_connection,'SELECT * FROM tblaccomplishmentreport WHERE studentid='.$studentid);
			while($rw2 = mysqli_fetch_array($rs2)){
				echo'<tr>
					<td>'.$rw2['reportid'].'</td>
					<td>'.date('M d, Y', strtotime($rw2['datefrom'])).'-'.date('M d, Y', strtotime($rw2['dateto'])).'</td>
					<td><a href="javacsript:void()" onclick="openCustom(\'forms/task.php?reportid='.$rw2['reportid'].'\',900,900)">DONE</a></td>
				</tr>';
			}
			
        echo'</table>'; ?>


</body>
</html>