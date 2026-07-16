<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

$title = "AEM X-Series Wideband UEGO Gauge Kit";
$basePath = '../';
$whiteHeader = true;
$isLogged = isset($_SESSION['user_id']);
$productId = isset($_GET['id']) ? (int) $_GET['id'] : 1;
$result = mysqli_query($connection, "SELECT products.*, categories.name AS category_name
    FROM products JOIN categories ON products.category_id = categories.id
    WHERE products.id = $productId AND products.active = 1");

if (mysqli_num_rows($result) !== 1) {
    set_message('Product was not found.', 'error');
    redirect_to('products.php');
}

$product = mysqli_fetch_assoc($result);
$title = $product['name'];
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
        <?php display_message(); ?>
        <section class="info-product-section">
            <div class="info-product-container">
                <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="product-details">
                    <p class="breadcrumb"><a href="products.php?category=<?php echo $product['category_id']; ?>">&gt; &nbsp;<?php echo htmlspecialchars($product['category_name']); ?></a></p>
                    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                    <h2 class="price">&#8369;<?php echo number_format($product['price'], 2); ?></h2>
                    <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Available stock:</strong> <?php echo $product['stock']; ?></p>
                    <?php if ($product['stock'] > 0): ?>
                        <form action="../actions/cart_action.php" method="post">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <div class="quantity">
                                <span class="quantity-label">Quantity</span>
                                <div class="quantity-plus-minus">
                                    <button type="button" class="quantity-btn" onclick="this.nextElementSibling.stepDown()">-</button>
                                    <input type="number" value="1" min="1" max="<?php echo $product['stock']; ?>" name="quantity" class="quantity-value">
                                    <button type="button" class="quantity-btn" onclick="this.previousElementSibling.stepUp()">+</button>
                                </div>
                            </div>
                            <button type="submit" class="add-to-cart-btn">Add To Cart</button>
                        </form>
                    <?php else: ?>
                        <p class="site-message error">This product is out of stock.</p>
                    <?php endif; ?>
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
