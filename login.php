<?php 
$title = "Login";
$hideHeader = true;
$hideFooter = true;
include 'includes/header.php';

    if(isset($_POST['submit'])){
        $email = trim($_POST['email']);
        $pass = $_POST['password'];

        $email_at = strpos($email, '@');
        $email_dot = strpos($email, '.');

        if($email_at !== false && $email_dot !== false && $email_at > 0 && $email_dot > $email_at + 1 && $email_dot < strlen($email) - 1 && !empty($pass)){
            $_SESSION['user_id'] = 1; 
            header("Location: index.php");
            exit();
            
        } else {
            $_SESSION['error_message'] = "Invalid email or password";
            header("Location: login.php");
            exit();
        }
    }
?>

<div class="auth-page">
    <a href="<?php echo $basePath; ?>index.php" class="back">&larr;</a>
    <div class="card">
        <div class="auth-card-body">
            <h3>Login</h3>
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
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" class="form-control password-input" required>
                        <span id="eye-password" class="eye-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </span>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <p class="forgot">
                Don't have an account? <a href="register.php">Register Here</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>