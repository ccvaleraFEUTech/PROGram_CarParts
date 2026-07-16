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
                            <h3><?php echo htmlspecialchars($order['order_number']); ?> <span class="tag"><?php echo htmlspecialchars($order['status']); ?></span></h3>
                            <p><?php echo date('F d, Y h:i A', strtotime($order['created_at'])); ?> &middot; <?php echo htmlspecialchars($order['payment_method']); ?></p>
                            <p><?php echo htmlspecialchars($order['delivery_address']); ?></p>
                            <ul>
                                <?php
                                $orderId = (int) $order['id'];
                                $items = mysqli_query($connection, "SELECT * FROM order_items WHERE order_id = $orderId");
                                while ($item = mysqli_fetch_assoc($items)):
                                ?>
                                    <li><?php echo htmlspecialchars($item['product_name']); ?> x<?php echo $item['quantity']; ?> - &#8369;<?php echo number_format($item['subtotal'], 2); ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <strong>Total: &#8369;<?php echo number_format($order['total_amount'], 2); ?></strong>
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
