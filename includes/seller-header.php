<?php 
$sellerName = $_SESSION['user_name'] ?? 'Jade Castillo';
$sellerRole = $_SESSION['user_role'] ?? 'Super Admin';
?>

<button type="button" id="admin-toggle" class="admin-mobile-toggle" aria-label="Toggle seller menu" aria-expanded="false" aria-controls="admin-sidebar">&#9776;</button>
<div id="admin-overlay" class="admin-overlay"></div>

<div class="admin-shell">
    <aside id="admin-sidebar" class="admin-sidebar">
        <div class="admin-brand">
            <a href="<?php echo $basePath; ?>index.php"><img src="<?php echo $basePath; ?>assets/images/logo.png" alt="logo"></a>
            <span>PROGram<br>Seller Panel</span>
        </div>

        <nav class="admin-nav">
            <ul>
                <li><a href="<?php echo $basePath; ?>seller/dashboard.php" class="<?php echo $activePage == 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="<?php echo $basePath; ?>seller/users.php" class="<?php echo $activePage == 'users' ? 'active' : ''; ?>">Admin Users</a></li>
                <li><a href="<?php echo $basePath; ?>seller/inventory.php" class="<?php echo $activePage == 'inventory' ? 'active' : ''; ?>">Inventory & Pricing</a></li>
                <li><a href="<?php echo $basePath; ?>seller/reports.php" class="<?php echo $activePage == 'reports' ? 'active' : ''; ?>">Reports</a></li>
            </ul>
        </nav>

        <div class="admin-sidebar-footer">
            <a href="<?php echo $basePath; ?>index.php">&larr; Back to Store</a>
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
