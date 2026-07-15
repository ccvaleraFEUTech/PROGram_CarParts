<?php 

$title = "Home";
include 'includes/header.php';
?>

<section class="banner">
    <div class="container">
        <h1>Welcome to PROGram</h1>
        <p>Where high quality cars go pro mode.</p>
        <a href="<?php echo $basePath; ?>pages/products.php" class="brand">Shop Now</a>
    </div>
</section>

<section class="container">
    <h2>Featured Products</h2>
    <div class="row">
        <div class="col">
            <div class="product-card" style="background-image: url('assets/images/index/hks-hi-power.jpg')">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="card-body">
                    <h5 class="card-title">HKS Hi-Power Exhaust</h5>
                    <p class="price">₱130,267.94</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card" style="background-image: url('assets/images/index/tein-flex-z.jpg')">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="card-body">
                    <h5 class="card-title">Tein Flex Z Coilover Suspension Kit</h5>
                    <p class="price">₱50,130.60</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card" style="background-image: url('assets/images/index/brembo-4-piston.jpg')">
                <button class="add-cart-btn" title="Add to Cart">+</button>
                <div class="card-body">
                    <h5 class="card-title">Brembo GT Systems 4 Piston Front Big Brake Kit Red Sl</h5>
                    <p class="price">₱80,632.42</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why">
    <h2>Why Choose Us</h2>
    <div class="row">
        <div class="col">
            <h5>Genuine Parts</h5>
            <p>We sell car parts with high quality ease, in which each are built and sold with the highest quality of transmissions, acceleration boosts, etc.</p>
        </div>
        <div class="col">
            <h5>Faster Delivery</h5>
            <p>Delivery is as fast as possible for the nearest and farthest customer that they need delivering. We also protect the merchandise upon its lifespan.</p>
        </div>
        <div class="col">
            <h5>Service for Customers</h5>
            <p>Providing better customer service when it comes to quality of service and more keeps them engaged and updated without ever losing one communication with the customers.</p>
        </div>
    </div>
</section>

<section class="partners">
    <h3>Our Car Parts Partnerships</h3>
    <table>
        <tr>
            <td><img src="assets/images/index/car-parts-logos/aem.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/akrapovic.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/apr.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/bilstein.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/borla.png" alt="carbrand"></td>
        </tr>
        <tr>
            <td><img src="assets/images/index/car-parts-logos/brembo.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/cobb.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/eibach.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/garrett.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/hks.png" alt="carbrand"></td>
        </tr>
        <tr>
            <td><img src="assets/images/index/car-parts-logos/kws.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/mishimoto.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/ohlins.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/tein.png" alt="carbrand"></td>
            <td><img src="assets/images/index/car-parts-logos/tomei.png" alt="carbrand"></td>
        </tr>
    </table>
</section>

<?php include 'includes/footer.php'?>