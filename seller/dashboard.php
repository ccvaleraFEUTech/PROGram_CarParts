<?php 
session_start();

$title = "Dashboard";
$basePath = '../';
$activePage = 'dashboard';

$stats = [
    ['label' => 'Total Products',  'value' => '128',  'note' => '4 added this week'],
    ['label' => 'Low Stock Items', 'value' => '6',    'note' => 'Below reorder level'],
    ['label' => 'Admin Users',     'value' => '5',    'note' => '1 pending activation'],
    ['label' => "Today's Activity",'value' => '23',   'note' => 'Actions logged today'],
];

$recentActivity = [
    ['time' => 'Today, 10:42 AM', 'user' => 'Jade Castillo',   'action' => 'Updated price',     'details' => 'Brembo GT Systems 4 Piston BBK'],
    ['time' => 'Today, 9:15 AM',  'user' => 'James Frondarina','action' => 'Added new product', 'details' => 'Akrapovic Slip-On Exhaust'],
    ['time' => 'Yesterday, 4:03 PM', 'user' => 'Gene Manacop', 'action' => 'Deactivated admin',  'details' => 'Removed access for C. Reyes'],
    ['time' => 'Yesterday, 1:27 PM', 'user' => 'Jade Castillo','action' => 'Restocked item',     'details' => 'Tein Flex Z Coilover Kit (+20 units)'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/admin.css">
    <title><?php echo $title ?> || PROGram Seller</title>
</head>
<body class="admin-body">
    <?php include '../includes/seller-header.php'; ?>

    <main>
        <div class="stat-grid">
            <?php foreach ($stats as $stat): ?>
                <div class="stat-card">
                    <h3><?php echo htmlspecialchars($stat['label']); ?></h3>
                    <p class="stat-value"><?php echo htmlspecialchars($stat['value']); ?></p>
                    <p class="stat-note"><?php echo htmlspecialchars($stat['note']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="quick-actions">
            <a href="users.php" class="quick-action-card">
                <h4>Manage Admin Users</h4>
                <p>Add, edit, or deactivate accounts that can access the seller panel.</p>
            </a>
            <a href="inventory.php" class="quick-action-card">
                <h4>Inventory & Pricing</h4>
                <p>Add new stock, update quantities, and change product prices.</p>
            </a>
            <a href="reports.php" class="quick-action-card">
                <h4>Reports</h4>
                <p>Check remaining inventory and review the system audit log.</p>
            </a>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <div>
                    <h2>Recent Activity</h2>
                    <p class="panel-sub">A quick look at the latest actions across the system</p>
                </div>
                <a href="reports.php" class="btn-outline-pill">View Full Audit Log</a>
            </div>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentActivity as $log): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['time']); ?></td>
                                <td><?php echo htmlspecialchars($log['user']); ?></td>
                                <td><?php echo htmlspecialchars($log['action']); ?></td>
                                <td><?php echo htmlspecialchars($log['details']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../includes/seller-footer.php'; ?>
</body>
</html>
