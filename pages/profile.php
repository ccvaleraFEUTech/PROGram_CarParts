<?php

$title = "My Profile";
$whiteHeader = true;
$basePath = '../';
include('../includes/header.php');

$buyer = [
    'name' => 'Juan Dela Cruz',
    'email' => 'juan.delacruz@email.com',
    'contact' => '0912 345 6789',
    'joined' => 'March 2026',
    'initials' => 'JD',
];

$addresses = [
    ['tag' => 'Default', 'details' => '123 Juan Dela Cruz St., Brgy. Matibay, Marikina City, Metro Manila'],
    ['tag' => 'Work',    'details' => '45 Shaw Blvd., Brgy. Wack-Wack, Mandaluyong City, Metro Manila'],
];
?>

<section class="profile-section">
    <div class="profile-container">

        <div class="profile-head">
            <div class="profile-avatar"><?php echo htmlspecialchars($buyer['initials']); ?></div>
            <div>
                <h1><?php echo htmlspecialchars($buyer['name']); ?></h1>
                <p>Member since <?php echo htmlspecialchars($buyer['joined']); ?> &middot; <?php echo htmlspecialchars($buyer['email']); ?></p>
            </div>
        </div>

        <div class="profile-grid">
            <div class="profile-main">

                <div class="profile-card">
                    <h3>Account Information</h3>
                    <form action="#" method="post">
                        <div class="form-grid">
                            <div class="group-input">
                                <label class="form-label">Complete Name</label>
                                <input type="text" name="full-name" class="form-control" value="<?php echo htmlspecialchars($buyer['name']); ?>">
                            </div>
                            <div class="group-input">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($buyer['email']); ?>">
                            </div>
                            <div class="group-input">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact-number" class="form-control" value="<?php echo htmlspecialchars($buyer['contact']); ?>">
                            </div>
                            <div class="group-input">
                                <label class="form-label">Region</label>
                                <select name="region" class="form-select">
                                    <option>National Capital Region</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn" style="margin-top: 20px;">Save Changes</button>
                    </form>
                </div>

                <div class="profile-card">
                    <h3>Change Password</h3>
                    <form action="#" method="post">
                        <div class="form-grid">
                            <div class="group-input full-width">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current-password" class="form-control">
                            </div>
                            <div class="group-input">
                                <label class="form-label">New Password</label>
                                <input type="password" name="new-password" class="form-control">
                            </div>
                            <div class="group-input">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="confirm-new-password" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="submit-btn" style="margin-top: 20px;">Update Password</button>
                    </form>
                </div>

                <div class="profile-card">
                    <h3>Saved Addresses</h3>
                    <?php foreach ($addresses as $address): ?>
                        <div class="address-card">
                            <span class="tag"><?php echo htmlspecialchars($address['tag']); ?></span>
                            <p><?php echo htmlspecialchars($address['details']); ?></p>
                        </div>
                    <?php endforeach; ?>
                    <a href="#" class="btn-outline-pill">+ Add New Address</a>
                </div>

                <div class="profile-card">
                    <h3>Notification Preferences</h3>
                    <div class="pref-row">
                        <div>
                            <p>Order Updates</p>
                            <span>Get notified about order status and delivery</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                    <div class="pref-row">
                        <div>
                            <p>Promotions & Discounts</p>
                            <span>Receive emails about sales and new products</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                </div>

            </div>

            <div class="profile-side">
                <div class="seller-cta">
                    <h3>Sell on PROGram</h3>
                    <p>Have genuine car parts to offer? Apply for seller access and manage your own stock, pricing, and orders from the seller panel.</p>
                    <a href="/PROGram/seller/dashboard.php" class="btn-outline-pill" style="background-color:#ffffff;">Go to Seller Panel</a>
                </div>

                <div class="profile-card" style="margin-top: 30px;">
                    <h3>Session</h3>
                    <form action="#" method="post">
                        <button type="submit" class="logout-full">Logout</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include('../includes/footer.php'); ?>