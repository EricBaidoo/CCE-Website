<!-- Authoritative Institutional Footer -->
<footer class="bg-primary text-gray-300 mt-auto border-t-4 border-secondary relative overflow-hidden">
    <!-- Optional Background Graphic or Texture (subtle) -->
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle at 20% 150%, #E07A2A 0%, transparent 50%);"></div>

    <div class="max-w-7xl mx-auto px-6 pt-20 pb-10 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 border-b border-white/10 pb-16">
            
            <!-- Column 1: Brand & Mission -->
            <div class="col-span-1 lg:col-span-1">
                <a href="index" class="flex items-center gap-4 mb-6 group inline-flex">
                    <div class="bg-white p-1.5 rounded shadow-sm group-hover:shadow-md transition-shadow">
                        <img src="<?= htmlspecialchars($setting('site_logo', 'assets/image/logo.webp')) ?>" alt="CCE Logo" class="h-12 w-12 object-contain">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-heading font-bold text-white text-xl leading-none tracking-wide group-hover:text-secondary transition-colors">CROSS-CUTTING</span>
                        <span class="font-heading font-bold text-secondary text-xl leading-none tracking-wide mt-1">EXCELLENCE</span>
                    </div>
                </a>
                <p class="text-sm text-gray-400 mb-8 leading-relaxed font-light">
                    Transforming the secular space through faith-driven leadership, professional excellence, and the manifold wisdom of God across public and private sectors.
                </p>
                
                <!-- Social Icons -->
                <div class="flex items-center gap-4">
                    <a href="<?= htmlspecialchars($setting('social_facebook', '#')) ?>" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white hover:border-secondary transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="<?= htmlspecialchars($setting('social_twitter', '#')) ?>" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white hover:border-secondary transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                    </a>
                    <a href="<?= htmlspecialchars($setting('social_linkedin', '#')) ?>" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-secondary hover:text-white hover:border-secondary transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h4 class="font-heading font-bold text-white text-lg mb-6 tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 bg-secondary"></span> QUICK LINKS
                </h4>
                <ul class="space-y-3 text-sm font-medium tracking-wide">
                    <li><a href="index" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Home</a></li>
                    <li><a href="about" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> About CCE</a></li>
                    <li><a href="faculty" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> The 8 Faculties</a></li>
                    <li><a href="events" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Events & Programs</a></li>
                    <li><a href="news" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> News & Reports</a></li>
                    <li><a href="get-involved" class="text-gray-400 hover:text-white hover:pl-2 transition-all flex items-center gap-2"><svg class="w-3 h-3 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Get Involved</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact Info -->
            <div>
                <h4 class="font-heading font-bold text-white text-lg mb-6 tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 bg-secondary"></span> CONTACT US
                </h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li class="flex items-start gap-3 group">
                        <div class="w-8 h-8 rounded bg-white/5 border border-white/10 flex items-center justify-center shrink-0 group-hover:bg-secondary group-hover:border-secondary transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="mt-1 leading-relaxed"><?= htmlspecialchars($setting('contact_address', 'Accra, Ghana')) ?></span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded bg-white/5 border border-white/10 flex items-center justify-center shrink-0 group-hover:bg-secondary group-hover:border-secondary transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <a href="mailto:<?= htmlspecialchars($setting('contact_email', 'info@ccegh.org')) ?>" class="mt-1 hover:text-white transition-colors break-all"><?= htmlspecialchars($setting('contact_email', 'info@ccegh.org')) ?></a>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded bg-white/5 border border-white/10 flex items-center justify-center shrink-0 group-hover:bg-secondary group-hover:border-secondary transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <span class="mt-1"><?= htmlspecialchars($setting('contact_phone', '+233 123 456 789')) ?></span>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Newsletter Mockup -->
            <div>
                <h4 class="font-heading font-bold text-white text-lg mb-6 tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 bg-secondary"></span> NEWSLETTER
                </h4>
                <p class="text-sm text-gray-400 mb-4 font-light">Subscribe to get the latest news, updates and global event invitations directly in your inbox.</p>
                <form onsubmit="event.preventDefault(); alert('Newsletter subscription coming soon!');" class="mt-2 relative">
                    <input type="email" placeholder="Your Email Address" required class="w-full bg-dark/50 border border-white/20 rounded-sm py-3 px-4 text-sm text-white focus:outline-none focus:border-secondary transition-colors placeholder-gray-500">
                    <button type="submit" class="absolute right-0 top-0 bottom-0 px-4 bg-secondary text-white hover:bg-orange-600 transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-6 text-[10px] sm:text-xs text-gray-500 uppercase tracking-widest font-bold">
            
            <div class="text-center lg:text-left order-2 lg:order-1">
                &copy; <?= date('Y'); ?> CROSS-CUTTING EXCELLENCE. ALL RIGHTS RESERVED.
            </div>
            
            <!-- Prominent Developer Badge -->
            <div class="order-1 lg:order-2">
                <a href="https://e7world.tech" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2 bg-dark/80 hover:bg-dark px-5 py-2.5 rounded-full shadow-inner border border-white/5 hover:border-secondary/30 transition-all duration-300">
                    <span class="text-gray-400 normal-case tracking-normal font-medium text-xs sm:text-sm group-hover:text-gray-300 transition-colors">Powered by</span>
                    <span class="text-secondary group-hover:text-white font-black tracking-widest text-xs sm:text-sm transition-colors">E7 TECHNOLOGY SOLUTIONS</span>
                    <svg class="w-3.5 h-3.5 text-secondary group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>

            <div class="flex items-center gap-4 sm:gap-6 divide-x divide-gray-700 order-3 text-center lg:text-right">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors pl-4 sm:pl-6">Terms</a>
                <a href="admin/" class="hover:text-secondary transition-colors pl-4 sm:pl-6 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Admin
                </a>
            </div>

        </div>
    </div>
</footer>

<!-- Homepage Enhanced JavaScript -->
<script src="assets/js/homepage.js"></script>

</body>
</html>
