<?php 
session_start();
require_once 'includes/database.php';
require_once 'includes/functions.php';

$title = "Home";
$basePath = '';
$isLogged = isset($_SESSION['user_id']);
$featuredProducts = mysqli_query($connection, "SELECT * FROM products WHERE active = 1 ORDER BY id DESC LIMIT 3");
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
        <?php include 'includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <?php display_message(); ?>
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
                <?php while ($product = mysqli_fetch_assoc($featuredProducts)): ?>
                    <div class="col">
                        <div class="product-card" style="background-image: url('<?php echo htmlspecialchars($product['image']); ?>')">
                            <?php if ($product['stock'] > 0): ?>
                                <form action="actions/cart_action.php" method="post">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-cart-btn" title="Add to Cart">+</button>
                                </form>
                            <?php endif; ?>
                            <a href="pages/product-info.php?id=<?php echo $product['id']; ?>" class="product-card-link">
                                <div class="product-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="price">&#8369;<?php echo number_format($product['price'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
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
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include 'includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>
