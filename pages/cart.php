<?php 

$title = "Your Cart";
$whiteHeader = true;
$basePath = '../';
include('../includes/header.php');
?>

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

<?php include('../includes/footer.php'); ?>