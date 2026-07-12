<?php
// checkout.php — Checkout + payment (no real payment API, school project only)
$pageTitle = "Checkout";
include 'includes/header.php';
?>

<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    <div class="row g-4">

        <!-- ==========================================================
             SHIPPING / DELIVERY DETAILS FORM
             See style.css -> SECTION: FORMS
             OPTION A: two-column layout (First/Last name, City/Province)
             OPTION B: single-column stacked fields (simplest for beginners)
             ========================================================== -->
        <div class="col-md-7">
            <h4>Delivery Information</h4>
            <form action="#" method="post" class="auth-form" style="max-width:100%;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact_number">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Complete Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>

                    <!-- Region -> Province -> City dropdowns.
                         The three IDs below (region/province/city) are what
                         assets/js/location-dropdowns.js looks for. It reads
                         the embedded data in assets/js/ph-locations-data.js
                         (from the philippine-regions-provinces-cities-
                         municipalities-barangays dataset) and:
                           1. fills Region on page load
                           2. fills Province when a Region is picked
                           3. fills City/Municipality when a Province is picked
                         No page refresh needed — it all runs in the browser. -->
                    <div class="col-md-4">
                        <label class="form-label">Region</label>
                        <select class="form-select" id="region" name="region" required></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Province</label>
                        <select class="form-select" id="province" name="province" required></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City/Municipality</label>
                        <select class="form-select" id="city" name="city" required></select>
                    </div>

                    <!-- ==========================================================
                         PAYMENT METHOD (no real payment API)
                         OPTION A: radio buttons (Cash on Delivery / GCash mock / Bank Transfer mock)
                         OPTION B: simple dropdown select instead of radios
                         ========================================================== -->
                    <div class="col-12">
                        <label class="form-label d-block">Payment Method</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="cod" checked>
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="gcash">
                            <label class="form-check-label" for="gcash">GCash (mock, no real transaction)</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand btn-lg mt-4 w-100">Place Order</button>
            </form>
        </div>

        <!-- ==========================================================
             ORDER SUMMARY
             OPTION A: plain list of items + total, inside a .card
             OPTION B: mini version of the cart table, read-only
             ========================================================== -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between">
                            <span>Product Name x1</span>
                            <span>₱0.00</span>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between cart-total-row">
                        <span>Total</span>
                        <span>₱0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
