<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');
$basePath = "../";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'add') {
        $name = clean_input($_POST['product_name']);
        $sku = strtoupper(clean_input($_POST['sku']));
        $categoryId = (int) $_POST['category_id'];
        $price = (float) $_POST['price'];
        $stock = (int) $_POST['stock'];
        $reorderLevel = (int) $_POST['reorder_level'];
        $description = clean_input($_POST['description']);
        $imagePath = $basePath . 'assets/images/logo.png';

        if ($name === '' || $sku === '' || $categoryId < 1 || $price < 0 || $stock < 0 || $reorderLevel < 0) {
            set_message('Please enter valid product information.', 'error');
            redirect_to('inventory.php');
        }

        $safeSku = mysqli_real_escape_string($connection, $sku);
        if (mysqli_num_rows(mysqli_query($connection, "SELECT id FROM products WHERE sku = '$safeSku'")) > 0) {
            set_message('That SKU is already being used.', 'error');
            redirect_to('inventory.php');
        }

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
            $extension = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png');

            if (!in_array($extension, $allowedExtensions) || $_FILES['product_image']['size'] > 2000000) {
                set_message('Images must be JPG or PNG and no larger than 2 MB.', 'error');
                redirect_to('inventory.php');
            }

            $fileName = date('YmdHis') . '-' . rand(1000, 9999) . '.' . $extension;
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $basePath . 'assets/images/uploads/' . $fileName)) {
                $imagePath = 'assets/images/uploads/' . $fileName;
            }
        }

        $name = mysqli_real_escape_string($connection, $name);
        $description = mysqli_real_escape_string($connection, $description);
        $imagePath = mysqli_real_escape_string($connection, $imagePath);
        mysqli_query($connection, "INSERT INTO products
            (category_id, name, sku, price, stock, reorder_level, image, description, active, created_at)
            VALUES ($categoryId, '$name', '$safeSku', $price, $stock, $reorderLevel, '$imagePath', '$description', 1, NOW())");
        add_audit_log($connection, 'Added Product', 'Inventory', 'Created ' . clean_input($_POST['product_name']));
        set_message('Product added successfully.');
    }

    if ($action === 'update') {
        $productId = (int) $_POST['product_id'];
        $price = (float) $_POST['price'];
        $stock = (int) $_POST['stock'];
        $reorderLevel = (int) $_POST['reorder_level'];
        if ($price >= 0 && $stock >= 0 && $reorderLevel >= 0) {
            mysqli_query($connection, "UPDATE products SET price = $price, stock = $stock, reorder_level = $reorderLevel WHERE id = $productId");
            add_audit_log($connection, 'Updated Product', 'Inventory', 'Updated product ID ' . $productId);
            set_message('Product updated successfully.');
        }
    }

    if ($action === 'remove') {
        $productId = (int) $_POST['product_id'];
        mysqli_query($connection, "UPDATE products SET active = 0 WHERE id = $productId");
        add_audit_log($connection, 'Removed Product', 'Inventory', 'Deactivated product ID ' . $productId);
        set_message('Product removed from the catalog.');
    }

    redirect_to('inventory.php');
}

$title = 'Inventory & Pricing';
$activePage = 'inventory';
$categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY name");
$products = mysqli_query($connection, "SELECT products.*, categories.name AS category_name
    FROM products JOIN categories ON products.category_id = categories.id
    WHERE products.active = 1 ORDER BY products.name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $basePath; ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= $basePath; ?>assets/css/admin.css">
    <title><?php echo $title; ?> || PROGram Seller</title>
</head>
<body class="admin-body">
    <?php include $basePath . 'includes/seller-header.php'; ?>
    <main>
        <?php display_message(); ?>
        <div class="admin-form-card">
            <h3>Add Product</h3>
            <form action="inventory.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="form-grid">
                    <div class="group-input"><label class="form-label">Product Name</label><input type="text" name="product_name" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">SKU</label><input type="text" name="sku" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Category</label><select name="category_id" class="form-select" required><option value="">Select a category</option><?php while ($category = mysqli_fetch_assoc($categories)): ?><option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option><?php endwhile; ?></select></div>
                    <div class="group-input"><label class="form-label">Price</label><input type="number" name="price" step="0.01" min="0" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Starting Stock</label><input type="number" name="stock" min="0" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Reorder Level</label><input type="number" name="reorder_level" min="0" value="5" class="form-control" required></div>
                    <div class="group-input"><label class="form-label">Product Image</label><input type="file" name="product_image" accept=".jpg,.jpeg,.png" class="form-control"></div>
                    <div class="group-input"><label class="form-label">Description</label><input type="text" name="description" class="form-control" required></div>
                </div>
                <button type="submit" class="btn-dark-pill" style="margin-top:10px">Add Product</button>
            </form>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header"><div><h2>Current Inventory</h2><p class="panel-sub">Update quantities, prices, and reorder levels</p></div></div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php while ($product = mysqli_fetch_assoc($products)): ?>
                        <?php $stockStatus = product_stock_status($product['stock'], $product['reorder_level']); ?>
                        <tr>
                            <td><img src="<?php echo $basePath; ?><?php echo htmlspecialchars($product['image']); ?>" alt="product" class="product-thumb"> <span class="product-name"><?php echo htmlspecialchars($product['name']); ?><span class="cell-sub">SKU: <?php echo htmlspecialchars($product['sku']); ?></span></span></td>
                            <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                            <td>&#8369;<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['stock']; ?> (reorder: <?php echo $product['reorder_level']; ?>)</td>
                            <td><span class="badge <?php echo $stockStatus === 'In Stock' ? 'badge-success' : ($stockStatus === 'Low Stock' ? 'badge-warning' : 'badge-danger'); ?>"><?php echo $stockStatus; ?></span></td>
                            <td>
                                <div class="actions-wrapper">
                                    <form action="inventory.php" method="post" class="inline-admin-form">
                                        <input type="hidden" name="action" value="update"><input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <div class="form-row">
                                            <label>Price:</label> <input type="number" name="price" step="0.01" min="0" value="<?php echo $product['price']; ?>" class="form-control" title="Price" required>
                                            <label>Stock:</label> <input type="number" name="stock" min="0" value="<?php echo $product['stock']; ?>" class="form-control" title="Stock" required>
                                            <label>Reorder:</label> <input type="number" name="reorder_level" min="0" value="<?php echo $product['reorder_level']; ?>" class="form-control" title="Reorder level" required>
                                        </div>
                                    </form>
                                    <div class="button-row">
                                        <form action="inventory.php" method="post" class="inline-admin-form">
                                            <input type="hidden" name="action" value="update"><input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                            <input type="hidden" name="stock" value="<?php echo $product['stock']; ?>">
                                            <input type="hidden" name="reorder_level" value="<?php echo $product['reorder_level']; ?>">
                                            <button type="submit" class="action-btn edit">Save</button>
                                        </form>
                                        <form action="inventory.php" method="post" class="inline-form"><input type="hidden" name="action" value="remove"><input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"><button type="submit" class="action-btn danger">Remove</button></form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include $basePath . 'includes/seller-footer.php'; ?>
</body>
</html>
