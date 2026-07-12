<?php
// index.php — Home page
$pageTitle = "Home";
include 'includes/header.php';
?>

<!-- ==========================================================
     HERO / BANNER SECTION
     See assets/css/style.css -> SECTION: HERO for design options
     ========================================================== -->
<section class="hero">
    <div class="container text-center">
        <h1>Welcome to PK Auto Parts</h1>
        <p>Quality car parts you can trust.</p>
        <a href="products.php" class="btn btn-brand btn-lg">Shop Now</a>
    </div>
</section>

<!-- ==========================================================
     FEATURED / BEST-SELLING PRODUCTS
     Reuses the same .product-card style as products.php so the
     look stays consistent across pages.
     ========================================================== -->
<section class="container my-5">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row g-4">

        <!-- Repeat this .col block for each featured product.
             Later, a PHP loop (foreach) will generate these from the
             database instead of hardcoding them one by one. -->
        <div class="col-md-4">
            <div class="card product-card h-100">
                <img src="assets/images/1.jpg" class="card-img-top" alt="Product name">
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="product-price">₱0.00</p>
                    <button class="btn btn-brand w-100">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card product-card h-100">
                <img src="assets/images/2.jpg" class="card-img-top" alt="Product name">
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="product-price">₱0.00</p>
                    <button class="btn btn-brand w-100">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card product-card h-100">
                <img src="assets/images/3.jpg" class="card-img-top" alt="Product name">
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="product-price">₱0.00</p>
                    <button class="btn btn-brand w-100">Add to Cart</button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==========================================================
     WHY CHOOSE US / ABOUT TEASER
     OPTION A: 3 icon+text columns (delivery, warranty, support)
     OPTION B: short paragraph + "Learn More" link to about.php
     ========================================================== -->
<section class="container my-5 text-center">
    <h2>Why Choose Us</h2>
    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <h5>Genuine Parts</h5>
            <p>Placeholder text.</p>
        </div>
        <div class="col-md-4">
            <h5>Fast Delivery</h5>
            <p>Placeholder text.</p>
        </div>
        <div class="col-md-4">
            <h5>Customer Support</h5>
            <p>Placeholder text.</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
