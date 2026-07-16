<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

if (isset($_SESSION['user_id'])) {
    add_audit_log($connection, 'Logged Out', 'Auth', 'Signed out of the website');
}

session_unset();
session_destroy();
session_start();
set_message('You have been logged out.');
redirect_to('../login.php');
?>

