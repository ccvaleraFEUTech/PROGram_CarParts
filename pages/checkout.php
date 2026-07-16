<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_login('../login.php');

$title = "Checkout";
$basePath = '../';
$whiteHeader = true;
$userId = (int) $_SESSION['user_id'];
$userResult = mysqli_query($connection, "SELECT * FROM users WHERE id = $userId");
$user = mysqli_fetch_assoc($userResult);
$addressResult = mysqli_query($connection, "SELECT * FROM addresses WHERE user_id = $userId ORDER BY is_default DESC, id ASC LIMIT 1");
$address = mysqli_fetch_assoc($addressResult);
$cartProducts = get_cart_products($connection);
$cartTotal = get_cart_total($cartProducts);

if (empty($cartProducts)) {
    set_message('Your cart is empty.', 'error');
    redirect_to('cart.php');
}
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
<body data-base-path="<?php echo $basePath; ?>">
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include '../includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <?php display_message(); ?>
        <section class="check-section">
            <div class="check-container">
                <h1 class="check-title">Checkout</h1>

                <div class="check-wrapper">
                    <div class="check-column left">
                        <h4>Delivery Information</h4>
                        <form action="../actions/checkout_handler.php" method="post" class="auth-form" style="max-width:100%;">
                            <div class="form-grid">
                                <div class="group-input">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars(user_full_name($user)); ?>" required>
                                </div>
                                <div class="group-input">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="contact-number" value="<?php echo htmlspecialchars($user['contact_number']); ?>" required>
                                </div>
                                <div class="group-input full-width">
                                    <label class="form-label">Street / House No.</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $address ? htmlspecialchars($address['street_address']) : ''; ?>" required>
                                </div>
                                <div class="group-input">
                                    <label class="form-label">Region</label>
                                    <select name="region" id="region" class="form-select" required></select>
                                </div>
                                <div class="group-input">
                                    <label class="form-label">Province</label>
                                    <select name="province" id="province" class="form-select" required></select>
                                </div>
                                <div class="group-input">
                                    <label class="form-label">City/Municipality</label>
                                    <select name="city" id="city" class="form-select" required></select>
                                </div>
                                <div class="group-input">
                                    <label class="form-label">Barangay</label>
                                    <select name="barangay" id="barangay" class="form-select" required></select>
                                </div>
                                <div class="payment">
                                    <label class="form-label">Payment Method</label>
                                    <div class="form-check">
                                        <input type="radio" name="payment" id="cod" value="Cash on Delivery" class="form-check-input" checked>
                                        <label for="cod" class="form-check-label">Cash on Delivery</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="payment" id="gcash" value="GCash" class="form-check-input">
                                        <label for="gcash" class="form-check-label">GCash</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="submit-btn">Place Order</button>
                        </form>
                    </div>

                    <div class="check-column right">
                        <div class="card-summary">
                            <div class="summary-body">
                                <h5 class="card-title">Order Summary</h5>
                                <ul class="summary-list">
                                    <?php foreach ($cartProducts as $product): ?>
                                        <li>
                                            <span><?php echo htmlspecialchars($product['name']); ?> x<?php echo $product['quantity']; ?></span>
                                            <span>&#8369;<?php echo number_format($product['subtotal'], 2); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <hr>
                                <div class="cart-total-row">
                                    <strong>Total</strong>
                                    <strong>&#8369;<?php echo number_format($cartTotal, 2); ?></strong>
                                </div>
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
</body>
</html>
