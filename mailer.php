<?php

require_once "../phpmailer/src/PHPMailer.php";
require_once "../phpmailer/src/SMTP.php";
require_once "../phpmailer/src/Exception.php";

$isLocal = ($_SERVER['HTTP_HOST'] === 'localhost');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_confirmation_email($to_email, $to_name, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $smtp_username = 'chocholoy@gmail.com';
        $mail->Username = $smtp_username;
        $mail->Password = 'cdwzebfddrfuvisd'; 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Timeout = 15;

        $mail->setFrom($smtp_username, "PROGram Registration Confirmation");
        $mail->addAddress($to_email, $to_name); 

        // if it is localhost, use localhost, otherwise use the domain
        $confirmation_link = $isLocal ? 
            "http://localhost/PROGram_CarParts/confirm_email.php?token=" . urlencode($token) 
            : "https://program-carparts.infinityfree.me/confirm_email.php?token=" . urlencode($token);
        $mail->isHTML(true);
        $mail->Subject = "Confirm Your Registration";
        $mail->Body = "
            <p>Dear <strong>$to_name</strong>,</p>
            <p>Thank you for registering. Please click the following link to confirm your registration:</p>
            <p><a href='$confirmation_link'>Confirm Account!</a></p>
            <p>If the link does not work, click copy-paste this link to your web browser:</p>
            <p><a href='$confirmation_link'>Confirm_link!</a></p>
            <p>Best regards,<br>PROGram</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $exception) {
        error_log("Confirmation email failed: " . $mail->ErrorInfo);
        return false;
    }
}

?>