<?php

$title = "Reports";
$basePath = '../';
$activePage = 'reports';
include('../includes/seller-header.php');

$inventoryReport = [
    ['name' => 'AEM X-Series Wideband UEGO Gauge Kit', 'sku' => 'AEM-UEGO-001', 'category' => 'Gauges',       'remaining' => 34, 'reorder' => 10, 'status' => 'Healthy'],
    ['name' => 'Eibach Pro-Kit Lowering Springs',      'sku' => 'EIB-PRO-014',  'category' => 'Suspension',   'remaining' => 8,  'reorder' => 10, 'status' => 'Low Stock'],
    ['name' => 'Garrett G25-550 Turbocharger',         'sku' => 'GAR-G25-550',  'category' => 'Turbochargers','remaining' => 0,  'reorder' => 5,  'status' => 'Out of Stock'],
    ['name' => 'APR GTC-300 Adjustable Rear Wing',     'sku' => 'APR-GTC-300',  'category' => 'Aerodynamics', 'remaining' => 15, 'reorder' => 5,  'status' => 'Healthy'],
    ['name' => 'HKS Hi-Power Exhaust',                 'sku' => 'HKS-HPX-220',  'category' => 'Exhausts',     'remaining' => 5,  'reorder' => 8,  'status' => 'Low Stock'],
    ['name' => 'Tein Flex Z Coilover Suspension Kit',  'sku' => 'TEIN-FLXZ-09', 'category' => 'Suspension',   'remaining' => 42, 'reorder' => 10, 'status' => 'Healthy'],
];

$auditLog = [
    ['time' => 'Jul 15, 2026 - 10:42 AM', 'user' => 'Jade Carlos Castillo', 'action' => 'Updated Price',      'module' => 'Inventory',   'details' => 'Brembo GT Systems 4 Piston BBK: ₱78,500.00 -> ₱80,632.42'],
    ['time' => 'Jul 15, 2026 - 9:15 AM',  'user' => 'James Ivan Frondarina','action' => 'Added Product',      'module' => 'Inventory',   'details' => 'Created Akrapovic Slip-On Exhaust'],
    ['time' => 'Jul 14, 2026 - 4:03 PM',  'user' => 'Gene Andrei Manacop',  'action' => 'Deactivated Admin',  'module' => 'User Mgmt.',  'details' => 'Removed panel access for Carla Reyes'],
    ['time' => 'Jul 14, 2026 - 1:27 PM',  'user' => 'Jade Carlos Castillo', 'action' => 'Restocked Item',     'module' => 'Inventory',   'details' => 'Tein Flex Z Coilover Kit: +20 units'],
    ['time' => 'Jul 13, 2026 - 11:50 AM', 'user' => 'Cedrick Nicolas Valera','action' => 'Logged In',         'module' => 'Auth',        'details' => 'Signed in to the seller panel'],
    ['time' => 'Jul 12, 2026 - 3:18 PM',  'user' => 'Jade Carlos Castillo', 'action' => 'Added Admin',        'module' => 'User Mgmt.',  'details' => 'Created account for Carla Reyes (Support Staff)'],
];
?>

<div class="admin-panel">
    <div class="admin-panel-header">
        <div>
            <h2>Inventory Report</h2>
            <p class="panel-sub">Remaining items per product against their reorder level</p>
        </div>
        <a href="#" class="btn-outline-pill">Export CSV</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Remaining</th>
                    <th>Reorder Level</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventoryReport as $item): ?>
                    <tr>
                        <td class="cell-main"><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['sku']); ?></td>
                        <td><?php echo htmlspecialchars($item['category']); ?></td>
                        <td><?php echo htmlspecialchars($item['remaining']); ?></td>
                        <td><?php echo htmlspecialchars($item['reorder']); ?></td>
                        <td>
                            <?php
                                $badgeClass = 'badge-success';
                                if ($item['status'] === 'Low Stock') $badgeClass = 'badge-warning';
                                if ($item['status'] === 'Out of Stock') $badgeClass = 'badge-danger';
                            ?>
                            <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($item['status']); ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <div>
            <h2>Audit Log Report</h2>
            <p class="panel-sub">All recorded activity for the account currently logged in</p>
        </div>
        <a href="#" class="btn-outline-pill">Export CSV</a>
    </div>

    <div class="filter-bar">
        <div class="group-input">
            <label class="form-label">From</label>
            <input type="date" class="form-control">
        </div>
        <div class="group-input">
            <label class="form-label">To</label>
            <input type="date" class="form-control">
        </div>
        <div class="group-input">
            <label class="form-label">Module</label>
            <select class="form-select">
                <option value="">All Modules</option>
                <option>Inventory</option>
                <option>User Mgmt.</option>
                <option>Auth</option>
            </select>
        </div>
        <button type="button" class="btn-dark-pill">Filter</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auditLog as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['time']); ?></td>
                        <td><?php echo htmlspecialchars($log['user']); ?></td>
                        <td><?php echo htmlspecialchars($log['action']); ?></td>
                        <td><span class="badge badge-info"><?php echo htmlspecialchars($log['module']); ?></span></td>
                        <td><?php echo htmlspecialchars($log['details']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../includes/seller-footer.php'); ?>