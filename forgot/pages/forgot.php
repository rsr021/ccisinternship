<?php
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }	
	
	$email = $_GET['email'];
	$email = GetValue('SELECT email FROM tblstudent WHERE email='.$email);
	

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
        $mail->Subject = 'Application Approve';


        $mail->Body = '';
        
        try {
            $mail->send();
			echo '';
			echo '<span style="color:green;">Email Sent</span>';
			
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

$db_connection->close();

?>
