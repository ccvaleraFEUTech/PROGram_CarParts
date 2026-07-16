<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');

$title = 'Reports';
$basePath = '../';
$activePage = 'reports';
$inventoryReport = mysqli_query($connection, "SELECT products.*, categories.name AS category_name
    FROM products JOIN categories ON products.category_id = categories.id
    WHERE products.active = 1 ORDER BY products.stock ASC");

$module = isset($_GET['module']) ? clean_input($_GET['module']) : '';
$from = isset($_GET['from']) ? clean_input($_GET['from']) : '';
$to = isset($_GET['to']) ? clean_input($_GET['to']) : '';
$logWhere = 'WHERE 1 = 1';

if ($module !== '') {
    $safeModule = mysqli_real_escape_string($connection, $module);
    $logWhere .= " AND audit_logs.module = '$safeModule'";
}
if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $from)) {
    $logWhere .= " AND DATE(audit_logs.created_at) >= '$from'";
}
if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $to)) {
    $logWhere .= " AND DATE(audit_logs.created_at) <= '$to'";
}

$auditLog = mysqli_query($connection, "SELECT audit_logs.*, users.first_name, users.last_name
    FROM audit_logs LEFT JOIN users ON audit_logs.user_id = users.id
    $logWhere ORDER BY audit_logs.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="../assets/css/admin.css"><title><?php echo $title; ?> || PROGram Seller</title></head>
<body class="admin-body">
    <?php include '../includes/seller-header.php'; ?>
    <main>
        <?php display_message(); ?>
        <div class="admin-panel">
            <div class="admin-panel-header"><div><h2>Inventory Report</h2><p class="panel-sub">Remaining items compared with their reorder level</p></div><a href="export.php?type=inventory" class="btn-outline-pill">Export CSV</a></div>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Product</th><th>SKU</th><th>Category</th><th>Remaining</th><th>Reorder Level</th><th>Status</th></tr></thead><tbody>
                <?php while ($item = mysqli_fetch_assoc($inventoryReport)): ?>
                    <?php $status = product_stock_status($item['stock'], $item['reorder_level']); ?>
                    <tr><td class="cell-main"><?php echo htmlspecialchars($item['name']); ?></td><td><?php echo htmlspecialchars($item['sku']); ?></td><td><?php echo htmlspecialchars($item['category_name']); ?></td><td><?php echo $item['stock']; ?></td><td><?php echo $item['reorder_level']; ?></td><td><span class="badge <?php echo $status === 'In Stock' ? 'badge-success' : ($status === 'Low Stock' ? 'badge-warning' : 'badge-danger'); ?>"><?php echo $status; ?></span></td></tr>
                <?php endwhile; ?>
            </tbody></table></div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header"><div><h2>Audit Log Report</h2><p class="panel-sub">Recorded seller and customer activity</p></div><a href="export.php?type=audit" class="btn-outline-pill">Export CSV</a></div>
            <form action="reports.php" method="get" class="filter-bar">
                <div class="group-input"><label class="form-label">From</label><input type="date" name="from" value="<?php echo htmlspecialchars($from); ?>" class="form-control"></div>
                <div class="group-input"><label class="form-label">To</label><input type="date" name="to" value="<?php echo htmlspecialchars($to); ?>" class="form-control"></div>
                <div class="group-input"><label class="form-label">Module</label><select name="module" class="form-select"><option value="">All Modules</option><option value="Auth">Auth</option><option value="Inventory">Inventory</option><option value="Orders">Orders</option><option value="User Management">User Management</option></select></div>
                <button type="submit" class="btn-dark-pill">Filter</button>
            </form>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Date & Time</th><th>User</th><th>Action</th><th>Module</th><th>Details</th></tr></thead><tbody>
                <?php while ($log = mysqli_fetch_assoc($auditLog)): ?><tr><td><?php echo date('M d, Y - h:i A', strtotime($log['created_at'])); ?></td><td><?php echo htmlspecialchars(trim($log['first_name'] . ' ' . $log['last_name'])); ?></td><td><?php echo htmlspecialchars($log['action']); ?></td><td><span class="badge badge-info"><?php echo htmlspecialchars($log['module']); ?></span></td><td><?php echo htmlspecialchars($log['details']); ?></td></tr><?php endwhile; ?>
            </tbody></table></div>
        </div>
    </main>
    <?php include '../includes/seller-footer.php'; ?>
</body>
</html>
