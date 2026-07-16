<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');

if ($_SESSION['user_role'] !== 'Super Admin') {
    set_message('Only the Super Admin can manage admin users.', 'error');
    redirect_to('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'add') {
        $firstName = clean_input($_POST['first_name']);
        $middleName = clean_input($_POST['middle_name']);
        $lastName = clean_input($_POST['last_name']);
        $email = strtolower(clean_input($_POST['email']));
        $role = clean_input($_POST['role']);
        $status = clean_input($_POST['status']) === 'Inactive' ? 'Inactive' : 'Active';
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $allowedRoles = array('Super Admin', 'Inventory Manager', 'Support Staff');

        if ($firstName === '' || $lastName === '' || !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) || !in_array($role, $allowedRoles) || $password !== $confirmPassword || strlen($password) < 8) {
            set_message('Please enter valid admin information and matching passwords.', 'error');
            redirect_to('users.php');
        }

        $safeEmail = mysqli_real_escape_string($connection, $email);
        if (mysqli_num_rows(mysqli_query($connection, "SELECT id FROM users WHERE email = '$safeEmail'")) > 0) {
            set_message('That email address is already registered.', 'error');
            redirect_to('users.php');
        }

        $firstName = mysqli_real_escape_string($connection, $firstName);
        $middleName = mysqli_real_escape_string($connection, $middleName);
        $lastName = mysqli_real_escape_string($connection, $lastName);
        $role = mysqli_real_escape_string($connection, $role);
        $password = mysqli_real_escape_string($connection, password_hash($password, PASSWORD_DEFAULT));
        mysqli_query($connection, "INSERT INTO users
            (first_name, middle_name, last_name, email, password, contact_number, role, status, created_at)
            VALUES ('$firstName', '$middleName', '$lastName', '$safeEmail', '$password', 'Not provided', '$role', '$status', NOW())");
        add_audit_log($connection, 'Added Admin', 'User Management', 'Created an admin account');
        set_message('Admin user added successfully.');
    }

    if ($action === 'toggle') {
        $adminId = (int) $_POST['user_id'];
        if ($adminId === (int) $_SESSION['user_id']) {
            set_message('You cannot deactivate your own account.', 'error');
            redirect_to('users.php');
        }
        $result = mysqli_query($connection, "SELECT status FROM users WHERE id = $adminId AND role != 'Customer'");
        if ($admin = mysqli_fetch_assoc($result)) {
            $newStatus = $admin['status'] === 'Active' ? 'Inactive' : 'Active';
            mysqli_query($connection, "UPDATE users SET status = '$newStatus' WHERE id = $adminId");
            add_audit_log($connection, 'Changed Admin Status', 'User Management', 'Set admin ID ' . $adminId . ' to ' . $newStatus);
            set_message('Admin status updated.');
        }
    }

    redirect_to('users.php');
}

$title = 'Admin Users';
$basePath = '../';
$activePage = 'users';
$adminUsers = mysqli_query($connection, "SELECT * FROM users WHERE role != 'Customer' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/admin.css">
    <title><?php echo $title; ?> || PROGram Seller</title>
</head>
<body class="admin-body">
    <?php include '../includes/seller-header.php'; ?>
    <main>
        <?php display_message(); ?>
        <div class="admin-form-card">
            <h3>Add New Admin User</h3>
            <form action="users.php" method="post">
                <input type="hidden" name="action" value="add">
                <div class="form-grid">
                    <div class="group-input"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Middle Name</label><input type="text" name="middle_name" class="form-control"></div>
                    <div class="group-input"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Role</label><select name="role" class="form-select" required><option value="Inventory Manager">Inventory Manager</option><option value="Support Staff">Support Staff</option><option value="Super Admin">Super Admin</option></select></div>
                    <div class="group-input"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
                    <div class="group-input"><label class="form-label">Temporary Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Confirm Password</label><input type="password" name="confirm_password" class="form-control" required></div>
                </div>
                <button type="submit" class="btn-dark-pill" style="margin-top:10px">Add Admin User</button>
            </form>
        </div>
        <div class="admin-panel">
            <div class="admin-panel-header"><div><h2>Existing Admin Users</h2><p class="panel-sub">Accounts with seller panel access</p></div></div>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Date Added</th><th>Action</th></tr></thead><tbody>
                <?php while ($admin = mysqli_fetch_assoc($adminUsers)): ?><tr>
                    <td class="cell-main"><?php echo htmlspecialchars(user_full_name($admin)); ?></td><td><?php echo htmlspecialchars($admin['email']); ?></td><td><?php echo htmlspecialchars($admin['role']); ?></td>
                    <td><span class="badge <?php echo $admin['status'] === 'Active' ? 'badge-success' : 'badge-danger'; ?>"><?php echo htmlspecialchars($admin['status']); ?></span></td>
                    <td><?php echo date('M d, Y', strtotime($admin['created_at'])); ?></td>
                    <td><form action="users.php" method="post"><input type="hidden" name="action" value="toggle"><input type="hidden" name="user_id" value="<?php echo $admin['id']; ?>"><button type="submit" class="action-btn <?php echo $admin['status'] === 'Active' ? 'danger' : 'edit'; ?>"><?php echo $admin['status'] === 'Active' ? 'Deactivate' : 'Reactivate'; ?></button></form></td>
                </tr><?php endwhile; ?>
            </tbody></table></div>
        </div>
    </main>
    <?php include '../includes/seller-footer.php'; ?>
</body>
</html>
