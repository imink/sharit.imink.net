<?php
require_once(dirname(dirname(dirname(__FILE__)))."/framework/import.php");
?>
<!--
// lucy


// $_LAYOUT['left'] =  SharIt::app()->loadView("product/include/ele_sidebar.php");

// $_LAYOUT['right'] =  SharIt::app()->loadView("product/include/ele_no_product.php");

// SharIt::app()->layout($_LAYOUT,2);
-->


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - sendmail test</title>
</head>
<body>
<?php
//require '../PHPMailerAutoload.php';

$mail = SharIt::mailer();

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->isSendmail();
//Set who the message is to be sent from
$mail->setFrom('lucy.jiang.lulu+test@gamil.com', 'First Last');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('lucy.jiang.lulu@gmail.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('This is an html message body');
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
</body>
</html>
