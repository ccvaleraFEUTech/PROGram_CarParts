<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = (int) $_POST['order_id'];
    $status = clean_input($_POST['status']);
    $allowedStatuses = array('Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled');

    if (in_array($status, $allowedStatuses)) {
        $status = mysqli_real_escape_string($connection, $status);
        mysqli_query($connection, "UPDATE orders SET status = '$status' WHERE id = $orderId");
        add_audit_log($connection, 'Updated Order', 'Orders', 'Set order ID ' . $orderId . ' to ' . $status);
        set_message('Order status updated.');
    } else {
        set_message('Invalid order status.', 'error');
    }

    redirect_to('orders.php');
}

$title = 'Orders';
$basePath = '../';
$activePage = 'orders';
$orders = mysqli_query($connection, "SELECT orders.*, users.email FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/admin.css">
    <title><?php echo $title; ?> || PROGram Seller</title>
</head>
<body class="admin-body">
    <?php include '../includes/seller-header.php'; ?>
    <main>
        <?php display_message(); ?>
        <div class="admin-panel">
            <div class="admin-panel-header"><div><h2>Customer Orders</h2><p class="panel-sub">Review orders and update delivery status</p></div></div>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Order</th><th>Customer</th><th>Delivery</th><th>Payment</th><th>Total</th><th>Status</th></tr></thead><tbody>
                <?php if (mysqli_num_rows($orders) === 0): ?><tr><td colspan="6">No orders have been placed.</td></tr><?php endif; ?>
                <?php while ($order = mysqli_fetch_assoc($orders)): ?><tr>
                    <td class="cell-main"><?php echo htmlspecialchars($order['order_number']); ?><span class="cell-sub"><?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?></span></td>
                    <td><?php echo htmlspecialchars($order['full_name']); ?><span class="cell-sub"><?php echo htmlspecialchars($order['email']); ?></span></td>
                    <td><?php echo htmlspecialchars($order['delivery_address']); ?><span class="cell-sub"><?php echo htmlspecialchars($order['contact_number']); ?></span></td>
                    <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                    <td>&#8369;<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td><form action="orders.php" method="post" class="inline-admin-form"><input type="hidden" name="order_id" value="<?php echo $order['id']; ?>"><select name="status" class="form-select"><option <?php echo $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option><option <?php echo $order['status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option><option <?php echo $order['status'] === 'Shipped' ? 'selected' : ''; ?>>Shipped</option><option <?php echo $order['status'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option><option <?php echo $order['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option></select><button type="submit" class="action-btn edit">Save</button></form></td>
                </tr><?php endwhile; ?>
            </tbody></table></div>
        </div>
    </main>
    <?php include '../includes/seller-footer.php'; ?>
</body>
</html>
