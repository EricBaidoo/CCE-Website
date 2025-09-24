<?php
// =============================
// CCE Professional Footer Component
// =============================
?>
<footer class="professional-footer">
    <style>
        .professional-footer {
            background: var(--cce-black);
            color: var(--cce-white);
            padding: 3.5rem 0 2rem 0;
            font-size: 1rem;
            font-family: 'Montserrat', 'Arial', sans-serif;
            box-shadow: 0 -2px 24px rgba(0,0,0,0.10);
            letter-spacing: 0.01em;
            border-top: 4px solid var(--cce-orange);
        }
        .footer-logo {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            margin-bottom: 0.75rem;
            box-shadow: 0 4px 16px rgba(255,152,0,0.13);
            border: 2px solid var(--cce-orange);
            object-fit: cover;
            background: #fff;
            transition: box-shadow 0.2s;
        }
        .footer-logo:hover {
            box-shadow: 0 8px 32px rgba(255,152,0,0.18);
        }
        .footer-brand-name {
            color: var(--cce-orange);
            font-size: 1.7rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-family: 'Montserrat', 'Arial', sans-serif;
        }
        .footer-title {
            color: var(--cce-orange);
            font-size: 1.18rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            border-bottom: 2px solid var(--cce-orange);
            padding-bottom: 0.3rem;
            margin-top: 0.5rem;
        }
        .footer-links {
            padding-left: 0;
            list-style: none;
        }
        .footer-links a {
            color: var(--cce-white);
            text-decoration: none;
            display: block;
            padding: 0.25rem 0.5rem;
            font-weight: 500;
            transition: color 0.2s, background 0.2s, transform 0.2s;
            border-radius: 5px;
            font-size: 1.02rem;
        }
        .footer-links a:hover {
            color: var(--cce-black);
            background: var(--cce-orange);
            transform: translateX(7px);
        }
        .footer-divider {
            border-top: 2px solid var(--cce-orange);
            margin: 2.5rem 0 2rem 0;
            opacity: 0.8;
        }
        .footer-bottom {
            font-size: 1rem;
            color: var(--cce-white);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--cce-orange);
        }
        .footer-copyright p {
            margin-bottom: 0.2rem;
            font-size: 0.97rem;
            opacity: 0.85;
        }
        .powered-by a {
            color: var(--cce-orange);
            text-decoration: underline;
            font-weight: 600;
            transition: color 0.2s;
            letter-spacing: 0.02em;
        }
        .powered-by a:hover {
            color: var(--cce-black);
            background: var(--cce-orange);
            border-radius: 3px;
            padding: 0.1rem 0.3rem;
        }
        .footer-social {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .footer-social .social-title {
            font-weight: 600;
            margin-right: 0.7rem;
            color: var(--cce-orange);
            font-size: 1rem;
            letter-spacing: 0.02em;
        }
        .footer-social .social-link {
            color: var(--cce-orange);
            font-size: 1.5rem;
            margin-right: 0.7rem;
            transition: color 0.2s, background 0.2s, transform 0.2s, box-shadow 0.2s;
            border-radius: 50%;
            padding: 0.3rem;
            background: var(--cce-black);
            border: 2px solid var(--cce-orange);
            box-shadow: 0 2px 8px rgba(255,152,0,0.10);
            outline: none;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .footer-social .social-link:hover {
            color: var(--cce-white);
            background: var(--cce-orange);
            transform: scale(1.18);
            border-color: var(--cce-black);
            box-shadow: 0 4px 16px rgba(255,152,0,0.18);
            text-decoration: none !important;
        }
        .footer-contact-info .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.7rem;
            gap: 0.7rem;
        }
        .footer-contact-info .contact-item i {
            color: var(--cce-orange);
            font-size: 1.1rem;
            margin-top: 0.1rem;
        }
        .footer-contact-info .contact-details strong {
            font-weight: 600;
            color: var(--cce-orange);
            font-size: 0.98rem;
        }
        .footer-contact-info .contact-details span {
            display: block;
            font-size: 0.97rem;
            color: var(--cce-white);
            opacity: 0.85;
        }
        .footer-motto {
            margin-top: 0.7rem;
            font-style: italic;
            color: var(--cce-orange);
            font-size: 1.05rem;
            font-weight: 500;
            letter-spacing: 0.03em;
        }
        @media (max-width: 991px) {
            .footer-main .row > div {
                margin-bottom: 2rem;
            }
            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
        @media (max-width: 575px) {
            .professional-footer {
                padding: 2rem 0 1rem 0;
                font-size: 0.97rem;
            }
            .footer-logo {
                width: 38px;
                height: 38px;
            }
            .footer-brand-name {
                font-size: 1.15rem;
            }
            .footer-title {
                font-size: 1rem;
            }
            .footer-social .social-title {
                font-size: 0.97rem;
            }
        }
    </style>
    <div class="container">
        <div class="footer-main">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <img src="/CCE/assets/image/logo.jpeg" alt="CCE Logo" class="footer-logo">
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
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> Cross-Cutting Excellence (CCE). All rights reserved.</p>
                <p class="powered-by">Powered by <a href="#" class="e7-link">E7 Technology Solutions</a></p>
            </div>
            <div class="footer-social">
                <span class="social-title">Follow Us:</span>
                <div class="social-links">
                    <a href="https://facebook.com/" class="social-link" aria-label="Facebook" title="Facebook" target="_blank" rel="noopener">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/" class="social-link" aria-label="Twitter" title="Twitter" target="_blank" rel="noopener">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://linkedin.com/" class="social-link" aria-label="LinkedIn" title="LinkedIn" target="_blank" rel="noopener">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://instagram.com/" class="social-link" aria-label="Instagram" title="Instagram" target="_blank" rel="noopener">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/" class="social-link" aria-label="YouTube" title="YouTube" target="_blank" rel="noopener">
                        <i class="fab fa-youtube"></i>
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
