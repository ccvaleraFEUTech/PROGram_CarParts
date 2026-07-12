<?php
// navbar.php
// Skeleton only. No styling decisions have been made here yet —
// see the matching comment block in assets/css/style.css (SECTION: NAVBAR)
// for the design options to choose from.
?>
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <!-- GROUP LOGO + GROUP NAME (required by the project brief) -->
        <a class="navbar-brand" href="index.php">
            <!-- <img src="assets/images/logo.png" alt="Group Logo"> -->
            PK Auto Parts
        </a>

        <!-- Hamburger button for mobile view -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>

                <!-- TODO (backend teammate): swap this block for
                     "Hello, <username> | Logout" once a session exists -->
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
