<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../resend-confirmation.php');
}

$email = strtolower(clean_input($_POST['email']));
$safeEmail = mysqli_real_escape_string($connection, $email);
$result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$safeEmail' AND status = 'Active'");

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if ($user['email_status'] === 'Pending') {
        $token = bin2hex(random_bytes(32));
        $userId = (int) $user['id'];
        mysqli_query($connection, "UPDATE users SET verification_token = '$token', verification_expires_at = DATE_ADD(NOW(), INTERVAL 24 HOUR) WHERE id = $userId");

        if (!send_confirmation_email($user['email'], user_full_name($user), $token)) {
            set_message('The confirmation email could not be sent. Check the mailer settings and try again.', 'error');
            redirect_to('../resend-confirmation.php');
        }
    }
}

set_message('If the account exists and is pending, a confirmation email has been sent.');
redirect_to('../login.php');
?>
