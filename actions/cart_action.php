<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../pages/cart.php');
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add') {
    $productId = (int) $_POST['product_id'];
    $quantity = max(1, (int) $_POST['quantity']);
    $result = mysqli_query($connection, "SELECT id, name, stock FROM products WHERE id = $productId AND active = 1");

    if (mysqli_num_rows($result) !== 1) {
        set_message('Product not found.', 'error');
        redirect_to('../pages/products.php');
    }

    $product = mysqli_fetch_assoc($result);
    $currentQuantity = isset($_SESSION['cart'][$productId]) ? (int) $_SESSION['cart'][$productId] : 0;

    if ($product['stock'] <= 0 || $currentQuantity + $quantity > $product['stock']) {
        set_message('The requested quantity is not available.', 'error');
        redirect_to('../pages/product-info.php?id=' . $productId);
    }

    $_SESSION['cart'][$productId] = $currentQuantity + $quantity;
    set_message($product['name'] . ' was added to your cart.');
    redirect_to('../pages/cart.php');
}

if ($action === 'update' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $productId => $quantity) {
        $productId = (int) $productId;
        $quantity = max(1, (int) $quantity);
        $result = mysqli_query($connection, "SELECT stock FROM products WHERE id = $productId AND active = 1");
        if ($product = mysqli_fetch_assoc($result)) {
            $_SESSION['cart'][$productId] = min($quantity, (int) $product['stock']);
            if ($_SESSION['cart'][$productId] <= 0) {
                unset($_SESSION['cart'][$productId]);
            }
        }
    }
    set_message('Cart quantities updated.');
    redirect_to('../pages/cart.php');
}

if ($action === 'remove' && isset($_POST['product_id'])) {
    $productId = (int) $_POST['product_id'];
    unset($_SESSION['cart'][$productId]);
    set_message('Product removed from your cart.');
}

if ($action === 'clear') {
    unset($_SESSION['cart']);
    set_message('Your cart is now empty.');
}

redirect_to('../pages/cart.php');
?>
