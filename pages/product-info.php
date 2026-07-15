<?php 
session_start();

$title = "AEM X-Series Wideband UEGO Gauge Kit";
$basePath = '../';
$whiteHeader = true;
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
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>
