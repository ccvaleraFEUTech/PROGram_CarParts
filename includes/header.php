<?php
// header.php
// This file is included at the TOP of every page (index.php, products.php, etc.)
// so we only write the <head> and opening tags ONCE.
// $pageTitle is set by each page BEFORE including this file, e.g.:
//   $pageTitle = "Home";
//   include 'includes/header.php';
if (!isset($pageTitle)) {
    $pageTitle = "PK Auto Parts";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | PK Auto Parts</title>

    <!-- Bootstrap 5 CSS (already in the project's assets/css folder) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Our own stylesheet — this is where the color palette / theme lives -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ============================================
     NAVBAR (shared across all pages)
     ============================================ -->
<?php include 'includes/navbar.php'; ?>

<!-- Page content starts below this line in each individual page file -->
