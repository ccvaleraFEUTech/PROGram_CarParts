<?php 

$title = "Register";
$hideHeader = true;
$hideFooter = true;
include 'includes/header.php';

    if(isset($_POST['submit'])){
        $npass = $_POST['pass'];
        $cpass = $_POST['conf'];
        
        $full = trim($_POST['first']) . " " . trim($_POST['middle']) . " " . trim($_POST['surn']);
        $full = preg_replace('/\s+/', ' ', trim($full));

        $email = trim($_POST['email']);
        if($npass == $cpass){

            $email_at = strpos($email, '@');
            $email_dot = strpos($email, '.');

            if($email_at !== false && $email_dot !== false && $email_at > 0 && $email_dot > $email_at + 1 && $email_dot < strlen($email) - 1){
                $user = $_POST['user'];
                $connum = $_POST['connum'];

                $message = "Registration Successful";
                $type = "success";

                $_SESSION['success_message'] = $message;
                header("Location: ../login.php");
                exit();
            } else {
                $message = "Please enter a valid email address";
                $type = "error";
                $_SESSION['error_message'] = $message;
                header("Location: ../register.php");
                exit();
            }
        } else{
            $message = "Passwords do not match";
            $type = "error";

            $_SESSION['error_message'] = $message;
            header("Location: register.php");
            exit();
        }
    }
?>

<div class="auth-page">
    <a href="<?php echo $basePath; ?>index.php" class="back">&larr;</a>
    <div class="card wide">
        <div class="auth-card-body">
            <h3>Create an Account</h3>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="status success">
                    <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                    ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="status error">
                    <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                    ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="field">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="middle" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Surname</label>
                    <input type="text" name="surn" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="row">
                    <div class="column">
                        <label class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="pass" id="pass" class="form-control password-input" required>
                            <span id="eye-pass" class="eye-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="column">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="conf" id="conf" class="form-control password-input" required>
                            <span id="eye-conf" class="eye-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row three">
                    <div class="column">
                        <label class="form-label">Region</label>
                        <select name="region" id="region" class="form-select"></select>
                    </div>
                    <div class="column">
                        <label class="form-label">Province</label>
                        <select name="province" id="province" class="form-select"></select>
                    </div>
                    <div class="column">
                        <label class="form-label">City/Municipality</label>
                        <select name="city" id="city" class="form-select"></select>
                    </div>
                    <div class="column">
                        <label class="form-label">Barangay</label>
                        <select name="city" id="barangay" class="form-select"></select>
                    </div>
                </div>

                <div class="field">
                    <label class="form-label">Street / House No.</label>
                    <input type="text" name="street-addy" class="form-control" required placeholder="e.g. 123 Juan Dela Cruz St.">
                </div>

                <div class="field">
                    <label class="form-label">Contact Number</label>
                    <input type="text" name="contact-number" class="form-control" required placeholder="e.g. 0912 345 6789">
                </div>

                <button type="submit" class="submit-btn" name="submit">Register</button>
            </form>

            <p class="forgot">
                Already have an account? <a href="login.php">Login Here</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>