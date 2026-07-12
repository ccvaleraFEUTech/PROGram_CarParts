<?php
// login.php
$pageTitle = "Login";
include 'includes/header.php';
?>

<!-- ==========================================================
     LOGIN FORM
     See style.css -> SECTION: FORMS
     OPTION A: centered card, plain white background (.auth-form + .card)
     OPTION B: split screen — form on one side, image/branding on the other
                (use .row with .col-md-6 + .col-md-6)
     ========================================================== -->
<div class="container my-5">
    <div class="auth-form">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Login</h3>

                <!-- Backend teammate will point this to login_handler.php -->
                <form action="login/login_handler.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <!-- Placeholder for an error message from the backend,
                         e.g. "Invalid email or password."
                         OPTION A: Bootstrap .alert.alert-danger above the form
                         OPTION B: small red text under the password field -->
                    <!-- <div class="alert alert-danger">Invalid email or password.</div> -->

                    <button type="submit" class="btn btn-brand w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="register.php">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
