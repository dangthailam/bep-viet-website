<?php

require_once '/home/nc33e83czzea/public_html/src/PHPMailer.php';
require_once '/home/nc33e83czzea/public_html/src/SMTP.php';
require_once '/home/nc33e83czzea/public_html/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mail = new PHPMailer(true);
    try {
        $body = "Nom: " . $_POST['lastname'];
        $body .= "<br>";
        $body .= "Prenom: " . $_POST['firstname'];
        $body .= "<br>";
        $body .= "Email: " . $_POST['email'];
        $body .= "<br>";
        $body .= "Message: " . $_POST['message'];

        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = 'bepvietcolombes.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nc33e83czzea'; // This was my GoDaddy cPanel username
        $mail->Password = 'Saucon2018@'; // And my GoDaddy cPanel password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('admin@bepvietcolombes.com', 'Admin');
        $mail->addAddress('bepvietcolombes@gmail.com');
        $mail->isHTML(true);

        $mail->Subject = 'Client feedback from: ' . $_POST['email'];
        $mail->Body = $body;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        
        $newURL = "/";
        
        header('Location: '.$newURL);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}