<?php

require_once ($include . '_class_email.php');
$mail = new PHPMailer;
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$from_name = 'Lets do It';
$from = 'rene@sisdoc.com.br';

//Set the hostname of the mail server
$mail->Host = 'mail.sisdoc.com.br';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'rene@sisdoc.com.br';
//Password to use for SMTP authentication
$mail->Password = 'Viviane@1970';
//Set who the message is to be sent from
$mail->setFrom($from, $from_name);

//Set an alternative reply-to address
$mail->addReplyTo('reol@sisdoc.com.br', 'Reol');
//Set who the message is to be sent to

$mail->addAddress($email_addr, $email_nome);

//Set the subject line
$mail->Subject = $title_sample;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message_sample, dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = '';
$mail->Body = $body;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>