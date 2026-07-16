<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');

$title = "Dashboard";
$basePath = '../';
$activePage = 'dashboard';

$productCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) AS total FROM products WHERE active = 1"));
$lowStockCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) AS total FROM products WHERE active = 1 AND stock <= reorder_level"));
$adminCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) AS total FROM users WHERE role != 'Customer'"));
$todayCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) AS total FROM audit_logs WHERE DATE(created_at) = CURDATE()"));
$stats = array(
    array('label' => 'Total Products', 'value' => $productCount['total'], 'note' => 'Active catalog items'),
    array('label' => 'Low Stock Items', 'value' => $lowStockCount['total'], 'note' => 'At or below reorder level'),
    array('label' => 'Admin Users', 'value' => $adminCount['total'], 'note' => 'Seller panel accounts'),
    array('label' => "Today's Activity", 'value' => $todayCount['total'], 'note' => 'Actions logged today')
);
$recentActivity = mysqli_query($connection, "SELECT audit_logs.*, users.first_name, users.last_name FROM audit_logs LEFT JOIN users ON audit_logs.user_id = users.id ORDER BY audit_logs.created_at DESC LIMIT 8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $basePath; ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= $basePath; ?>assets/css/admin.css">
    <title><?= $title ?> || PROGram Seller</title>
</head>
<body class="admin-body">
    <?php include '../includes/seller-header.php'; ?>
    <main>
        <?php display_message(); ?>
        <div class="stat-grid">
            <?php foreach ($stats as $stat): ?><div class="stat-card"><h3><?php echo htmlspecialchars($stat['label']); ?></h3><p class="stat-value"><?php echo $stat['value']; ?></p><p class="stat-note"><?php echo htmlspecialchars($stat['note']); ?></p></div><?php endforeach; ?>
        </div>
        <div class="quick-actions">
            <?php if ($_SESSION['user_role'] === 'Super Admin'): ?><a href="users.php" class="quick-action-card"><h4>Manage Admin Users</h4><p>Add, edit, or deactivate seller accounts.</p></a><?php endif; ?>
            <a href="inventory.php" class="quick-action-card"><h4>Inventory & Pricing</h4><p>Add products and update quantities or prices.</p></a>
            <a href="orders.php" class="quick-action-card"><h4>Orders</h4><p>Review orders and update their status.</p></a>
            <a href="reports.php" class="quick-action-card"><h4>Reports</h4><p>Check inventory and the audit log.</p></a>
        </div>
        <div class="admin-panel"><div class="admin-panel-header"><div><h2>Recent Activity</h2><p class="panel-sub">Latest actions recorded in the database</p></div><a href="reports.php" class="btn-outline-pill">View Full Audit Log</a></div>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Date & Time</th><th>User</th><th>Action</th><th>Details</th></tr></thead><tbody>
                <?php while ($log = mysqli_fetch_assoc($recentActivity)): ?><tr><td><?php echo date('M j, Y - g:i A', strtotime($log['created_at'])); ?></td><td><?php echo htmlspecialchars(trim($log['first_name'] . ' ' . $log['last_name'])); ?></td><td><?php echo htmlspecialchars($log['action']); ?></td><td><?php echo htmlspecialchars($log['details']); ?></td></tr><?php endwhile; ?>
            </tbody></table></div>
        </div>
    </main>
    
    <?php include $basePath . 'includes/seller-footer.php'; ?>
</body>
</html>
