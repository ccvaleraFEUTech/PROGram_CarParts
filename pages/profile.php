<?php 
session_start();

$title = "My Profile";
$basePath = '../';
$whiteHeader = true;
$isLogged = isset($_SESSION['user_id']);

$buyer = [
    'first' => 'Juan',
    'middle' => 'Dela',
    'surn' => 'Cruz',
    'email' => 'juan.delacruz@email.com',
    'contact' => '0912 345 6789',
    'joined' => 'March 2026',
    'initials' => 'JD',
];

$addresses = [
    ['tag' => 'Default', 'details' => '123 Juan Dela Cruz St., Brgy. Matibay, Marikina City, Metro Manila'],
    ['tag' => 'Work',    'details' => '45 Shaw Blvd., Brgy. Wack-Wack, Mandaluyong City, Metro Manila'],
];

$buyer['name'] = "{$buyer['first']} {$buyer['middle']} {$buyer['surn']}";
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
                            <form id="update-profile-form" action="<?php echo $basePath; ?>pages/update_profile.php" method="post">
                                <div class="form-grid">
                                    <div class="group-input">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first" class="form-control" value="<?php echo htmlspecialchars($buyer['first']); ?>">
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="middle" class="form-control" value="<?php echo htmlspecialchars($buyer['middle']); ?>">
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">Surname</label>
                                        <input type="text" name="surn" class="form-control" value="<?php echo htmlspecialchars($buyer['surn']); ?>">
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($buyer['email']); ?>">
                                        <p id="email-error-message" style="display: none">Email is required.</p>
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" name="contact-number" class="form-control" value="<?php echo htmlspecialchars($buyer['contact']); ?>">
                                        <p id="phone-error-message" style="display: none">Phone number is required.</p>
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
                            <form id="change-password-form" action="<?php echo $basePath; ?>pages/change_password.php" method="post">
                                <div class="form-grid">
                                    <div class="group-input full-width">
                                        <label class="form-label">Current Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="current-password" class="form-control">
                                            <i class="fa-solid fa-eye-slash password-toggle"></i>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">New Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="new-password" class="form-control" required>
                                            <i class="fa-solid fa-eye-slash password-toggle"></i>
                                        </div>
                                        
                                        <p id="new-password-error-message" style="display: none"></p>
                                        <div class="password-requirements" style="display: none">
                                            <p class="requirement" id="req-length">At least 8 characters</p>
                                            <p class="requirement" id="req-uppercase">At least 1 uppercase letter</p>
                                            <p class="requirement" id="req-lowercase">At least 1 lowercase letter</p>
                                            <p class="requirement" id="req-number">At least 1 number</p>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label class="form-label">Confirm New Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="confirm-new-password" class="form-control">
                                            <i class="fa-solid fa-eye-slash password-toggle"></i>
                                        </div>
                                        <p id="confirm-password-error-message" style="display: none">Passwords do not match.</p>
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
                            <a href="<?php echo $basePath; ?>seller/dashboard.php" class="btn-outline-pill" style="background-color:#ffffff;">Go to Seller Panel</a>
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
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <script type="module" src="<?php echo $basePath; ?>js/profile.js"></script>
</body>
</html>
