<?php
// =============================
// CCE Professional Footer Component
// =============================
?>
<footer class="professional-footer">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="footer-main">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <div class="footer-brand mb-3">
                            <img src="/CCE/assets/image/logo.jpeg" alt="CCE Logo" class="footer-logo">
                            <h3 class="footer-brand-name">CCE</h3>
                        </div>
                        <p class="footer-description">
                            Building the capacity of Christian professionals to transform their spheres of endeavour with the manifold wisdom of God.
                        </p>
                        <div class="footer-motto">
                            <span class="motto-text">Inspired • Intentional • Intense</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="/CCE/index.php">Home</a></li>
                            <li><a href="/CCE/about.php">About Us</a></li>
                            <li><a href="/CCE/faculty.php">Faculty</a></li>
                            <li><a href="/CCE/events.php">Events</a></li>
                            <li><a href="/CCE/news.php">News</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Faculty Areas -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Faculty Areas</h4>
                        <ul class="footer-links">
                            <li><a href="/CCE/faculty.php#gad">Governance & Development</a></li>
                            <li><a href="/CCE/faculty.php#eat">Education & Training</a></li>
                            <li><a href="/CCE/faculty.php#sat">Science & Technology</a></li>
                            <li><a href="/CCE/faculty.php#paa">Philosophy & Arts</a></li>
                            <li><a href="/CCE/faculty.php#fab">Finance & Business</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Contact Info</h4>
                        <div class="footer-contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div class="contact-details">
                                    <strong>Email</strong>
                                    <span>info@cce-global.org</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div class="contact-details">
                                    <strong>Phone</strong>
                                    <span>+233 (0) 123 456 789</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="contact-details">
                                    <strong>Address</strong>
                                    <span>Accra, Ghana</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Divider -->
        <div class="footer-divider"></div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> Cross-Cutting Excellence (CCE). All rights reserved.</p>
                        <p class="powered-by">Powered by <a href="#" class="e7-link">E7 Technology Solutions</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social">
                        <span class="social-title">Follow Us:</span>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <div class="back-to-top">
            <button class="btn-back-to-top" onclick="scrollToTop()">
                <i class="fas fa-chevron-up"></i>
            </button>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

    // Footer links hover animation
    document.addEventListener('DOMContentLoaded', function() {
        const footerLinks = document.querySelectorAll('.footer-links a');
        footerLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>

</body>
</html>
