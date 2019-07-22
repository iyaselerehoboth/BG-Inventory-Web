<?php
	error_reporting(E_ALL);

	include("config.php");
	
	include("PHPMailer/src/Exception.php");
	include("PHPMailer/src/PHPMailer.php");
	include("PHPMailer/src/SMTP.php");

	$mail = new PHPMailer\PHPMailer\PHPMailer(true);

	try{

		//Server settings.
		$mail->SMTPDebug = 3;
		$mail->IsSMTP();
		$mail->Host = 'smtp.zoho.com';
		$mail->SMTPSecure = 'SSL';
		$mail->Port = 465;

 		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@babbangona.com';
		$mail->Password = 'Rehoboth1*';

		
		//Recipients
		$mail->setFrom('no-reply@babbangona.com');
		$mail->AddAddress('rehoboth.iyasele@babbangona.com'); //Note, the name is optional.
		/*$mail->addReplyTo('rehoboth.iyasele@gmail.com', 'Information');*/
		$mail->addCC('rehobothi@yahoo.com');
		//$mail->addBCC('bcc@example.com');

		/*//Attachments
		$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    	$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name*/

    	//Content

		$mail->IsHTML(true);      // Set email format to HTML
    	$mail->Subject = 'Here is the subject';
    	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    	if($mail->send()){
    		echo 'Message has been sent';	
    	}
    	
	}catch(Exception $e){
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}	

?>