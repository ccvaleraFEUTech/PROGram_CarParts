<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../pages/contact.php');
}

$name = clean_input($_POST['name']);
$email = strtolower(clean_input($_POST['email']));
$subject = clean_input($_POST['subject']);
$message = clean_input($_POST['message']);

if ($name === '' || $subject === '' || $message === '' || !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
    set_message('Please complete the contact form correctly.', 'error');
    redirect_to('../pages/contact.php');
}

$userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 'NULL';
$name = mysqli_real_escape_string($connection, $name);
$email = mysqli_real_escape_string($connection, $email);
$subject = mysqli_real_escape_string($connection, $subject);
$message = mysqli_real_escape_string($connection, $message);

mysqli_query($connection, "INSERT INTO contact_messages (user_id, name, email, subject, message, created_at)
                           VALUES ($userId, '$name', '$email', '$subject', '$message', NOW())");
set_message('Your concern was submitted.');
redirect_to('../pages/contact.php');
?>
