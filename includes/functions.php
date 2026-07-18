<?php
function clean_input($value)
{
    return trim(strip_tags($value));
}

function redirect_to($location)
{
    header('Location: ' . $location);
    exit;
}

function set_message($message, $type = 'success')
{
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function display_message($context = 'main')
{
    if (!isset($_SESSION['message'])) {
        return;
    }

    $message = $_SESSION['message'];
    $messageType = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
    echo '<div class="site-message ' . htmlspecialchars($messageType) . '">
        <div class="site-message-content">' . htmlspecialchars($message) . '</div>
        <div class="site-message-progress"></div>
    </div>';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

function require_login($loginPath)
{
    if (!isset($_SESSION['user_id'])) {
        set_message('Please log in first.', 'error');
        redirect_to($loginPath);
    }
}

function require_seller($loginPath)
{
    require_login($loginPath);

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'Customer') {
        set_message('Seller access is required.', 'error');
        redirect_to($loginPath);
    }
}

function user_full_name($user)
{
    $name = $user['first_name'];
    if (!empty($user['middle_name'])) {
        $name .= ' ' . $user['middle_name'];
    }
    return $name . ' ' . $user['last_name'];
}

function user_initials($user)
{
    return strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
}

function product_stock_status($stock, $reorderLevel)
{
    if ($stock <= 0) {
        return 'Out of Stock';
    }
    if ($stock <= $reorderLevel) {
        return 'Low Stock';
    }
    return 'In Stock';
}

function cart_count()
{
    $count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $quantity) {
            $count += (int) $quantity;
        }
    }
    return $count;
}

function add_audit_log($connection, $action, $module, $details)
{
    $userId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 'NULL';
    $action = mysqli_real_escape_string($connection, $action);
    $module = mysqli_real_escape_string($connection, $module);
    $details = mysqli_real_escape_string($connection, $details);
    mysqli_query($connection, "INSERT INTO audit_logs (user_id, action, module, details, created_at) VALUES ($userId, '$action', '$module', '$details', NOW())");
}

function get_cart_products($connection)
{
    $cartProducts = array();

    if (empty($_SESSION['cart'])) {
        return $cartProducts;
    }

    $productIds = array();
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $productIds[] = (int) $productId;
    }

    $idList = implode(',', $productIds);
    $result = mysqli_query($connection, "SELECT * FROM products WHERE active = 1 AND id IN ($idList)");

    while ($product = mysqli_fetch_assoc($result)) {
        $product['quantity'] = (int) $_SESSION['cart'][$product['id']];
        $product['subtotal'] = $product['price'] * $product['quantity'];
        $cartProducts[] = $product;
    }

    return $cartProducts;
}

function get_cart_total($cartProducts)
{
    $total = 0;
    foreach ($cartProducts as $product) {
        $total += $product['subtotal'];
    }
    return $total;
}
?>

