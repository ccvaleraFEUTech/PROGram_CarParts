<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../register.php');
}

$firstName = clean_input($_POST['first']);
$middleName = clean_input($_POST['middle']);
$lastName = clean_input($_POST['surn']);
$email = strtolower(clean_input($_POST['email']));
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$region = clean_input($_POST['region']);
$province = clean_input($_POST['province']);
$city = clean_input($_POST['city']);
$barangay = clean_input($_POST['barangay']);
$streetAddress = clean_input($_POST['street-addy']);
$contactNumber = str_replace(' ', '', clean_input($_POST['contact-number']));

if (!preg_match('/^[A-Za-z .-]+$/', $firstName . $middleName . $lastName)) {
    set_message('Names may only contain letters, spaces, periods, and hyphens.', 'error');
    redirect_to('../register.php');
}

if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
    set_message('Please enter a valid email address.', 'error');
    redirect_to('../register.php');
}

if (!preg_match('/^09[0-9]{9}$/', $contactNumber)) {
    set_message('Please enter a valid Philippine mobile number.', 'error');
    redirect_to('../register.php');
}

if ($password !== $confirmPassword || strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    set_message('The passwords must match and follow all password requirements.', 'error');
    redirect_to('../register.php');
}

$safeEmail = mysqli_real_escape_string($connection, $email);
$emailResult = mysqli_query($connection, "SELECT id FROM users WHERE email = '$safeEmail'");

if (mysqli_num_rows($emailResult) > 0) {
    set_message('That email address is already registered.', 'error');
    redirect_to('../register.php');
}

$firstName = mysqli_real_escape_string($connection, $firstName);
$middleName = mysqli_real_escape_string($connection, $middleName);
$lastName = mysqli_real_escape_string($connection, $lastName);
$contactNumber = mysqli_real_escape_string($connection, $contactNumber);
$hashedPassword = mysqli_real_escape_string($connection, password_hash($password, PASSWORD_DEFAULT));

$userQuery = "INSERT INTO users (first_name, middle_name, last_name, email, password, contact_number, role, status, created_at)
              VALUES ('$firstName', '$middleName', '$lastName', '$safeEmail', '$hashedPassword', '$contactNumber', 'Customer', 'Active', NOW())";

if (!mysqli_query($connection, $userQuery)) {
    set_message('Registration failed. Please try again.', 'error');
    redirect_to('../register.php');
}

$userId = mysqli_insert_id($connection);
$region = mysqli_real_escape_string($connection, $region);
$province = mysqli_real_escape_string($connection, $province);
$city = mysqli_real_escape_string($connection, $city);
$barangay = mysqli_real_escape_string($connection, $barangay);
$streetAddress = mysqli_real_escape_string($connection, $streetAddress);

mysqli_query($connection, "INSERT INTO addresses (user_id, label, street_address, barangay, city, province, region, is_default)
                           VALUES ($userId, 'Default', '$streetAddress', '$barangay', '$city', '$province', '$region', 1)");

set_message('Registration successful. You can now log in.');
redirect_to('../login.php');
?>
