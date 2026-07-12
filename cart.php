<?php
// cart.php — Shopping cart page
$pageTitle = "Your Cart";
include 'includes/header.php';
?>

<div class="container my-5">
    <h1 class="mb-4">Your Cart</h1>

    <!-- ==========================================================
         CART CONTENTS
         OPTION A (recommended, see style.css .cart-table): Bootstrap
                   table with columns Product | Price | Qty | Subtotal | Remove
         OPTION B: one Bootstrap .card per cart item, stacked (mobile-friendly,
                   no horizontal scrolling needed)
         ========================================================== -->
    <table class="table table-striped cart-table">
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
            <!-- One <tr> per cart item. Later a foreach loop over the
                 cart array/session will generate these rows. -->
            <tr>
                <td>
                    <img src="assets/images/1.jpg" width="60" alt="Product name">
                    Product Name
                </td>
                <td>₱0.00</td>
                <td>
                    <!-- OPTION A: plain number input
                         OPTION B: minus/plus buttons beside a readonly input -->
                    <input type="number" class="form-control" value="1" min="1" style="width:80px;">
                </td>
                <td>₱0.00</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
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

    <!-- ==========================================================
         EMPTY CART STATE
         Show this instead of the table when the cart has 0 items.
         OPTION A: simple centered message + "Continue Shopping" button
         OPTION B: message + illustration/icon above the text
         ========================================================== -->
    <!--
    <div class="text-center py-5">
        <p>Your cart is empty.</p>
        <a href="products.php" class="btn btn-brand">Continue Shopping</a>
    </div>
    -->

    <div class="text-end">
        <a href="checkout.php" class="btn btn-brand btn-lg">Proceed to Checkout</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
