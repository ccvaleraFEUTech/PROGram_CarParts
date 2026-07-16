<?php

require_once "../phpmailer/src/PHPMailer.php";
require_once "../phpmailer/src/SMTP.php";
require_once "../phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_confirmation_email($to_email, $to_name, $token) {
    $config_file = "../mailer_config.php";

    if (!file_exists($config_file)) {
        error_log("Confirmation email failed: mailer_config.php is missing.");
        return false;
    }

    $config = require $config_file;
    $smtp_username = isset($config['username']) ? $config['username'] : '';
    $smtp_password = isset($config['password']) ? $config['password'] : '';

    if ($smtp_username === '' || $smtp_password === '' || $smtp_username === 'your-email@gmail.com') {
        error_log("Confirmation email failed: SMTP credentials are not configured.");
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Timeout = 15;

        $mail->setFrom($smtp_username, "PROGram Registration Confirmation");
        $mail->addAddress($to_email, $to_name);

        $confirmation_link = "http://localhost/PROGram_CarParts/confirm_email.php?token=" . urlencode($token);
        $mail->isHTML(true);
        $mail->Subject = "Confirm Your Registration";
        $mail->Body = "
        <p>Dear <strong>$to_name</strong>,</p>
        <p>Thank you for registering. Please click the following link to confirm your registration:</p>
        <p><a href='$confirmation_link'>Confirm Account!</a></p>
        <p>If the link does not work, copy and paste this link into your web browser:</p>
        <p>$confirmation_link</p>
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
