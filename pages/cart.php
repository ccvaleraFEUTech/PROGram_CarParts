<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

$title = "Your Cart";
$basePath = '../';
$whiteHeader = true;
$isLogged = isset($_SESSION['user_id']);

$cartProducts = get_cart_products($connection);
$total = get_cart_total($cartProducts);
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
        <section class="add-to-cart-section">
            <div class="add-to-cart-container">
                <h1>Your Cart</h1>
                <?php if (count($cartProducts) === 0): ?>
                    <div class="empty-cart">
                        <p>Your cart is empty.</p>
                        <a href="products.php" class="btn-outline-pill">Browse Products</a>
                    </div>
                <?php else: ?>
                <form action="../actions/cart_action.php" method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr></thead>
                            <tbody>
                            <?php foreach ($cartProducts as $product): ?>
                                <tr>
                                    <td><img src="../<?php echo htmlspecialchars($product['image']); ?>" width="60" alt="product"> <?php echo htmlspecialchars($product['name']); ?></td>
                                    <td>&#8369;<?php echo number_format($product['price'], 2); ?></td>
                                    <td><input type="number" name="quantity[<?php echo $product['id']; ?>]" class="form-control" value="<?php echo $product['quantity']; ?>" min="1" max="<?php echo $product['stock']; ?>" style="width:80px"></td>
                                    <td>&#8369;<?php echo number_format($product['subtotal'], 2); ?></td>
                                    <td><button type="submit" name="remove_id" value="<?php echo $product['id']; ?>" class="remove-cart-order">Remove</button></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot><tr class="cart-total-row"><td colspan="3" class="text-end">Total:</td><td colspan="2">&#8369;<?php echo number_format($total, 2); ?></td></tr></tfoot>
                        </table>
                    </div>
                    <button type="submit" class="btn-outline-pill">Update Cart</button>
                </form>
                <div class="text-end"><a href="checkout.php" class="checkout-btn">Proceed to Checkout</a></div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script src="<?php echo $basePath; ?>js/checkout.js"></script>
</body>
</html>
