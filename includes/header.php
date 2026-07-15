<?php 
session_start();

$isLogged = isset($_SESSION['user_id']);

if (!isset($title)){
    $title = "Header";
}

if (!isset($basePath)){
    $basePath = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
     <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <title><?php echo $title?> || PROGram</title>
</head>
<body class="<?php echo (isset($hideHeader) && $hideHeader) ? 'auth-body' : ''; ?>">
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
    <header class="webhead <?php 
        if ((isset($title) && ($title == 'Products' || $title == 'Contacts')) || (isset($whiteHeader) && $whiteHeader)) { 
            echo 'products-header'; 
        } 
        ?>">
        <div class="logo">
            <a href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
        </div>
        <button type="button" id="ham-toggle" class="ham-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="main-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav id="main-menu">
            <ul class="navigation">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../pages/products.php">Products</a></li>
                <li><a href="../pages/contact.php">Contacts</a></li>
                <li><a href="../pages/cart.php">Cart</a></li>
            </ul>

            <div class="auth-group">
                <?php if ($isLogged): ?>
                   <a href="#" class="auth-btn"><button class="authentication">Logout</button></a>
                <?php else: ?>
                    <a href="login.php" class="auth-btn"><button class="authentication">Login</button></a>
                    <a href="register.php" class="auth-btn"><button class="authentication">Register</button></a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <?php endif; ?>
