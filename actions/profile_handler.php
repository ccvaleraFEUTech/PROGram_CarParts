<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_once '../mailer.php';
require_login('../login.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../pages/profile.php');
}

$userId = (int) $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'update_profile') {
    $firstName = clean_input($_POST['first_name']);
    $middleName = clean_input($_POST['middle_name']);
    $lastName = clean_input($_POST['last_name']);
    $email = strtolower(clean_input($_POST['email']));
    $contactNumber = str_replace(' ', '', clean_input($_POST['contact_number']));
    $confirmationEmail = $email;
    $confirmationName = trim($firstName . ' ' . $middleName . ' ' . $lastName);

    if (!preg_match('/^[A-Za-z .-]+$/', $firstName . $middleName . $lastName) || !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) || !preg_match('/^09[0-9]{9}$/', $contactNumber)) {
        set_message('Please check your name, email, and contact number.', 'error');
        redirect_to('../pages/profile.php');
    }

    $currentResult = mysqli_query($connection, "SELECT email FROM users WHERE id = $userId");
    $currentUser = mysqli_fetch_assoc($currentResult);
    $emailChanged = $currentUser && $currentUser['email'] !== $email;

    $email = mysqli_real_escape_string($connection, $email);
    $duplicate = mysqli_query($connection, "SELECT id FROM users WHERE email = '$email' AND id != $userId");
    if (mysqli_num_rows($duplicate) > 0) {
        set_message('That email is already used by another account.', 'error');
        redirect_to('../pages/profile.php');
    }

    $firstName = mysqli_real_escape_string($connection, $firstName);
    $middleName = mysqli_real_escape_string($connection, $middleName);
    $lastName = mysqli_real_escape_string($connection, $lastName);
    $contactNumber = mysqli_real_escape_string($connection, $contactNumber);
    $confirmationUpdate = '';
    $token = '';

    if ($emailChanged) {
        $token = bin2hex(random_bytes(32));
        $confirmationUpdate = ", email_status = 'Pending', verification_token = '$token', verification_expires_at = DATE_ADD(NOW(), INTERVAL 24 HOUR)";
    }

    mysqli_query($connection, "UPDATE users SET first_name = '$firstName', middle_name = '$middleName', last_name = '$lastName', email = '$email', contact_number = '$contactNumber'$confirmationUpdate WHERE id = $userId");

    $userResult = mysqli_query($connection, "SELECT * FROM users WHERE id = $userId");
    $_SESSION['user_name'] = user_full_name(mysqli_fetch_assoc($userResult));

    if ($emailChanged) {
        if (send_confirmation_email($confirmationEmail, $confirmationName, $token)) {
            set_message('Your profile was updated. Your email status is Pending until you use the new confirmation link.');
        } else {
            set_message('Your profile was updated, but the confirmation email could not be sent.', 'error');
        }
    } else {
        set_message('Your profile was updated.');
    }
}

if ($action === 'change_password') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $result = mysqli_query($connection, "SELECT password FROM users WHERE id = $userId");
    $user = mysqli_fetch_assoc($result);

    if (!password_verify($currentPassword, $user['password'])) {
        set_message('Your current password is incorrect.', 'error');
        redirect_to('../pages/profile.php');
    }

    if ($newPassword !== $confirmPassword || strlen($newPassword) < 8 || !preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword) || !preg_match('/[^A-Za-z0-9]/', $newPassword)) {
        set_message('The new passwords must match and follow the password requirements.', 'error');
        redirect_to('../pages/profile.php');
    }

    $newPassword = mysqli_real_escape_string($connection, password_hash($newPassword, PASSWORD_DEFAULT));
    mysqli_query($connection, "UPDATE users SET password = '$newPassword' WHERE id = $userId");
    set_message('Your password was changed.');
}

if ($action === 'add_address') {
    $label = mysqli_real_escape_string($connection, clean_input($_POST['label']));
    $street = mysqli_real_escape_string($connection, clean_input($_POST['street']));
    $barangay = mysqli_real_escape_string($connection, clean_input($_POST['barangay']));
    $city = mysqli_real_escape_string($connection, clean_input($_POST['city']));
    $province = mysqli_real_escape_string($connection, clean_input($_POST['province']));
    $region = mysqli_real_escape_string($connection, clean_input($_POST['region']));
    mysqli_query($connection, "INSERT INTO addresses (user_id, label, street_address, barangay, city, province, region, is_default)
                               VALUES ($userId, '$label', '$street', '$barangay', '$city', '$province', '$region', 0)");
    set_message('New address added.');
}

if ($action === 'delete_address') {
    $addressId = (int) $_POST['address_id'];
    mysqli_query($connection, "DELETE FROM addresses WHERE id = $addressId AND user_id = $userId AND is_default = 0");
    set_message('Address removed.');
}

if ($action === 'preferences') {
    $orderUpdates = isset($_POST['order_updates']) ? 1 : 0;
    $promotions = isset($_POST['promotions']) ? 1 : 0;
    mysqli_query($connection, "UPDATE users SET order_updates = $orderUpdates, promotions = $promotions WHERE id = $userId");
    set_message('Notification preferences saved.');
}

redirect_to('../pages/profile.php');
?>
