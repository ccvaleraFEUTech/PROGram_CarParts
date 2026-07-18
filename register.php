<?php 
session_start();
require_once 'includes/functions.php';

$title = "Register";
$basePath = '';
$hideHeader = true;
$hideFooter = true;
$isLogged = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo $basePath; ?>assets/images/favicon.ico">
    <script src="https://kit.fontawesome.com/5e3c72a53d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body data-base-path="<?php echo $basePath; ?>">
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include 'includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <div class="auth-page">
            <div class="card wide">
                <div class="auth-card-body">
                    <?php display_message('auth'); ?>
                    <h3>Create an Account</h3>
                    <form action="login/register_handler.php" method="post">
                        <div class="field">
                            <label class="form-label">First Name <span class="required-symbol">*</span></label>
                            <input type="text" name="first" class="form-control" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Middle Name <span class="required-symbol">*</span></label>
                            <input type="text" name="middle" class="form-control" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Last Name <span class="required-symbol">*</span></label>
                            <input type="text" name="surn" class="form-control" required>
                        </div>
                        <div class="field">
                            <label class="form-label">Email Address <span class="required-symbol">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                            <p id="email-error-message" style="display: none">Invalid email format.</p>
                        </div>

                        <div class="row">
                            <div class="column">
                                <label class="form-label">Password <span class="required-symbol">*</span></label>
                                <div class="password-wrapper">
                                    <input type="password" name="password" class="form-control" required>
                                    <i class="fa-solid fa-eye-slash password-toggle"></i>
                                </div>

                                <ul class="password-requirements" id="password-requirements" style="display: none">
                                    <li data-rule="length">
                                        <i class="fa-solid fa-circle"></i> At least 8 characters
                                    </li>
                                    <li data-rule="uppercase">
                                        <i class="fa-solid fa-circle"></i> One uppercase letter
                                    </li>
                                    <li data-rule="lowercase">
                                        <i class="fa-solid fa-circle"></i> One lowercase letter
                                    </li>
                                    <li data-rule="number">
                                        <i class="fa-solid fa-circle"></i> One number
                                    </li>
                                    <li data-rule="symbol">
                                        <i class="fa-solid fa-circle"></i> One special character
                                    </li>
                                </ul>
                            </div>

                            <div class="column">
                                <label class="form-label">Confirm Password <span class="required-symbol">*</span></label>
                                <div class="password-wrapper">
                                    <input type="password" name="confirm_password" class="form-control" required>
                                    <i class="fa-solid fa-eye-slash password-toggle"></i>
                                </div>
                                <p id="confirm-password-error-message" style="display: none">Passwords do not match.</p>
                            </div>
                        </div>

                        <div class="row three">
                            <div class="column">
                                <label class="form-label">Region <span class="required-symbol">*</span></label>
                                <select name="region" id="region" class="form-select" required></select>
                            </div>
                            <div class="column">
                                <label class="form-label">Province <span class="required-symbol">*</span></label>
                                <select name="province" id="province" class="form-select" required></select>
                            </div>
                            <div class="column">
                                <label class="form-label">City/Municipality <span class="required-symbol">*</span></label>
                                <select name="city" id="city" class="form-select" required></select>
                            </div>
                            <div class="column">
                                <label class="form-label">Barangay <span class="required-symbol">*</span></label>
                                <select name="barangay" id="barangay" class="form-select" required></select>
                            </div>
                        </div>

                        <div class="field">
                            <label class="form-label">Street / House No. <span class="required-symbol">*</span></label>
                            <input type="text" name="street-addy" class="form-control" required placeholder="e.g. 123 Juan Dela Cruz St., Brgy. Matibay">
                        </div>

                        <div class="field">
                            <label class="form-label">Contact Number <span class="required-symbol">*</span></label>
                            <input type="text" name="contact-number" class="form-control" required placeholder="e.g. 09123456789">
                            <p id="phone-error-message" style="display: none">Please enter a valid phone number (e.g., 09123456789).</p>
                        </div>

                        <button type="submit" class="submit-btn">Register</button>
                    </form>

                    <p class="forgot">
                        Already have an account? <a href="login.php">Login Here</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include 'includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/location.js"></script>
    <script type="module" src="<?php echo $basePath; ?>js/registration.js"></script>
</body>
</html>
