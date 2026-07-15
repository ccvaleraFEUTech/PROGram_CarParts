<?php

$title = "Admin Users";
$basePath = '../';
$activePage = 'users';
include('../includes/seller-header.php');

$adminUsers = [
    ['name' => 'Jade Carlos Castillo',    'email' => 'jade.castillo@program.com',    'role' => 'Super Admin',       'status' => 'Active',   'added' => 'Jan 12, 2026'],
    ['name' => 'James Ivan Frondarina',   'email' => 'james.frondarina@program.com', 'role' => 'Inventory Manager', 'status' => 'Active',   'added' => 'Jan 12, 2026'],
    ['name' => 'Gene Andrei Manacop',     'email' => 'gene.manacop@program.com',     'role' => 'Inventory Manager', 'status' => 'Active',   'added' => 'Feb 03, 2026'],
    ['name' => 'Cedrick Nicolas Valera',  'email' => 'cedrick.valera@program.com',   'role' => 'Support Staff',     'status' => 'Active',   'added' => 'Feb 03, 2026'],
    ['name' => 'Carla Reyes',             'email' => 'carla.reyes@program.com',      'role' => 'Support Staff',     'status' => 'Inactive', 'added' => 'Mar 21, 2026'],
];
?>

<div class="admin-form-card">
    <h3>Add New Admin User</h3>
    <form action="#" method="post">
        <div class="form-grid">
            <div class="group-input">
                <label class="form-label">Full Name</label>
                <input type="text" name="full-name" class="form-control" placeholder="e.g. Juan Dela Cruz" required>
            </div>
            <div class="group-input">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="name@program.com" required>
            </div>
            <div class="group-input">
                <label class="form-label">Admin Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select a role</option>
                    <option value="super-admin">Super Admin</option>
                    <option value="inventory-manager">Inventory Manager</option>
                    <option value="support-staff">Support Staff</option>
                </select>
            </div>
            <div class="group-input">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="group-input">
                <label class="form-label">Temporary Password</label>
                <input type="password" name="password" class="form-control" placeholder="Set an initial password" required>
            </div>
            <div class="group-input">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm-password" class="form-control" placeholder="Re-enter password" required>
            </div>
        </div>
        <button type="submit" class="btn-dark-pill" style="margin-top: 10px;">Add Admin User</button>
    </form>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <div>
            <h2>Existing Admin Users</h2>
            <p class="panel-sub">Everyone who currently has access to the seller panel</p>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminUsers as $user): ?>
                    <tr>
                        <td class="cell-main"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <?php if ($user['status'] === 'Active'): ?>
                                <span class="badge badge-success">Active</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['added']); ?></td>
                        <td>
                            <div class="table-actions">
                                <a href="#" class="action-btn edit">Edit</a>
                                <?php if ($user['status'] === 'Active'): ?>
                                    <a href="#" class="action-btn danger">Deactivate</a>
                                <?php else: ?>
                                    <a href="#" class="action-btn edit">Reactivate</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../includes/seller-footer.php'); ?>