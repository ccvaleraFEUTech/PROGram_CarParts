<?php
// products.php — Catalog / store page
$pageTitle = "Products";
include 'includes/header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Our Products</h1>

    <div class="row">

        <!-- ==========================================================
             SIDEBAR: CATEGORY FILTER
             OPTION A: simple list of links (Brakes, Engine, Tires, etc.)
             OPTION B: <select> dropdown at the top instead of a sidebar
                       (better for mobile, one column layout)
             OPTION C: pill-style buttons row above the products, using
                       Bootstrap .nav-pills instead of a sidebar
             ========================================================== -->
        <aside class="col-md-3 mb-4">
            <h5>Categories</h5>
            <ul class="list-unstyled category-list">
                <li><a href="#">All</a></li>
                <li><a href="#">Engine Parts</a></li>
                <li><a href="#">Brakes</a></li>
                <li><a href="#">Tires &amp; Wheels</a></li>
                <li><a href="#">Accessories</a></li>
            </ul>
        </aside>

        <!-- ==========================================================
             PRODUCT GRID
             Same .product-card styling as index.php featured section.
             Later a PHP foreach loop (from Modules: Arrays / Predefined
             Functions) will print one card per row from the database.
             ========================================================== -->
        <div class="col-md-9">
            <div class="row g-4">

                <div class="col-sm-6 col-lg-4">
                    <div class="card product-card h-100">
                        <img src="assets/images/1.jpg" class="card-img-top" alt="Product name">
                        <div class="card-body">
                            <h5 class="card-title">Product Name</h5>
                            <p class="product-price">₱0.00</p>
                            <form action="add_to_cart.php" method="post">
                                <input type="hidden" name="product_id" value="1">
                                <button type="submit" class="btn btn-brand w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Repeat the .col-sm-6.col-lg-4 block above for each product -->

            </div>

            <!-- ==========================================================
                 PAGINATION (optional, only if the product list gets long)
                 OPTION A: Bootstrap .pagination component
                 OPTION B: skip pagination, just show all products on one page
                 ========================================================== -->
            <nav class="mt-4">
                <!-- <ul class="pagination justify-content-center"> ... </ul> -->
            </nav>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
