<?php
	if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }	
	
	$email = $_GET['email'];
	$studentid = GetValue('SELECT facultyid FROM tblfaculty WHERE email=\''.$email.'\'');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	
	function randomString($length = 5) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
		$otp = randomString();
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
        $mail->Subject = 'OTP';


        $mail->Body = 'This is your OTP '.$otp.'';
        
        try {
            $mail->send();
			echo '';
			echo '<span style="color:green;">Email Sent</span>';
			mysqli_query($db_connection,'INSERT INTO tblreset_f SET token=\''.$otp.'\',facultyid='.$studentid.' ');
			
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

$db_connection->close();

?>
