<?php 
$isLogged = isset($_SESSION['user_id']);
?>

<header class="webhead <?php 
    if ((isset($title) && ($title == 'Products' || $title == 'Contacts')) || (isset($whiteHeader) && $whiteHeader)) { 
        echo 'products-header'; 
    } ?>">
    <div class="logo">
        <a href="<?php echo $basePath; ?>index.php"><img src="<?php echo $basePath; ?>assets/images/logo.png" alt="logo"></a>
    </div>
    <button type="button" id="ham-toggle" class="ham-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="main-menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <nav id="main-menu">
        <ul class="navigation">
            <li><a href="<?php echo $basePath; ?>index.php">Home</a></li>
            <li><a href="<?php echo $basePath; ?>pages/about.php">About</a></li>
            <li><a href="<?php echo $basePath; ?>pages/products.php">Products</a></li>
            <li><a href="<?php echo $basePath; ?>pages/contact.php">Contacts</a></li>
            <li><a href="<?php echo $basePath; ?>pages/cart.php">Cart</a></li>
        </ul>

        <div class="auth-group">
            <?php if ($isLogged): ?>
                <a href="<?php echo $basePath; ?>pages/profile.php" class="auth-btn"><button class="authentication">Profile</button></a>
                <a href="<?php echo $basePath; ?>pages/orders.php" class="auth-btn"><button class="authentication">Orders</button></a>
                <a href="<?php echo $basePath; ?>actions/logout.php" class="auth-btn"><button class="authentication">Logout</button></a>
            <?php else: ?>
                <a href="<?php echo $basePath; ?>login.php" class="auth-btn"><button class="authentication">Login</button></a>
                <a href="<?php echo $basePath; ?>register.php" class="auth-btn"><button class="authentication">Register</button></a>
            <?php endif; ?>
        </div>
    </nav>
</header>
