<?php 
session_start();

$title = "Login";
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
<body>
    <!-- HEADER -->
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include 'includes/header.php'; ?>
    <?php endif; ?>

    <!-- MAIN -->
    <main>
        <div class="auth-page">
            <a href="<?php echo $basePath; ?>index.php" class="back">&larr;</a>
            <div class="card">
                <div class="auth-card-body">
                    <h3>Login</h3>
                    <form action="login/login_handler.php" method="post">
                        <div class="field">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                            <p id="email-error-message" style="display: none">Email is required.</p>
                        </div>
                        <div class="field">
                            <label class="form-label">Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" class="form-control" required>
                                <i class="fa-solid fa-eye-slash password-toggle"></i>
                            </div>
                            <p id="password-error-message" style="display: none">Password is required.</p>
                        </div>

                        <button type="submit" class="submit-btn">Login</button>
                    </form>

                    <p class="forgot">
                        Don't have an account? <a href="register.php">Register Here</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include 'includes/footer.php'; ?>
    <?php endif; ?>

    <!-- JAVASCRIPT -->
    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script type="module" src="<?php echo $basePath; ?>js/login.js"></script>
</body>
</html>
