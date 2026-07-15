<?php
session_start();

$isLogged = isset($_SESSION['user_id']);
$sellerName = $_SESSION['user_name'] ?? 'Jade Castillo';
$sellerRole = $_SESSION['user_role'] ?? 'Super Admin';

if (!isset($title)) {
    $title = "Seller Panel";
}

if (!isset($basePath)) {
    $basePath = '';
}

if (!isset($activePage)) {
    $activePage = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo $basePath; ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/admin.css">
    <title><?php echo $title ?> || PROGram Seller</title>
</head>
<body class="admin-body">

    <button type="button" id="admin-toggle" class="admin-mobile-toggle" aria-label="Toggle seller menu" aria-expanded="false" aria-controls="admin-sidebar">&#9776;</button>
    <div id="admin-overlay" class="admin-overlay"></div>

    <div class="admin-shell">
        <aside id="admin-sidebar" class="admin-sidebar">
            <div class="admin-brand">
                <a href="/PROGram/index.php"><img src="/PROGram/assets/images/logo.png" alt="logo"></a>
                <span>PROGram<br>Seller Panel</span>
            </div>

            <nav class="admin-nav">
                <ul>
                    <li><a href="/PROGram/seller/dashboard.php" class="<?php echo $activePage == 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
                    <li><a href="/PROGram/seller/users.php" class="<?php echo $activePage == 'users' ? 'active' : ''; ?>">Admin Users</a></li>
                    <li><a href="/PROGram/seller/inventory.php" class="<?php echo $activePage == 'inventory' ? 'active' : ''; ?>">Inventory & Pricing</a></li>
                    <li><a href="/PROGram/seller/reports.php" class="<?php echo $activePage == 'reports' ? 'active' : ''; ?>">Reports</a></li>
                </ul>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="/PROGram/index.php">&larr; Back to Store</a>
                <a href="#" class="logout-link">Logout</a>
            </div>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <div>
                    <h1><?php echo $title ?></h1>
                    <p class="admin-subtitle">Welcome back, <?php echo htmlspecialchars($sellerName); ?></p>
                </div>
                <div class="admin-account">
                    <span class="role-badge"><?php echo htmlspecialchars($sellerRole); ?></span>
                </div>
            </header>