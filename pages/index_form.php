<section class="contact-form-section">
    <div class="container">
        <h2 class="section-title text-center">Get In Touch</h2>
        <div class="form-wrapper">
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Your Phone:</label>
                    <div class="input-group">
                        <select class="form-select" id="countryCode">
                            <?php include("countries_codes.php") ?>
                            <!-- Add more country codes as needed -->
                        </select>
                        <input type="text" class="form-control" id="phoneNumber" placeholder="Enter your phone number"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="15">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" placeholder="Enter the subject">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Send Message</button>
            </form>
        </div>
    </div>
</section>

<script>
document.getElementById('phoneNumber').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
});
</script>