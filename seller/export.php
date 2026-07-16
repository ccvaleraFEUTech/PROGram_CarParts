<?php
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_seller('../login.php');

$type = isset($_GET['type']) ? $_GET['type'] : '';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="program-' . ($type === 'audit' ? 'audit' : 'inventory') . '-report.csv"');
$file = fopen('php://output', 'w');

if ($type === 'audit') {
    fputcsv($file, array('Date and Time', 'User', 'Action', 'Module', 'Details'));
    $result = mysqli_query($connection, "SELECT audit_logs.*, users.first_name, users.last_name FROM audit_logs LEFT JOIN users ON audit_logs.user_id = users.id ORDER BY audit_logs.created_at DESC");
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, array($row['created_at'], trim($row['first_name'] . ' ' . $row['last_name']), $row['action'], $row['module'], $row['details']));
    }
} else {
    fputcsv($file, array('Product', 'SKU', 'Category', 'Stock', 'Reorder Level'));
    $result = mysqli_query($connection, "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.active = 1 ORDER BY products.name");
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, array($row['name'], $row['sku'], $row['category_name'], $row['stock'], $row['reorder_level']));
    }
}
fclose($file);
exit;
?>
