<?php
require_once 'error.php';
include "PHPMailer/class.phpmailer.php"; // include the class name
class Emailer {
	public static function sendEmail($to,$message,$subject) 
{
	
	$mail = new PHPMailer (); // create a new object
	$mail->IsSMTP (); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML ( true );
	$mail->Username = "liverpool.group.projects@gmail.com";
	$mail->Password = "sebcoope2014";
	$mail->SetFrom ( "liverpool.group.projects@gmail.com" );
	$mail->Subject =$subject;
	$mail->Body =$message;
	$mail->AddAddress ($to);
	if (! $mail->Send ()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		//echo "Message has been sent";
	}
}
	
}
?>