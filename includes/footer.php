<!-- ============================================
     FOOTER (shared across all pages)
     ============================================ -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Group logo + name again, footer style -->
                <h5>PK Auto Parts</h5>
                <p>Group members: Member 1, Member 2, Member 3...</p>
            </div>
            <div class="col-md-4">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="products.php">Products</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact Info</h6>
                <p>Placeholder address / phone / email</p>
            </div>
        </div>

        <!-- REQUIRED disclaimer for the school project -->
        <p class="disclaimer text-center">
            This website is a student project for CCS0043 and is for
            educational purposes only. No real transactions take place.
        </p>
    </div>
</footer>

<!-- JS at the bottom so pages load faster -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Philippine Region/Province/City data + cascading dropdown behavior.
     Only pages that have <select id="region/province/city"> will actually
     use these; on other pages they just load and do nothing. -->
<script src="assets/js/ph-locations-data.js"></script>
<script src="assets/js/location-dropdowns.js"></script>
</body>
</html>
