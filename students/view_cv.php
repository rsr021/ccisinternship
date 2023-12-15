<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



	
$cv = GetValue('select cv FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
?>


<style>
        .scroll-container {
            width: 100%;
            max-height: 600px;
            overflow-y: auto;
        }
</style>
</head>
    <div class="scroll-container" style="text-align: center;">
        <?php echo'<img style="background-position: center; background-repeat: no-repeat; background-size: cover;  width: 100%" src="./page_load/cv/'.$cv.'" alt="Curriculum Vitae">';?>
    </div>
