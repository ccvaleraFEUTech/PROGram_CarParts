<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_login('../login.php');

$title = 'My Orders';
$basePath = '../';
$whiteHeader = true;
$userId = (int) $_SESSION['user_id'];
$orders = mysqli_query($connection, "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo $basePath; ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN -->
    <main>
        <section class="profile-section">
            <div class="profile-container">
                <?php display_message(); ?>
                <div class="profile-card">
                    <h1>My Orders</h1>
                    <?php if (mysqli_num_rows($orders) === 0): ?><p>You have no orders yet.</p><?php endif; ?>
                    <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                        <div class="order-card">
                            <div class="order-card-header">
                                <div class="order-number"><?php echo htmlspecialchars($order['order_number']); ?></div>
                                <div class="order-status status-<?php echo strtolower(str_replace(' ', '-', $order['status'])); ?>"><?php echo htmlspecialchars($order['status']); ?></div>
                            </div>
                            <div class="order-card-body">
                                <div class="order-info">
                                    <div class="info-row">
                                        <span class="info-label">Date:</span>
                                        <span class="info-value"><?php echo date('F d, Y h:i A', strtotime($order['created_at'])); ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Payment:</span>
                                        <span class="info-value"><?php echo htmlspecialchars($order['payment_method']); ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Address:</span>
                                        <span class="info-value"><?php echo htmlspecialchars($order['delivery_address']); ?></span>
                                    </div>
                                </div>
                                <div class="order-items-section">
                                    <h4 class="items-title">Items</h4>
                                    <ul class="order-items">
                                        <?php
                                        $orderId = (int) $order['id'];
                                        $items = mysqli_query($connection, "SELECT * FROM order_items WHERE order_id = $orderId");
                                        while ($item = mysqli_fetch_assoc($items)):
                                        ?>
                                            <li class="order-item">
                                                <span class="item-name"><?php echo htmlspecialchars($item['product_name']); ?> x<?php echo $item['quantity']; ?></span>
                                                <span class="item-price">&#8369;<?php echo number_format($item['subtotal'], 2); ?></span>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="order-card-footer">
                                <div class="order-total">
                                    <span class="total-label">Total:</span>
                                    <span class="total-amount">&#8369;<?php echo number_format($order['total_amount'], 2); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php'; ?>

    <!-- JS -->
    <script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>
