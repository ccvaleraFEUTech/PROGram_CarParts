<?php 

$title = "Contacts";

include('../includes/header.php');
?>

<section class="contacts-section">
    <div class="contacts-container">
        <div class="contact-form">
            <form action="#" method="post" class="contact-form">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" placeholder="Your Concern" rows="5" required></textarea>
                <button type="submit" class="submit-btn">Submit Concern</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Get in Touch with Us</h3>
            <p>Have any questions or concerns about or website? Send us a message and our team will work on it as soon as possible.</p>
            <ul class="list-info">
                <li><strong>Address:</strong> 123 Juan Dela Cruz St. Brgy Sampaloc, Manila, Philippines</li>
                <li><strong>Contact Number:</strong>0912-345-6789 (Globe)</li>
                <li><strong>Email:</strong>program-support@gmail.com</li>
                <li><strong>Service Days & Hours:</strong>(Mon-Sun) 8:00 AM - 5:00 PM</li>
            </ul>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15443.032236064746!2d120.99108003551487!3d14.612853723054089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b61d9307d247%3A0x281469aa269717a5!2sSampaloc%2C%20Manila%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1784076107604!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </div>
    </div>
</section>



<?php include('../includes/footer.php'); ?>