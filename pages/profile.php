<?php 
session_start();
require_once '../includes/database.php';
require_once '../includes/functions.php';
require_login('../login.php');

$title = "My Profile";
$basePath = '../';
$whiteHeader = true;
$isLogged = isset($_SESSION['user_id']);

$userId = (int) $_SESSION['user_id'];
$userResult = mysqli_query($connection, "SELECT * FROM users WHERE id = $userId");
$user = mysqli_fetch_assoc($userResult);
$addresses = mysqli_query($connection, "SELECT * FROM addresses WHERE user_id = $userId ORDER BY is_default DESC, id DESC");
$recentOrders = mysqli_query($connection, "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC LIMIT 3");
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
<body data-base-path="<?php echo $basePath; ?>">
    <?php if(!isset($hideHeader) || !$hideHeader): ?>
        <?php include '../includes/header.php'; ?>
    <?php endif; ?>

    <main>
        <?php display_message('main'); ?>
        <section class="profile-section">
            <div class="profile-container">

                <div class="profile-head">
                    <div class="profile-avatar"><?php echo htmlspecialchars(user_initials($user)); ?></div>
                    <div>
                        <h1><?php echo htmlspecialchars(user_full_name($user)); ?></h1>
                        <p>Member since <?php echo date('F Y', strtotime($user['created_at'])); ?></p>
                    </div>
                </div>

                <div class="profile-grid">
                    <div class="profile-main">
                        <div class="profile-card">
                            <div class="card-header">
                                <h3>Account Information</h3>
                                <button type="button" class="edit-toggle-btn" id="edit-account-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            <form action="../actions/profile_handler.php" method="post" id="account-form">
                                <input type="hidden" name="action" value="update_profile">
                                <div class="form-grid">
                                    <div class="group-input"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" disabled></div>
                                    <div class="group-input"><label class="form-label">Middle Name</label><input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($user['middle_name']); ?>" disabled></div>
                                    <div class="group-input"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" disabled></div>
                                    <div class="group-input">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                                        <div class="email-verification-status <?php echo strtolower($user['email_status']) === 'confirmed' ? 'verified' : 'pending'; ?>">
                                            <?php if (strtolower($user['email_status']) === 'confirmed'): ?>
                                                <i class="fas fa-check-circle"></i> Email Verified
                                            <?php else: ?>
                                                <i class="fas fa-clock"></i> Verification Pending
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="group-input"><label class="form-label">Contact Number</label><input type="text" name="contact_number" class="form-control" value="<?php echo htmlspecialchars($user['contact_number']); ?>" disabled></div>
                                </div>
                                <button type="submit" class="submit-btn" style="margin-top:20px; display:none;" id="save-account-btn">Save Changes</button>
                            </form>
                        </div>

                        <div class="profile-card">
                            <h3>Change Password</h3>
                            <form action="../actions/profile_handler.php" method="post" id="change-password-form">
                                <input type="hidden" name="action" value="change_password">
                                <div class="form-grid">
                                    <div class="group-input full-width"><label class="form-label">Current Password</label><input type="password" name="current_password" class="form-control" required></div>
                                    <div class="group-input">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" required>
                                        <ul class="password-requirements" style="display: none">
                                            <li data-rule="length">
                                                <i class="fa-solid fa-circle"></i> At least 8 characters
                                            </li>
                                            <li data-rule="uppercase">
                                                <i class="fa-solid fa-circle"></i> One uppercase letter
                                            </li>
                                            <li data-rule="lowercase">
                                                <i class="fa-solid fa-circle"></i> One lowercase letter
                                            </li>
                                            <li data-rule="number">
                                                <i class="fa-solid fa-circle"></i> One number
                                            </li>
                                            <li data-rule="symbol">
                                                <i class="fa-solid fa-circle"></i> One special character
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="group-input"><label class="form-label">Confirm New Password</label><input type="password" name="confirm_password" class="form-control" required></div>
                                </div>
                                <button type="submit" class="submit-btn" style="margin-top:20px">Update Password</button>
                            </form>
                        </div>

                        <div class="profile-card">
                            <h3>Saved Addresses</h3>
                            <?php while ($address = mysqli_fetch_assoc($addresses)): ?>
                                <div class="address-card">
                                    <div class="address-content">
                                        <span class="tag"><?php echo $address['is_default'] ? 'Default' : htmlspecialchars($address['label']); ?></span>
                                        <p><?php echo htmlspecialchars($address['street_address'] . ', Brgy. ' . $address['barangay'] . ', ' . $address['city'] . ', ' . $address['province'] . ', ' . $address['region']); ?></p>
                                    </div>
                                    <?php if (!$address['is_default']): ?>
                                        <form action="../actions/profile_handler.php" method="post">
                                            <input type="hidden" name="action" value="delete_address">
                                            <input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
                                            <button type="submit" class="remove-address"><i class="fas fa-trash"></i></button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>

                            <h4>Add New Address</h4>
                            <form action="../actions/profile_handler.php" method="post">
                                <input type="hidden" name="action" value="add_address">
                                <div class="form-grid">
                                    <div class="group-input"><label class="form-label">Label</label><select name="label" class="form-select" required>
                                        <option value="">Select Label</option>
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select></div>
                                    <div class="group-input"><label class="form-label">Street / House No.</label><input type="text" name="street" class="form-control" required></div>
                                    <div class="group-input"><label class="form-label">Region</label><select name="region" id="address-region" class="form-select"></select></div>
                                    <div class="group-input"><label class="form-label">Province</label><select name="province" id="address-province" class="form-select"></select></div>
                                    <div class="group-input"><label class="form-label">City/Municipality</label><select name="city" id="address-city" class="form-select"></select></div>
                                    <div class="group-input"><label class="form-label">Barangay</label><select name="barangay" id="address-barangay" class="form-select"></select></div>
                                </div>
                                <button type="submit" class="btn-outline-pill" style="margin-top:15px">+ Add Address</button>
                            </form>
                        </div>

                        <div class="profile-card">
                            <h3>Recent Orders</h3>
                            <?php if (mysqli_num_rows($recentOrders) === 0): ?><p>You have not placed an order yet.</p><?php endif; ?>
                            <?php while ($order = mysqli_fetch_assoc($recentOrders)): ?>
                                <div class="address-card">
                                    <span class="tag"><?php echo htmlspecialchars($order['status']); ?></span>
                                    <p><strong><?php echo htmlspecialchars($order['order_number']); ?></strong> &middot; &#8369;<?php echo number_format($order['total_amount'], 2); ?> &middot; <?php echo date('M d, Y', strtotime($order['created_at'])); ?></p>
                                </div>
                            <?php endwhile; ?>
                            <a href="orders.php" class="btn-outline-pill">View All Orders</a>
                        </div>

                    </div>

                    <div class="profile-side">
                        <?php if ($user['role'] !== 'Customer'): ?>
                            <div class="seller-cta"><h3>Seller Panel</h3><p>Manage products, users, inventory, orders, and reports.</p><a href="../seller/dashboard.php" class="btn-outline-pill" style="background:#fff">Go to Seller Panel</a></div>
                        <?php endif; ?>
                        <div class="profile-card" >
                            <h3>Notification Preferences</h3>
                            <form action="../actions/profile_handler.php" method="post">
                                <input type="hidden" name="action" value="preferences">
                                <div class="pref-row">
                                    <div>
                                        <p>Order Updates</p>
                                        <span>Get notified about order status and delivery</span>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" name="order_updates" <?php echo $user['order_updates'] ? 'checked' : ''; ?>>
                                        <span class="slider-toggle"></span>
                                    </label>
                                </div>
                                <div class="pref-row">
                                    <div>
                                        <p>Promotions & Discounts</p>
                                        <span>Receive emails about sales and new products</span>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" name="promotions" <?php echo $user['promotions'] ? 'checked' : ''; ?>>
                                        <span class="slider-toggle"></span>
                                    </label>
                                </div>
                                <button type="submit" class="btn-outline-pill">Save Preferences</button>
                            </form>
                        </div>
                        <div class="profile-card" style="margin-top:30px"><h3>Session</h3><a href="../actions/logout.php" class="logout-full">Logout</a></div>
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
    <script src="<?php echo $basePath; ?>js/location.js"></script>
</body>
</html>
