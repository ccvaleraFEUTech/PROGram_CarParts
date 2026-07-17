<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_login('../login.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('../pages/checkout.php');
}

$cartProducts = get_cart_products($connection);
if (empty($cartProducts)) {
    set_message('Your cart is empty.', 'error');
    redirect_to('../pages/cart.php');
}

$fullName = clean_input($_POST['full_name']);
$contactNumber = str_replace(' ', '', clean_input($_POST['contact-number']));
$streetAddress = clean_input($_POST['address']);
$region = clean_input($_POST['region']);
$province = clean_input($_POST['province']);
$city = clean_input($_POST['city']);
$barangay = clean_input($_POST['barangay']);
$payment = clean_input($_POST['payment']);

if ($fullName === '' || $streetAddress === '' || $region === '' || $province === '' || $city === '' || $barangay === '') {
    set_message('Please complete all delivery information.', 'error');
    redirect_to('../pages/checkout.php');
}

if (!preg_match('/^09[0-9]{9}$/', $contactNumber)) {
    set_message('Please enter a valid Philippine mobile number.', 'error');
    redirect_to('../pages/checkout.php');
}

if ($payment !== 'Cash on Delivery' && $payment !== 'GCash' && $payment !== 'Debit/Credit Card') {
    $payment = 'Cash on Delivery';
}

foreach ($cartProducts as $product) {
    if ($product['quantity'] > $product['stock']) {
        set_message($product['name'] . ' no longer has enough stock.', 'error');
        redirect_to('../pages/cart.php');
    }
}

$userId = (int) $_SESSION['user_id'];
$orderNumber = 'PG-' . date('Ymd') . '-' . rand(10000, 99999);
$deliveryAddress = $streetAddress . ', Brgy. ' . $barangay . ', ' . $city . ', ' . $province . ', ' . $region;
$total = get_cart_total($cartProducts);

$safeOrderNumber = mysqli_real_escape_string($connection, $orderNumber);
$safeFullName = mysqli_real_escape_string($connection, $fullName);
$safeContact = mysqli_real_escape_string($connection, $contactNumber);
$safeAddress = mysqli_real_escape_string($connection, $deliveryAddress);
$safePayment = mysqli_real_escape_string($connection, $payment);

$orderQuery = "INSERT INTO orders (user_id, order_number, full_name, contact_number, delivery_address, payment_method, total_amount, status, created_at)
               VALUES ($userId, '$safeOrderNumber', '$safeFullName', '$safeContact', '$safeAddress', '$safePayment', $total, 'Pending', NOW())";

if (!mysqli_query($connection, $orderQuery)) {
    set_message('Checkout failed. Please try again.', 'error');
    redirect_to('../pages/checkout.php');
}

$orderId = mysqli_insert_id($connection);

foreach ($cartProducts as $product) {
    $productId = (int) $product['id'];
    $productName = mysqli_real_escape_string($connection, $product['name']);
    $price = (float) $product['price'];
    $quantity = (int) $product['quantity'];
    $subtotal = (float) $product['subtotal'];

    mysqli_query($connection, "INSERT INTO order_items (order_id, product_id, product_name, price, quantity, subtotal)
                               VALUES ($orderId, $productId, '$productName', $price, $quantity, $subtotal)");
    mysqli_query($connection, "UPDATE products SET stock = stock - $quantity WHERE id = $productId");
}

unset($_SESSION['cart']);
add_audit_log($connection, 'Placed Order', 'Orders', 'Created order ' . $orderNumber);
set_message('Order ' . $orderNumber . ' was placed successfully.');
redirect_to('../pages/orders.php');
?>

