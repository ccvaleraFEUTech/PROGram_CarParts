<?php 

$title = "Register";
$basePath = '';
$hideHeader = true;
$hideFooter = true;
include 'includes/header.php';
?>

<div class="auth-page">
    <?php echo $basePath; ?>index.php class="back">&larr;</a>
    <div class="card wide">
        <div class="auth-card-body">
            <h3>Create an Account</h3>

            .php" method="post">
                <div class="field">
                    <label class="form-label">Complete Name <span class="required-symbol">*</span></label>
                    <input type="text" name="full-name" class="form-control" required>
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

                        <ul class="password-requirements" id="password-requirements">
                            <li data-rule="minlength">
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
                            <li data-rule="special">
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
                    <input type="text" name="contact-number" class="form-control" required placeholder="e.g. 0912 345 6789">
                </div>

                <button type="submit" class="submit-btn">Register</button>
            </form>

            <p class="forgot">
                Already have an account? <a href="login.php">Login Here</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>