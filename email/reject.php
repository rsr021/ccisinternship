<?php
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }	
	$applicationid = $_GET['applicationid'];
	$studentid = GetValue('SELECT studentid FROM tblapplication WHERE applicationid='.$applicationid);
	$email = GetValue('SELECT email FROM tblstudent WHERE studentid='.$studentid);
	
	$companyid = GetValue('SELECT companyid FROM tblapplication WHERE applicationid='.$applicationid);

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
        $mail->Subject = 'Disapprove Application';


        $mail->Body = 'Your application on '.CompanyName($companyid).' has been reject.
				Please wait apply to another company or contact the ojt coordinator.';
        
        try {
            $mail->send();
			echo '';
			mysqli_query($db_connection,'UPDATE tblapplication SET is_reject=1,status=2 WHERE applicationid='.$_GET['applicationid']);
            echo '<span style="color:green;">Email Sent</span>';
			
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

$db_connection->close();

?>
