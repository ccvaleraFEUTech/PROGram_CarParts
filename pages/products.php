<?php 
session_start();

$title = "Products";
$basePath = '../';
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
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include '../includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <section class="products">
            <h2 class="products-title">Our Products</h2>
            <div class="products-container">
                <aside class="products-sidebar">
                    <h2>Product Categories</h2>
                    <ul class="category">
                        <li><a href="#">All</a></li>
                        <li><a href="#">Engines</a></li>
                        <li><a href="#">Brakes</a></li>
                        <li><a href="#">Tires/Wheels</a></li>
                        <li><a href="#">Accessories/Boosts</a></li>
                        <li><a href="#">Transmissions</a></li>
                        <li><a href="#">Engine Pipes</a></li>
                        <li><a href="#">Exhausts</a></li>
                        <li><a href="#">Covers/Paints</a></li>
                        <li><a href="#">Turbochargers</a></li>
                        <li><a href="#">Gauges</a></li>
                        <li><a href="#">Suspension Springs</a></li>
                        <li><a href="#">Aerodynamics</a></li>
                        <li><a href="#">Radio/Computers</a></li>
                    </ul>
                </aside>
            
                <div class="products-right">
                    <input type="text" name="search" placeholder="Search for products" class="search">
                    <div class="grid">
                        <a href="<?php echo $basePath; ?>pages/product-info.php" class="product-link">
                            <div class="product-card" style="background-image: url('../assets/images/products/aem-x-series-uego.jpg');">
                                <button class="add-cart-btn" title="Add to Cart">+</button>
                                <div class="product-body">
                                    <h4 class="card-title">AEM X-Series Wideband UEGO Gauge Kit</h4>
                                    <p class="product-price">₱86,671.10</p>
                                </div>
                            </div>
                        </a>
                        <div class="product-card" style="background-image: url('../assets/images/products/eibach-pro-kit.jpg');">
                            <button class="add-cart-btn" title="Add to Cart">+</button>
                            <div class="product-body">
                                <h4 class="card-title">Eibach Pro-Kit Lowering Springs</h4>
                                <p class="product-price">₱12,623.56</p>
                            </div>
                        </div>

                        <div class="product-card" style="background-image: url('../assets/images/products/garrett-g25.jpg');">
                            <button class="add-cart-btn" title="Add to Cart">+</button>
                            <div class="product-body">
                                <h4 class="card-title">Garrett G25-550 Turbocharger</h4>
                                <p class="product-price">₱19,520.07</p>
                            </div>
                        </div>

                        <div class="product-card" style="background-image: url('../assets/images/products/gtc-300.png');">
                            <button class="add-cart-btn" title="Add to Cart">+</button>
                            <div class="product-body">
                                <h4 class="card-title">APR GTC-300 Adjustable Rear Wing</h4>
                                <p class="product-price">₱91,835.29</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script src="<?php echo $basePath; ?>js/location.js"></script>
    <script src="<?php echo $basePath; ?>js/products.js"></script>
</body>
</html>
