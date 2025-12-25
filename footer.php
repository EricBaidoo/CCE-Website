<?php
// =============================
// CCE Professional Footer Component
// =============================
?>
<footer class="professional-footer">
    <!-- Footer styling moved into assets/css/global.css -->
    <div class="container">
        <div class="footer-main">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <img src="assets/image/logo.jpeg" alt="CCE Logo" class="footer-logo">
                        <h3 class="footer-brand-name">CCE</h3>
                        <p class="footer-description">
                            Building the capacity of Christian professionals to transform their spheres of endeavour with the manifold wisdom of God.
                        </p>
                        <div class="footer-motto">
                            <span class="motto-text">Inspired • Intentional • Intense</span>
                        </div>
                    </div>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="faculty.php">Faculty</a></li>
                            <li><a href="events.php">Events</a></li>
                            <li><a href="news.php">News</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Faculty Areas -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Faculty Areas</h4>
                        <ul class="footer-links">
                            <li><a href="faculty.php#gad">Governance & Development</a></li>
                            <li><a href="faculty.php#eat">Education & Training</a></li>
                            <li><a href="faculty.php#sat">Science & Technology</a></li>
                            <li><a href="faculty.php#paa">Philosophy & Arts</a></li>
                            <li><a href="faculty.php#fab">Finance & Business</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Contact Info / Reach Us -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Contact & Reach</h4>
                        <div class="footer-contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="contact-details">
                                    <strong>Office</strong>
                                    <span>Accra, Ghana</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div class="contact-details">
                                    <strong>Email</strong>
                                    <span>hello@crosscuttingexcellence.org</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div class="contact-details">
                                    <strong>Phone</strong>
                                    <span>+233 24 555 0123</span>
                                </div>
                            </div>
                        </div>
                        <div class="footer-contact-cta">
                            <a href="contact.php?source=footer" class="hero-btn btn-contact" aria-label="Contact CCE">Contact CCE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> Cross-Cutting Excellence (CCE). All rights reserved.</p>
                <p class="powered-by">Powered by <a href="#" class="e7-link">E7 Technology Solutions</a></p>
            </div>
            <div class="footer-social">
                <span class="social-title">Follow Us:</span>
                    <div class="social-links">
                    <a href="https://facebook.com/" class="social-link" aria-label="Facebook" title="Facebook" target="_blank" rel="noopener noreferrer">
                        <img src="assets/icons/facebook.svg" class="social-icon" alt="Facebook logo">
                        <span class="sr-only">Facebook (opens in a new tab)</span>
                    </a>
                    <a href="https://twitter.com/" class="social-link" aria-label="Twitter" title="Twitter" target="_blank" rel="noopener noreferrer">
                        <img src="assets/icons/twitter.svg" class="social-icon" alt="Twitter logo">
                        <span class="sr-only">Twitter (opens in a new tab)</span>
                    </a>
                    <a href="https://linkedin.com/" class="social-link" aria-label="LinkedIn" title="LinkedIn" target="_blank" rel="noopener noreferrer">
                        <img src="assets/icons/linkedin.svg" class="social-icon" alt="LinkedIn logo">
                        <span class="sr-only">LinkedIn (opens in a new tab)</span>
                    </a>
                    <a href="https://instagram.com/" class="social-link" aria-label="Instagram" title="Instagram" target="_blank" rel="noopener noreferrer">
                        <img src="assets/icons/instagram.svg" class="social-icon" alt="Instagram logo">
                        <span class="sr-only">Instagram (opens in a new tab)</span>
                    </a>
                    <a href="https://youtube.com/" class="social-link" aria-label="YouTube" title="YouTube" target="_blank" rel="noopener noreferrer">
                        <img src="assets/icons/youtube.svg" class="social-icon" alt="YouTube logo">
                        <span class="sr-only">YouTube (opens in a new tab)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer scripts removed: now loaded in header.php -->
<!-- Footer Enhancement Script -->
<script>
    // Back to top functionality
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        const backToTopBtn = document.querySelector('.btn-back-to-top');
        if (window.scrollY > 300) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.transform = 'translateY(0)';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.transform = 'translateY(20px)';
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
