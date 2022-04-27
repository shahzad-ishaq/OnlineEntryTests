<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
function send_email($email,$name,$massage_from,$massage)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'mail.kips.edu.pk';
    $mail->SMTPAuth = true;
    $mail->Username = 'no_reply@kips.edu.pk';
    $mail->Password = 'sDhSs}7!.dHw<qd*';
    $mail->SMTPSecure = 'none';
    $mail->Port = 25;
    $mail->setFrom('no_reply@kips.edu.pk', $massage_from);
  
    $mail->addAddress($email);
    $mail->Subject = "KIPS Online Admission";
// Set email format to HTML
    $mail->isHTML(true);
    $mailContent = $massage;
    $mail->Body = $mailContent;
   if (!$mail->send()) {
        return 'Message could not be sent.';
       return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
       return 'Message has been sent';
    }
}