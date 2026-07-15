<?php

$title = "AEM X-Series Wideband UEGO Gauge Kit";
$basePath = '../';
$whiteHeader = true;
$basePath = '../';
include('../includes/header.php');
?>


<section class="info-product-section">
    <div class="info-product-container">
        <img src="../assets/images/products/aem-x-series-uego.jpg" alt="product">

        <div class="product-details">
            <p class="breadcrumb"><a href="products.php">> &nbsp;Gauges</a></p>
            <h1>AEM X-Series Wideband UEGO Gauge Kit</h1>
            <h2 class="price">₱50,130.60</h2>
            <p class="description">The AEM X-Series Wideband UEGO AFR Sensor Controller Gauge employs the innovative and in patent-pending X-Digital technology. As per independent tests, this gauge happens to be the fastest responding wideband AFR controller.</p>

            <form action="#" method="post">
                <div class="quantity">
                    <span class="quantity-label">Quantity</span>
                    <div class="quantity-plus-minus">
                        <button type="button" class="quantity-btn" onclick="this.nextElementSibling.stepDown()">-</button>
                        <input type="number" value="1" min="1" name="quantity" class="quantity-value">
                        <button type="button" class="quantity-btn" onclick="this.nextElementSibling.stepUp()">+</button>
                    </div>
                </div>
                <button type="submit" class="add-to-cart-btn">Add To Cart</button>
            </form>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>