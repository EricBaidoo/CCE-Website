<?php
$meta = [
    'title' => 'Contact Us - CCE',
    'description' => 'Get in touch with Cross-Cutting Excellence (CCE) for partnerships, training and events.',
];
include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- HERO SECTION -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32">
        <div class="max-w-5xl mx-auto px-4">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Contact Us</span>
            </nav>
            <h1 class="text-5xl md:text-7xl font-heading font-bold mb-6 leading-none">GET IN TOUCH</h1>
            <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                We'd love to hear from you. Send us a message and our team will respond as soon as possible.
            </p>
        </div>
    </section>

    <section class="py-12 -mt-20">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- CONTACT FORM -->
            <div class="bg-white p-8 md:p-12 shadow-xl border border-gray-100">
                <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-gray-100 pb-4">Send a Message</h2>
                <form action="#" method="post" class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2" for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" required
                            class="w-full bg-gray-50 border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors outline-none text-primary font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2" for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com" required
                            class="w-full bg-gray-50 border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors outline-none text-primary font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2" for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="How can we help?" required
                            class="w-full bg-gray-50 border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors outline-none text-primary font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2" for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Tell us more about your inquiry..." required
                            class="w-full bg-gray-50 border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-secondary focus:border-secondary transition-colors outline-none text-primary font-medium resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-secondary hover:bg-orange-600 text-white font-bold uppercase tracking-widest py-4 transition-colors">
                        Submit Inquiry
                    </button>
                </form>
            </div>

            <!-- CONTACT INFO & MAP -->
            <div class="space-y-8 mt-12 lg:mt-24">
                
                <div class="flex items-start gap-6 bg-light p-8 border-l-4 border-primary">
                    <div class="w-12 h-12 shrink-0 bg-white border border-gray-200 flex items-center justify-center text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-xl text-primary mb-2">Email Address</h3>
                        <p class="text-gray-600 mb-3">crosscuttingexcellence@gmail.com</p>
                        <a href="mailto:crosscuttingexcellence@gmail.com" class="text-secondary font-bold text-xs uppercase tracking-widest hover:text-primary transition-colors">Send Email &rarr;</a>
                    </div>
                </div>

                <div class="flex items-start gap-6 bg-light p-8 border-l-4 border-primary">
                    <div class="w-12 h-12 shrink-0 bg-white border border-gray-200 flex items-center justify-center text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-xl text-primary mb-2">Phone Lines</h3>
                        <p class="text-gray-600 mb-3 leading-relaxed">Office: +233 (0) 302 799 724<br>Mobile: +233 (0) 504 042 869<br>Alt: +233 (0) 242 603 183</p>
                        <a href="tel:+233302799724" class="text-secondary font-bold text-xs uppercase tracking-widest hover:text-primary transition-colors">Call Office &rarr;</a>
                    </div>
                </div>

                <div class="flex items-start gap-6 bg-light p-8 border-l-4 border-primary">
                    <div class="w-12 h-12 shrink-0 bg-white border border-gray-200 flex items-center justify-center text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-xl text-primary mb-2">Headquarters</h3>
                        <p class="text-gray-600 leading-relaxed">
                            4th Otsew Street, South La Estates<br>
                            La Beach Road<br>
                            Opposite "Jokers", near La General Hospital<br>
                            Accra, Ghana
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
