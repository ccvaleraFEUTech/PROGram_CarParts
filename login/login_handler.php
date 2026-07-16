<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../login.php');
}

$email = strtolower(clean_input($_POST['email']));
$password = $_POST['password'];
$email = mysqli_real_escape_string($connection, $email);

$result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email' AND status = 'Active'");

if (mysqli_num_rows($result) !== 1) {
    set_message('Invalid email or password.', 'error');
    redirect_to('../login.php');
}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password, $user['password'])) {
    set_message('Invalid email or password.', 'error');
    redirect_to('../login.php');
}

session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = user_full_name($user);
$_SESSION['user_role'] = $user['role'];

add_audit_log($connection, 'Logged In', 'Auth', 'Signed in to the website');
if ($user['email_status'] === 'Pending') {
    set_message('Welcome, ' . $_SESSION['user_name'] . '! Your email confirmation is still pending. Please check your email for the confirmation link.');
} else {
    set_message('Welcome back, ' . $_SESSION['user_name'] . '!');
}

if ($user['role'] !== 'Customer') {
    redirect_to('../seller/dashboard.php');
}

redirect_to('../index.php');
?>
