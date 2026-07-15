<?php 
session_start();

$title = "Your Cart";
$basePath = '../';
$whiteHeader = true;
$isLogged = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo $basePath; ?>assets/images/favicon.ico">
    <script src="https://kit.fontawesome.com/5e3c72a53d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include '../includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <section class="add-to-cart-section">
            <div class="add-to-cart-container">
                <h1>Your Cart</h1>
                <div class="table-responsive">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="" width="60" alt="Product Name">
                                    Product Name
                                </td>
                                <td>₱0.00</td>
                                <td>
                                    <input type="number" class="form-control" value="1" min="1" style="width: 80px;">
                                </td>
                                <td>₱0.00</td>
                                <td>
                                    <a href="#" class="remove">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="cart-total-row">
                                <td colspan="3" class="text-end">Total:</td>
                                <td colspan="2">₱0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                

                <div class="text-end">
                    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                </div>
            </div>
        </section>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script src="<?php echo $basePath; ?>js/checkout.js"></script>
</body>
</html>
