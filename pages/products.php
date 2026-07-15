<?php

$title = "Products";
include('../includes/header.php');
?>

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
            <a href="../pages/product-info.php" class="product-link">
                <div class="card-product" style="background-image: url('../assets/images/products/aem-x-series-uego.jpg');">
                    <button class="add-cart-btn" title="Add to Cart">+</button>
                    <div class="product-body">
                        <h4 class="card-title">AEM X-Series Wideband UEGO Gauge Kit</h4>
                        <p class="product-price">₱86,671.10</p>
                    </div>
                </div>
            </a>
            <div class="card-product" style="background-image: url('../assets/images/products/eibach-pro-kit.jpg');">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="product-body">
                    <h4 class="card-title">Eibach Pro-Kit Lowering Springs</h4>
                    <p class="product-price">₱12,623.56</p>
                </div>
            </div>

            <div class="card-product" style="background-image: url('../assets/images/products/garrett-g25.jpg');">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="product-body">
                    <h4 class="card-title">Garrett G25-550 Turbocharger</h4>
                    <p class="product-price">₱19,520.07</p>
                </div>
            </div>

            <div class="card-product" style="background-image: url('../assets/images/products/gtc-300.png');">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="product-body">
                    <h4 class="card-title">APR GTC-300 Adjustable Rear Wing</h4>
                    <p class="product-price">₱91,835.29</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('../includes/footer.php'); ?>