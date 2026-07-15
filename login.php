<?php 
$title = "Login";
$hideHeader = true;
$hideFooter = true;
include 'includes/header.php';
?>

<div class="auth-page">
    <a href="/PROGram/index.php" class="back">&larr;</a>
    <div class="card">
        <div class="auth-card-body">
            <h3>Login</h3>
            <form action="login/login_handler.php" method="post">
                <div class="field">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="field">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
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