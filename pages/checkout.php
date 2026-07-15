<?php 

$title = "Checkout";
$whiteHeader = true;
$basePath = '../';
include('../includes/header.php');

?>

<section class="check-section">
    <div class="check-container">
        <h1 class="check-title">Checkout</h1>

        <div class="check-wrapper">
            <div class="check-column left">
                <h4>Delivery Information</h4>
                <form action="#" method="post" class="auth-form" style="max-width:100%;">
                    <div class="form-grid">
                        <div class="group-input">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" required>
                        </div>
                        <div class="group-input">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="contact-number" required>
                        </div>
                        <div class="group-input full-width">
                            <label class="form-label">Complete Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>

                        <div class="group-input">
                            <label class="form-label">Region</label>
                            <select name="region" id="region" class="form-select" required></select>
                        </div>
                        <div class="group-input">
                            <label class="form-label">Province</label>
                            <select name="province" id="province" class="form-select" required></select>
                        </div>
                        <div class="group-input">
                            <label class="form-label">City/Municipality</label>
                            <select name="city" id="city" class="form-select" required></select>
                        </div>

                        <div class="payment">
                            <label class="form-label">Payment Method</label>
                            <div class="form-check">
                                <input type="radio" name="payment" id="cod" class="form-check-input" checked>
                                <label for="cod" class="form-check-label">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment" id="gcash" class="form-check-input">
                                <label for="gcash" class="form-check-label">GCash</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>

            <div class="check-column right">
                <div class="card-summary">
                    <div class="summary-body">
                        <h5 class="card-title">Order Summary</h5>
                        <ul class="summary-list">
                            <li>
                                <span>Product Name x1</span>
                                <span>₱0.00</span>
                            </li>
                        </ul>
                        <hr>
                        <div class="cart-total-row">
                            <strong>Total</strong>
                            <strong>₱0.00</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>