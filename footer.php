<!-- Authoritative Institutional Footer -->
<footer class="bg-primary text-gray-300 mt-auto border-t-4 border-secondary">
    <div class="max-w-7xl mx-auto px-4 pt-16 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12 border-b border-white/20 pb-12">
            <!-- Brand Column -->
            <div class="col-span-1 lg:col-span-1 border-b md:border-b-0 md:border-r border-white/20 pr-0 md:pr-8">
                <a href="index" class="flex items-center gap-4 mb-6">
                    <img src="<?= htmlspecialchars($setting('site_logo', 'assets/image/logo.webp')) ?>" alt="CCE Logo" class="h-14 w-14 object-contain bg-white p-1">
                    <div class="flex flex-col">
                        <span class="font-heading font-bold text-white text-xl leading-none tracking-wide">CROSS-CUTTING</span>
                        <span class="font-heading font-bold text-secondary text-xl leading-none tracking-wide mt-1">EXCELLENCE</span>
                    </div>
                </a>
                <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                    Building the capacity of professionals to transform spheres of endeavour with the manifold wisdom of God across public and private sectors.
                </p>
                <div class="text-xs font-bold tracking-widest uppercase text-white bg-dark inline-block px-3 py-1 border-l-2 border-secondary">
                    Official Mandate
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:pl-4">
                <h4 class="font-heading font-bold text-white text-lg mb-6 tracking-wider border-b-2 border-secondary inline-block pb-1">QUICK LINKS</h4>
                <ul class="space-y-4 text-sm font-medium tracking-wide">
                    <li><a href="index" class="hover:text-secondary transition-colors uppercase">Home</a></li>
                    <li><a href="about" class="hover:text-secondary transition-colors uppercase">About Us</a></li>
                    <li><a href="faculty" class="hover:text-secondary transition-colors uppercase">Faculties</a></li>
                    <li><a href="events" class="hover:text-secondary transition-colors uppercase">Global Events</a></li>
                    <li><a href="news" class="hover:text-secondary transition-colors uppercase">News & Reports</a></li>
                    <li><a href="resources" class="hover:text-secondary transition-colors uppercase">Resources</a></li>
                </ul>
            </div>

            <!-- Faculty Areas -->
            <div>
            <div>
                <h3 class="text-lg font-heading font-bold mb-6 text-white uppercase tracking-wider border-b border-gray-800 pb-2">Quick Links</h3>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li><a href="about" class="hover:text-secondary transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> About CCE</a></li>
                    <li><a href="faculty" class="hover:text-secondary transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Our Faculties</a></li>
                    <li><a href="events" class="hover:text-secondary transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Events Calendar</a></li>
                    <li><a href="news" class="hover:text-secondary transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> News & Updates</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-heading font-bold mb-6 text-white uppercase tracking-wider border-b border-gray-800 pb-2">Contact Us</h3>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-secondary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span><?= htmlspecialchars($setting('contact_address', 'Accra, Ghana')) ?></span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-secondary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:<?= htmlspecialchars($setting('contact_email', 'info@ccegh.org')) ?>" class="hover:text-secondary transition-colors"><?= htmlspecialchars($setting('contact_email', 'info@ccegh.org')) ?></a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-secondary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span><?= htmlspecialchars($setting('contact_phone', '+233 123 456 789')) ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-xs text-gray-400 uppercase tracking-widest font-bold">
            <div>
                &copy; <?= date('Y'); ?> CROSS-CUTTING EXCELLENCE. ALL RIGHTS RESERVED.
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors border-l border-white/20 pl-6">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>

<!-- Homepage Enhanced JavaScript (Keeping existing logic if any) -->
<script src="assets/js/homepage.js"></script>

</body>
</html>
