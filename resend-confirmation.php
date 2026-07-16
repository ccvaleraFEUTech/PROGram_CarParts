<?php
session_start();
require_once 'includes/functions.php';

$title = 'Resend Confirmation';
$email = isset($_SESSION['pending_email']) ? $_SESSION['pending_email'] : '';
unset($_SESSION['pending_email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <main>
        <div class="auth-page">
            <a href="login.php" class="back">&larr;</a>
            <div class="card">
                <div class="auth-card-body">
                    <?php display_message(); ?>
                    <h3>Resend Confirmation</h3>
                    <p>Enter your registered email address to receive a new confirmation link.</p>
                    <form action="login/resend_confirmation_handler.php" method="post">
                        <div class="field">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <button type="submit" class="submit-btn">Resend Confirmation</button>
                    </form>
                    <p class="forgot"><a href="login.php">Back to Login</a></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
