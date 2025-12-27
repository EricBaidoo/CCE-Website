<?php
$meta = [
    'title' => 'Contact CCE',
    'description' => 'Get in touch with Cross-Cutting Excellence (CCE) for partnerships, training and events.',
];
include 'header.php';
?>
<main class="contact-page">
    <section class="page-header">
        <h1 class="page-title">Get in Touch</h1>
        <p class="page-subtitle">We'd love to hear from you. Send us a message and we'll respond as soon as possible</p>
    </section>

    <section class="contact-container">
        <div class="contact-form-wrapper">
            <form class="contact-form" action="#" method="post">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="How can we help?" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Tell us more about your inquiry..." required></textarea>
                </div>
                <button type="submit" class="btn-submit">Send Message</button>
            </form>
        </div>
        
        <div class="contact-info-wrapper">
            <div class="contact-info-card">
                <div class="contact-info-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="contact-info-title">Email</h3>
                <p class="contact-info-text">crosscuttingexcellence@gmail.com</p>
                <a href="mailto:crosscuttingexcellence@gmail.com" class="contact-info-link">Send email</a>
            </div>

            <div class="contact-info-card">
                <div class="contact-info-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="contact-info-title">Location</h3>
                <p class="contact-info-text">Accra, Ghana</p>
            </div>

            <div class="contact-info-card">
                <div class="contact-info-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="contact-info-title">Social</h3>
                <p class="contact-info-text">@cce_network</p>
            </div>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
