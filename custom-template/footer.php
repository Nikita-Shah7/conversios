<footer class="footer">
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-6">
                <h5>Company</h5>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Life at Conversios</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Contact Us</h5>
                <!-- <?php
                echo esc_url(admin_url('admin-post.php')); // http://localhost/wordpress-custom/wp-admin/admin-post.php
                ?> -->
                <!-- <form action="#" method="POST"> -->
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                    <!-- This tells WordPress that when the form is submitted, it should trigger the save_contact_form function. -->
                    <input type="hidden" name="action" value="save_contact_us_form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    <p class="copyright">&copy; 2025 All Right Reserved. NIK SYSTEMS LLC</p>
</footer>

<button type="button" id="scrollToTopBtn" class="scroll-to-top-btn">↑</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.addEventListener("scroll", function() {
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        scrollToTopBtn.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    });
</script>


</body>

</html>