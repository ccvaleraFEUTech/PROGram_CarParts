<?php 
session_start();

$title = "About";
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
        <section class="about-section">
            <div class="about-container">
                <div class="about-intro">
                    <h1>About PROGram</h1>
                    <p>PROGram is an online store built around genuine car parts &mdash; from exhausts and
                        turbochargers to suspension kits and aerodynamics parts. We work with trusted car parts
                        partners to bring high quality upgrades straight to our customers, backed by fast
                        delivery and dedicated customer service.</p>
                </div>

                <div class="about-members">
                    <h3>The Team</h3>
                    <div class="member-grid">
                        <div class="member-card">
                            <p class="member-name">Jade Carlos Castillo</p>
                        </div>
                        <div class="member-card">
                            <p class="member-name">James Ivan Frondarina</p>
                        </div>
                        <div class="member-card">
                            <p class="member-name">Gene Andrei Manacop</p>
                        </div>
                        <div class="member-card">
                            <p class="member-name">Cedrick Nicolas Valera</p>
                        </div>
                    </div>
                </div>

                <div class="about-contact">
                    <h3>Get in Touch</h3>
                    <ul class="list-info">
                        <li><strong>Address:</strong> 123 Juan Dela Cruz St. Brgy Sampaloc, Manila, Philippines</li>
                        <li><strong>Contact Number:</strong> 0912-345-6789 (Globe)</li>
                        <li><strong>Email:</strong> program-support@gmail.com</li>
                        <li><strong>Service Days & Hours:</strong> (Mon-Sun) 8:00 AM - 5:00 PM</li>
                    </ul>
                </div>

                <p class="about-disclaimer">
                    This website is a student project from FEU Tech, subject CCS0043/L, which is for
                    educational purposes only. No real transactions take place.
                </p>
            </div>
        </section>
    </main>

    <?php if(!isset($hideFooter) || !$hideFooter): ?>
        <?php include '../includes/footer.php'; ?>
    <?php endif; ?>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
</body>
</html>
