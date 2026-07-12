<?php
// register.php
$pageTitle = "Register";
include 'includes/header.php';
?>

<!-- ==========================================================
     REGISTRATION FORM
     Fields required by the brief: full name, email, password,
     confirm password, complete address, contact number.

     OPTION A: single-column stacked form inside a centered card
               (matches login.php for a consistent look)
     OPTION B: two-column layout (name/email left, address/contact
               right) since this form has more fields than login
     ========================================================== -->
<div class="container my-5">
    <div class="auth-form" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Create an Account</h3>

                <!-- Backend teammate will point this to login/register_handler.php -->
                <form action="login/register_handler.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Complete Name</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                        <!-- HTML5 type="email" already validates the format
                             (Module topic: Form Validation) -->
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>

                    <!-- Region -> Province -> City dropdowns, powered by
                         assets/js/location-dropdowns.js + the embedded
                         PH location data in assets/js/ph-locations-data.js.
                         Picking a Region fills Province; picking a Province
                         fills City/Municipality. -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Region</label>
                            <select class="form-select" id="region" name="region" required></select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Province</label>
                            <select class="form-select" id="province" name="province" required></select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">City/Municipality</label>
                            <select class="form-select" id="city" name="city" required></select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Street / House No. / Barangay</label>
                        <input type="text" class="form-control" name="street_address" required
                               placeholder="e.g. 123 Sampaguita St., Brgy. San Isidro">
                        <!-- Combined with Region/Province/City above, this
                             makes up the "Complete Address" the brief asks for. -->
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact_number" required>
                    </div>

                    <!-- Placeholder for validation error messages
                         (e.g. "Passwords do not match") -->
                    <!-- <div class="alert alert-danger">Passwords do not match.</div> -->

                    <button type="submit" class="btn btn-brand w-100">Register</button>
                </form>

                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
