<?php 

$title = "Register";
$hideHeader = true;
$hideFooter = true;
include 'includes/header.php';
?>

<div class="auth-page">
    <a href="<?php echo $basePath; ?>index.php" class="back">&larr;</a>
    <div class="card wide">
        <div class="auth-card-body">
            <h3>Create an Account</h3>

            <form action="login/register_handler.php" method="post">
                <div class="field">
                    <label class="form-label">Complete Name</label>
                    <input type="text" name="full-name" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="row">
                    <div class="column">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="column">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="row three">
                    <div class="column">
                        <label class="form-label">Region</label>
                        <select name="region" id="region" class="form-select" required></select>
                    </div>
                    <div class="column">
                        <label class="form-label">Province</label>
                        <select name="province" id="province" class="form-select" required></select>
                    </div>
                    <div class="column">
                        <label class="form-label">City/Municipality</label>
                        <select name="city" id="city" class="form-select" required></select>
                    </div>
                    <div class="column">
                        <label class="form-label">Barangay</label>
                        <select name="city" id="barangay" class="form-select" required></select>
                    </div>
                </div>

                <div class="field">
                    <label class="form-label">Street / House No.</label>
                    <input type="text" name="street-addy" class="form-control" required placeholder="e.g. 123 Juan Dela Cruz St., Brgy. Matibay">
                </div>

                <div class="field">
                    <label class="form-label">Contact Number</label>
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