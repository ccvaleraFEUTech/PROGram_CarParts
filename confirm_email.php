<?php
session_start();
require_once 'includes/database.php';
require_once 'includes/functions.php';

$token = isset($_GET['token']) ? $_GET['token'] : '';

if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
    set_message('The confirmation link is invalid.', 'error');
    redirect_to('resend-confirmation.php');
}

$safeToken = mysqli_real_escape_string($connection, $token);
$result = mysqli_query($connection, "SELECT id FROM users WHERE verification_token = '$safeToken' AND verification_expires_at >= NOW() AND email_status = 'Pending'");

if (mysqli_num_rows($result) !== 1) {
    set_message('The confirmation link is invalid or has expired.', 'error');
    redirect_to('resend-confirmation.php');
}

$user = mysqli_fetch_assoc($result);
$userId = (int) $user['id'];
$updated = mysqli_query($connection, "UPDATE users SET email_status = 'Confirmed', verification_token = NULL, verification_expires_at = NULL WHERE id = $userId");

if (!$updated) {
    set_message('Email confirmation failed. Please try again.', 'error');
    redirect_to('resend-confirmation.php');
}

mysqli_query($connection, "INSERT INTO audit_logs (user_id, action, module, details, created_at) VALUES ($userId, 'Confirmed Email', 'Auth', 'Confirmed customer email address', NOW())");

if (isset($_SESSION['user_id'])) {
    set_message('Your email has been confirmed successfully.');
    redirect_to('pages/profile.php');
} else {
    set_message('Your email is confirmed. You can now log in.');
    redirect_to('login.php');
}
?>
