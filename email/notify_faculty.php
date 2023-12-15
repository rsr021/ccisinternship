<?php
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }	
	$facultyid = $_GET['xxx'];
	$textmes = urldecode($_GET['textmes']);
	$email = GetValue('SELECT email FROM tblfaculty WHERE facultyid='.$facultyid);
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
		
		
        // Send confirmation email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'internshipccis@gmail.com';
        $mail->Password = 'dsjpoivtbkivyapt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('internshipccis@gmail.com', 'CCIS Internship');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Notice';


        $mail->Body = ''.$textmes.'';
        
        try {
            $mail->send();
			echo '';
			//mysqli_query($db_connection,'UPDATE tblcompany_ojt SET is_ojt=1 WHERE studentid='.$_GET['get_student']);
			//mysqli_query($db_connection,'UPDATE tblstudent SET is_ojt=1 WHERE studentid='.$_GET['get_student']);
			// $v = 'UPDATE tblstudent SET is_endorse=1 
			// WHERE courseid='.$courseid.' AND sectionid='.$sectionid.' AND companyid='.$companyid.'';
			// mysqli_query($db_connection,$v);
			
			// $c = 'UPDATE tblcompany_ojt SET is_endorse=1 
			// WHERE courseid='.$courseid.' AND sectionid='.$sectionid.' AND companyid='.$companyid.'';
			// mysqli_query($db_connection,$c);
			
			// $y = 'INSERT INTO tblendorsement SET courseid='.$courseid.', sectionid='.$sectionid.',companyid='.$companyid.'';
            // mysqli_query($db_connection,$y);
			
			//idnum, studentid, companyid, applicationdate, is_endorse,is_reject, is_selected
			
			
			
			
			echo '<span style="color:green;">Email Sent</span>';
			
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

// $db_connection->close();

?>
