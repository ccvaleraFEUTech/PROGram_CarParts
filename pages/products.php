<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

$title = "Products";
$basePath = '../';
$isLogged = isset($_SESSION['user_id']);

$search = isset($_GET['search']) ? clean_input($_GET['search']) : '';
$categoryId = isset($_GET['category']) ? (int) $_GET['category'] : 0;
$categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY name");

$where = 'WHERE products.active = 1';
if ($categoryId > 0) {
    $where .= " AND products.category_id = $categoryId";
}
if ($search !== '') {
    $safeSearch = mysqli_real_escape_string($connection, $search);
    $where .= " AND products.name LIKE '%$safeSearch%'";
}

$products = mysqli_query($connection, "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id $where ORDER BY products.name");
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
        <section class="products">
            <h2 class="products-title">Our Products</h2>
            <div class="products-container">
                <aside class="products-sidebar">
                    <h2>Product Categories</h2>
                    <ul class="category">
                        <li><a href="products.php">All</a></li>
                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                            <li><a href="products.php?category=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </aside>
            
                <div class="products-right">
                    <form action="products.php" method="get">
                        <input type="text" name="search" placeholder="Search for products" class="search">
                    </form>
                    <div class="grid">
                        <?php if (mysqli_num_rows($products) === 0): ?><p>No products matched your search.</p><?php endif; ?>
                        <?php while ($product = mysqli_fetch_assoc($products)): ?>
                            <div class="product-card" style="background-image: url('../<?php echo htmlspecialchars($product['image']); ?>');">
                                <?php if ($product['stock'] > 0): ?>
                                    <form action="../actions/cart_action.php" method="post">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-cart-btn" title="Add to Cart">+</button>
                                    </form>
                                <?php endif; ?>
                                <a href="product-info.php?id=<?php echo $product['id']; ?>" class="product-link">
                                    <div class="product-body">
                                        <h4 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h4>
                                        <p class="product-price">&#8369;<?php echo number_format($product['price'], 2); ?></p>
                                        <p class="stock-label"><?php echo product_stock_status($product['stock'], $product['reorder_level']); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script src="<?php echo $basePath; ?>js/products.js"></script>
</body>
</html>
