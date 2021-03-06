<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    if (isset($_POST['clientname']))
        $name = $_POST['clientname'];

    if (isset($_POST['clientnemail']))
        $email = $_POST['clientnemail'];

    if (isset($_POST['clientsubject']))
        $subject = $_POST['clientsubject'];

    if (isset($_POST['clientmessage']))
        $message = $_POST['clientmessage'];

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'DESKTOP-J22OBA1';
    $mail->Port       = 25;
    $mail->setFrom("$email", "$name"); //sender
    $mail->addAddress('mccafe@safi.ma');     //receiver (ME)

    //Content
    $mail->isHTML(true);
    $mail->Subject = "$subject";
    $mail->Body    = "<h2>From: $name </h2><br><h3>Email: $email </h3><h4>Message:<p>$message</p></h4>";
    $mail->AltBody = "sorry your mail provider doesn't support html";

    $mail->send();
    echo 'Message has been sent';
    header('Location: ../index.html');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
