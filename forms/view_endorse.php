<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



$a = $_GET['companyid'];
$b = $_GET['courseid'];
$c = $_GET['sectionid'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endorsement Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 60px;
        }
        .letter-header {
            text-align: left;
            margin-bottom: 20px;
        }
        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 50px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .letter-body {
            margin-bottom: 20px;
        }
        .closing {
            text-align: left;
        }
		
		.head{
			margin-left:130px;
			margin-top:-125px;
		}
		#d{
			text-align:justify;
		}
		.x{
			margin-top:-15px;
		}
    </style>
</head>
<body>


    <div class="letter-body">
        <?
		$rs = mysqli_query($db_connection,'SELECT studentid FROM tblcompany_ojt WHERE 
								companyid='.$a.' AND courseid='.$b.' AND sectionid='.$c.' ');
								while($rw = mysqli_fetch_array($rs)){
									echo '<p>'.StudentName($rw['studentid']).'</p>';
								}
		?>
		
    </div>

</body>
</html>


