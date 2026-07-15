<?php

$title = "Inventory & Pricing";
$basePath = '../';
$activePage = 'inventory';
include('../includes/seller-header.php');

$products = [
    ['img' => '../assets/images/products/aem-x-series-uego.jpg', 'name' => 'AEM X-Series Wideband UEGO Gauge Kit', 'sku' => 'AEM-UEGO-001', 'category' => 'Gauges',        'price' => '50,130.60', 'stock' => 34, 'status' => 'In Stock'],
    ['img' => '../assets/images/products/eibach-pro-kit.jpg',    'name' => 'Eibach Pro-Kit Lowering Springs',      'sku' => 'EIB-PRO-014',  'category' => 'Suspension',     'price' => '12,623.56', 'stock' => 8,  'status' => 'Low Stock'],
    ['img' => '../assets/images/products/garrett-g25.jpg',       'name' => 'Garrett G25-550 Turbocharger',         'sku' => 'GAR-G25-550',  'category' => 'Turbochargers',  'price' => '19,520.07', 'stock' => 0,  'status' => 'Out of Stock'],
    ['img' => '../assets/images/products/gtc-300.png',           'name' => 'APR GTC-300 Adjustable Rear Wing',     'sku' => 'APR-GTC-300',  'category' => 'Aerodynamics',   'price' => '91,835.29', 'stock' => 15, 'status' => 'In Stock'],
    ['img' => '../assets/images/index/hks-hi-power.jpg',         'name' => 'HKS Hi-Power Exhaust',                 'sku' => 'HKS-HPX-220',  'category' => 'Exhausts',       'price' => '130,267.94','stock' => 5,  'status' => 'Low Stock'],
    ['img' => '../assets/images/index/tein-flex-z.jpg',          'name' => 'Tein Flex Z Coilover Suspension Kit',  'sku' => 'TEIN-FLXZ-09',  'category' => 'Suspension',    'price' => '50,130.60', 'stock' => 42, 'status' => 'In Stock'],
];
?>

<div class="admin-form-card">
    <h3>Add / Update Product</h3>
    <form action="#" method="post">
        <div class="form-grid">
            <div class="group-input">
                <label class="form-label">Product Name</label>
                <input type="text" name="product-name" class="form-control" placeholder="e.g. Brembo GT Systems BBK" required>
            </div>
            <div class="group-input">
                <label class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control" placeholder="e.g. BRM-GT4-RD" required>
            </div>
            <div class="group-input">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="">Select a category</option>
                    <option>Engines</option>
                    <option>Brakes</option>
                    <option>Tires/Wheels</option>
                    <option>Accessories/Boosts</option>
                    <option>Transmissions</option>
                    <option>Engine Pipes</option>
                    <option>Exhausts</option>
                    <option>Covers/Paints</option>
                    <option>Turbochargers</option>
                    <option>Gauges</option>
                    <option>Suspension Springs</option>
                    <option>Aerodynamics</option>
                    <option>Radio/Computers</option>
                </select>
            </div>
            <div class="group-input">
                <label class="form-label">Price (₱)</label>
                <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="0.00" required>
            </div>
            <div class="group-input">
                <label class="form-label">Stock Quantity</label>
                <input type="number" min="0" name="stock" class="form-control" placeholder="0" required>
            </div>
            <div class="group-input">
                <label class="form-label">Product Image</label>
                <input type="file" name="product-image" class="form-control" accept="image/*">
            </div>
            <div class="group-input full-width">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Short product description">
            </div>
        </div>
        <button type="submit" class="btn-dark-pill" style="margin-top: 10px;">Save Product</button>
    </form>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <div>
            <h2>Current Stock</h2>
            <p class="panel-sub">Update quantities or prices, or remove a product from the catalog</p>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price (₱)</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="cell-main">
                            <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="product">
                            <span>
                                <?php echo htmlspecialchars($product['name']); ?>
                                <span class="cell-sub">SKU: <?php echo htmlspecialchars($product['sku']); ?></span>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($product['category']); ?></td>
                        <td>
                            <input type="number" step="0.01" min="0" class="form-control" style="width: 130px; text-align: left;" value="<?php echo htmlspecialchars(str_replace(',', '', $product['price'])); ?>">
                        </td>
                        <td>
                            <input type="number" min="0" class="form-control" style="width: 80px; text-align: left;" value="<?php echo htmlspecialchars($product['stock']); ?>">
                        </td>
                        <td>
                            <?php
                                $badgeClass = 'badge-success';
                                if ($product['status'] === 'Low Stock') $badgeClass = 'badge-warning';
                                if ($product['status'] === 'Out of Stock') $badgeClass = 'badge-danger';
                            ?>
                            <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($product['status']); ?></span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="#" class="action-btn edit">Save</a>
                                <a href="#" class="action-btn danger">Remove</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../includes/seller-footer.php'); ?>