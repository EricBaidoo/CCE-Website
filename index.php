<?php
require_once 'config/database.php';

// Set meta data
$meta = [
    'title' => 'Cross-Cutting Excellence - Institutional Home',
    'description' => 'CCE mobilizes Christian professionals to transform secular institutions through faith-driven leadership and professional excellence.',
];

// Fetch Dynamic Data
$people = $pdo->query("SELECT * FROM people ORDER BY name ASC")->fetchAll();
// Fetch companies
$stmtCompanies = $pdo->query("SELECT * FROM companies ORDER BY name ASC");
$companies = $stmtCompanies->fetchAll(PDO::FETCH_ASSOC);

// Fetch hero slides
$stmtHero = $pdo->query("SELECT * FROM hero_slides ORDER BY slide_order ASC");
$hero_slides = $stmtHero->fetchAll(PDO::FETCH_ASSOC);
$events = $pdo->query("SELECT * FROM events WHERE is_featured = 1 OR end_date >= CURDATE() ORDER BY start_date ASC LIMIT 3")->fetchAll();
$news = $pdo->query("SELECT * FROM news ORDER BY published_at DESC LIMIT 4")->fetchAll();
?>

<!-- HEADER -->
<?php include 'header.php'; ?>

<main id="main-content" role="main" class="flex-grow bg-light">
    
    <!-- MAIN HERO (Dynamic Carousel) -->
    <section class="relative bg-dark border-b-4 border-secondary overflow-hidden h-[85vh] lg:h-[35rem]">
        <div id="hero-carousel" class="relative h-full w-full">
            <?php foreach ($hero_slides as $index => $slide): ?>
            <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out flex flex-col lg:flex-row bg-dark <?= $index === 0 ? 'opacity-100 z-10 pointer-events-auto' : 'opacity-0 z-0 pointer-events-none' ?>">
                
                <!-- Image Column (Background on Mobile, Right Column on Desktop) -->
                <div class="absolute inset-0 lg:static lg:w-1/2 h-full lg:border-l-4 border-secondary z-10 order-1 lg:order-2">
                    <img src="<?= htmlspecialchars($slide['image_path']) ?>" alt="<?= htmlspecialchars($slide['title']) ?>" class="absolute inset-0 w-full h-full object-cover grayscale opacity-40 lg:opacity-80 mix-blend-luminosity lg:mix-blend-normal">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/80 to-transparent lg:bg-gradient-to-l lg:from-dark lg:to-transparent"></div>
                </div>

                <!-- Content Column (Foreground on Mobile, Left Column on Desktop) -->
                <div class="w-full lg:w-1/2 p-6 md:p-16 flex flex-col justify-end lg:justify-center h-full bg-transparent lg:bg-dark relative z-20 pb-28 lg:pb-16 order-2 lg:order-1">
                    <div class="max-w-xl">
                        <div class="inline-block border-l-4 border-secondary pl-4 mb-4 lg:mb-6">
                            <span class="text-secondary font-bold tracking-widest uppercase text-xs lg:text-sm">Official Framework</span>
                        </div>
                        <h1 class="font-heading font-bold text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-tight mb-4 lg:mb-6 uppercase tracking-wide">
                            <?= htmlspecialchars($slide['title']) ?>
                        </h1>
                        <p class="text-gray-300 text-base md:text-xl leading-relaxed mb-8 lg:mb-10 font-light border-l border-white/20 pl-4 lg:pl-6">
                            <?= htmlspecialchars($slide['description']) ?>
                        </p>
                        <?php if(!empty($slide['button_text']) && !empty($slide['button_link'])): ?>
                        <div class="flex">
                            <a href="<?= htmlspecialchars($slide['button_link']) ?>" class="bg-secondary hover:bg-orange-600 text-white font-bold py-3 px-6 lg:py-4 lg:px-8 uppercase tracking-widest text-xs lg:text-sm transition-colors text-center shadow-lg">
                                <?= htmlspecialchars($slide['button_text']) ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- Carousel Navigation Controls -->
        <?php if(count($hero_slides) > 1): ?>
        <div class="absolute bottom-8 left-8 md:left-16 flex gap-4 z-20">
            <button onclick="prevSlide()" class="bg-white/10 hover:bg-secondary text-white p-3 rounded-full backdrop-blur transition-colors border border-white/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextSlide()" class="bg-white/10 hover:bg-secondary text-white p-3 rounded-full backdrop-blur transition-colors border border-white/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
        <div class="absolute bottom-8 right-8 flex gap-2 z-20">
            <?php foreach ($hero_slides as $index => $slide): ?>
                <button onclick="goToSlide(<?= $index ?>)" class="carousel-dot w-3 h-3 rounded-full bg-white/30 hover:bg-secondary transition-colors" data-index="<?= $index ?>"></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <script>
        let currentSlide = 0;
        const carousel = document.getElementById('hero-carousel');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalSlides = <?= count($hero_slides) ?>;
        
        function updateCarousel() {
            const slides = document.querySelectorAll('.carousel-slide');
            slides.forEach((slide, index) => {
                if(index === currentSlide) {
                    slide.classList.replace('opacity-0', 'opacity-100');
                    slide.classList.replace('z-0', 'z-10');
                    slide.classList.replace('pointer-events-none', 'pointer-events-auto');
                } else {
                    slide.classList.replace('opacity-100', 'opacity-0');
                    slide.classList.replace('z-10', 'z-0');
                    slide.classList.replace('pointer-events-auto', 'pointer-events-none');
                }
            });
            dots.forEach((dot, index) => {
                if(index === currentSlide) {
                    dot.classList.replace('bg-white/30', 'bg-secondary');
                } else {
                    dot.classList.replace('bg-secondary', 'bg-white/30');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        // Auto advance
        if(totalSlides > 1) {
            setInterval(nextSlide, 8000);
            updateCarousel(); // Initialize dots
        }
    </script>

    <!-- MESSAGE FROM THE GENERAL COORDINATOR -->
    <section class="py-12 md:py-24 bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-light border border-gray-200 p-6 sm:p-10 md:p-16 shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16">
                    
                    <!-- Left Sidebar (Portrait & Title) -->
                    <div class="lg:col-span-4 flex flex-col items-center text-center lg:items-start lg:text-left">
                        <div class="w-40 h-40 md:w-64 md:h-64 mb-6 border-4 border-white shadow-lg overflow-hidden shrink-0 mx-auto lg:mx-0">
                            <img src="<?= htmlspecialchars($setting('coordinator_image', 'assets/image/pics/coordinator.webp')) ?>" alt="<?= htmlspecialchars($setting('coordinator_name')) ?>" class="w-full h-full object-cover" onerror="this.src='assets/image/hero/001-w800.webp';">
                        </div>
                        <div class="border-t-2 border-secondary pt-4 w-full max-w-xs mx-auto lg:mx-0">
                            <h2 class="text-primary font-heading font-bold text-2xl uppercase tracking-widest leading-tight mb-1">
                                <?php
                                $coordName = $setting('coordinator_name', 'Coordinator Name');
                                $nameParts = explode(' ', $coordName);
                                $firstName = array_shift($nameParts);
                                $otherNames = implode(' ', $nameParts);
                                ?>
                                <span class="block"><?= htmlspecialchars($firstName) ?></span>
                                <?php if($otherNames): ?>
                                <span class="block"><?= htmlspecialchars($otherNames) ?></span>
                                <?php endif; ?>
                            </h2>
                            <p class="text-sm text-gray-500 font-bold tracking-widest uppercase">The General Coordinator</p>
                        </div>
                    </div>
                    
                    <!-- Right Content (Message) -->
                    <div class="lg:col-span-8 relative">
                        <div class="relative mb-8 md:mb-10 pl-2 md:pl-0">
                            <svg class="absolute -top-4 -left-2 md:-top-6 md:-left-8 w-12 h-12 md:w-16 md:h-16 text-secondary/20" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <p class="relative z-10 text-xl md:text-3xl text-primary leading-relaxed md:leading-tight font-light italic border-b border-gray-200 pb-6 md:pb-8">
                                "<?= htmlspecialchars($setting('coordinator_quote')) ?>"
                            </p>
                        </div>

                        <div class="space-y-6 text-gray-700 leading-relaxed text-base md:text-lg">
                            <?= $setting('coordinator_message') ?>
                        </div>

                        <div class="bg-primary text-white p-6 md:p-8 mt-8 md:mt-10 shadow-md relative overflow-hidden">
                            <div class="absolute right-0 bottom-0 opacity-10">
                                <svg class="w-24 h-24 md:w-32 md:h-32 transform translate-x-4 translate-y-4 md:translate-x-8 md:translate-y-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l-1.3 1.3 9.8 9.7h-20.5v2h20.5l-9.8 9.7 1.3 1.3 12-12z"/></svg>
                            </div>
                            <p class="relative z-10 font-medium text-base md:text-lg leading-relaxed text-center md:text-left">
                                We welcome you with open arms to come labour with and for the Lord Jesus. You will be trained and equipped to make our nations godly and prosperous for Jesus!
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- FACULTY ENDEAVOURS (Rigid Grid) -->
    <section class="py-20 bg-light border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end border-b-2 border-primary pb-4 mb-12">
                <h2 class="text-primary font-heading font-bold text-3xl md:text-4xl">FACULTIES ENDEAVOURS</h2>
                <a href="faculty" class="hidden md:block text-secondary font-bold text-sm uppercase tracking-widest hover:text-primary">View Frameworks</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 border border-gray-200 bg-white">
                <?php
                $faculties = [
                    ['id'=>'gad', 'icon'=>'GAD', 'name'=>'Governance & Development', 'desc'=>'Strengthening public policy and institutional capacity.'],
                    ['id'=>'eat', 'icon'=>'EAT', 'name'=>'Education & Training', 'desc'=>'Empowering educators to formulate robust systems.'],
                    ['id'=>'sat', 'icon'=>'SAT', 'name'=>'Science & Technology', 'desc'=>'Promoting ethical innovation and research.'],
                    ['id'=>'paa', 'icon'=>'PAA', 'name'=>'Philosophy & Arts', 'desc'=>'Integrating culture to shape global worldviews.'],
                    ['id'=>'fab', 'icon'=>'FAB', 'name'=>'Finance & Business', 'desc'=>'Driving economies with competence and godliness.'],
                    ['id'=>'raf', 'icon'=>'RAF', 'name'=>'Relationship & Family', 'desc'=>'Building strong godly families and relationships.'],
                    ['id'=>'maa', 'icon'=>'MAA', 'name'=>'Missions & Apologetics', 'desc'=>'Engaging culture and defending the faith.'],
                    ['id'=>'cam', 'icon'=>'CAM', 'name'=>'Communication & Media', 'desc'=>'Communicating truth in the global media space.'],
                ];
                foreach ($faculties as $index => $fac): 
                    // Add borders for strict grid look (2 rows of 4)
                    $borderRight = ($index % 4 === 3) ? "" : "lg:border-r";
                    $borderBottom = ($index > 3) ? "" : "border-b";
                    $borderClass = "border-b md:border-b-0 md:border-r border-gray-200 {$borderRight} {$borderBottom}";
                ?>
                <div class="p-6 hover:bg-gray-50 transition-colors <?= $borderClass ?>">
                    <img src="assets/image/FE-icons/<?= htmlspecialchars($fac['icon']) ?>.svg" alt="<?= htmlspecialchars($fac['name']) ?>" class="w-12 h-12 mb-4" onerror="this.style.display='none'">
                    <h3 class="text-lg font-heading font-bold text-primary mb-2 uppercase leading-tight"><?= htmlspecialchars($fac['name']) ?></h3>
                    <p class="text-gray-600 font-light text-sm mb-4 leading-snug"><?= htmlspecialchars($fac['desc']) ?></p>
                    <a href="faculty#<?= $fac['id'] ?>" class="text-primary font-bold text-xs uppercase tracking-widest hover:text-secondary flex items-center gap-1 mt-auto">
                        View Details <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- NEWS AND MEDIA GRID -->
    <section class="py-20 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
                <!-- News Column -->
                <div class="xl:col-span-2">
                    <div class="border-b-2 border-primary pb-4 mb-8 flex justify-between items-end">
                        <h2 class="text-primary font-heading font-bold text-3xl">LATEST NEWS & REPORTS</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <?php foreach ($news as $index => $article): ?>
                        <article class="group">
                            <div class="h-48 overflow-hidden bg-gray-100 mb-4 border border-gray-200">
                                <img src="<?= htmlspecialchars($article['featured_image']) ?>" alt="" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity">
                            </div>
                            <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-2 flex justify-between">
                                <span><?= date('d M Y', strtotime($article['published_at'])) ?></span>
                                <span class="text-gray-400 border-l border-gray-300 pl-2"><?= htmlspecialchars($article['author']) ?></span>
                            </div>
                            <h3 class="font-heading font-bold text-xl mb-2 text-primary group-hover:text-secondary transition-colors line-clamp-2">
                                <a href="news?id=<?= urlencode($article['id']) ?>"><?= htmlspecialchars($article['title']) ?></a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?= htmlspecialchars($article['excerpt']) ?></p>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Upcoming Events Column (Sidebar style) -->
                <div class="xl:col-span-1 bg-light p-8 border border-gray-200">
                    <h2 class="text-primary font-heading font-bold text-2xl mb-6 border-b-2 border-secondary pb-4">UPCOMING EVENTS</h2>
                    <div class="space-y-6">
                        <?php foreach ($events as $ev): ?>
                        <div class="border-l-4 border-primary pl-4 py-1">
                            <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-1">
                                <?= htmlspecialchars($ev['date_display']) ?> &bull; <?= htmlspecialchars($ev['location']) ?>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-primary mb-1">
                                <a href="event?id=<?= urlencode($ev['id']) ?>" class="hover:text-secondary"><?= htmlspecialchars($ev['title']) ?></a>
                            </h3>
                            <p class="text-xs text-gray-500 tracking-wider uppercase mt-1 line-clamp-1"><?= htmlspecialchars($person['company'] ?? '') ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
                        <?php if(empty($events)): ?>
                            <p class="text-gray-500 italic">No public events scheduled at this time.</p>
                        <?php endif; ?>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="events" class="text-primary font-bold text-sm uppercase tracking-widest hover:text-secondary flex items-center gap-2">
                            View Global Calendar <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LEADERSHIP & NETWORK (People) -->
    <section class="py-20 bg-light border-b border-gray-200 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 mb-12">
            <div class="flex justify-between items-end border-b-2 border-primary pb-4">
                <h2 class="text-primary font-heading font-bold text-3xl md:text-4xl">GLOBAL NETWORK & LEADERSHIP</h2>
                <a href="people" class="hidden md:block text-secondary font-bold text-sm uppercase tracking-widest hover:text-primary">View Full Roster</a>
            </div>
        </div>
        
        <div class="relative w-full overflow-hidden py-4">
            
            <!-- Infinite Marquee Track -->
            <div class="flex gap-8 animate-marquee hover:[animation-play-state:paused] whitespace-nowrap items-center w-max px-8">
                <?php 
                // Duplicate array to ensure seamless marquee loop
                $marqueePeople = array_merge($people, $people, $people);
                foreach ($marqueePeople as $person): 
                ?>
                <a href="person?id=<?= htmlspecialchars($person['id']) ?>" class="flex items-center gap-6 bg-white p-6 border border-gray-200 hover:border-secondary transition-colors group cursor-pointer shadow-sm hover:shadow-md w-80 shrink-0">
                    <div class="w-20 h-20 shrink-0 border-2 border-gray-100 overflow-hidden group-hover:border-secondary transition-colors">
                        <?php if (!empty($person['image']) || !empty($person['photo'])): ?>
                            <?php $img = !empty($person['image']) ? $person['image'] : $person['photo']; ?>
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($person['name'] ?? '') ?>" class="w-full h-full object-contain bg-white transition-all">
                        <?php else: ?>
                            <svg class="w-10 h-10 text-gray-300 m-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <?php endif; ?>
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="font-heading font-bold text-lg text-primary truncate"><?= htmlspecialchars($person['name'] ?? '') ?></h3>
                        <p class="text-secondary text-xs uppercase tracking-widest font-bold mb-1 truncate"><?= htmlspecialchars($person['role'] ?? 'CCE Member') ?></p>
                        <?php if (!empty($person['company'])): ?>
                            <p class="text-gray-500 text-sm italic truncate"><?= htmlspecialchars($person['company']) ?></p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- INSTITUTIONAL PARTNERS (Companies) -->
    <section class="py-20 bg-light border-t border-gray-200 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 mb-12">
            <div class="flex justify-between items-end border-b-2 border-primary pb-4">
                <h2 class="text-primary font-heading font-bold text-3xl md:text-4xl">CCE CORPORATE BUSINESS ALLIANCES</h2>
                <a href="companies" class="hidden md:block text-secondary font-bold text-sm uppercase tracking-widest hover:text-primary">View All Alliances</a>
            </div>
        </div>
        
        <div class="relative w-full overflow-hidden py-4">
            
            <!-- Infinite Marquee Track -->
            <div class="flex gap-16 md:gap-24 animate-marquee hover:[animation-play-state:paused] whitespace-nowrap items-center w-max px-8">
                <?php 
                // Duplicate array to ensure seamless marquee loop
                $marqueeCompanies = array_merge($companies, $companies, $companies);
                foreach ($marqueeCompanies as $company): 
                ?>
                <a href="company?id=<?= htmlspecialchars($company['id']) ?>" class="inline-flex flex-col justify-center items-center w-40 md:w-48 shrink-0 hover:scale-105 transition-transform duration-300 gap-4">
                    <img src="<?= htmlspecialchars($company['logo'] ?? 'assets/image/companies-and-people/cce-logo.webp') ?>" alt="<?= htmlspecialchars($company['name'] ?? 'Company') ?>" class="max-h-16 md:max-h-20 w-full object-contain">
                    <span class="text-primary font-bold text-xs uppercase tracking-widest text-center whitespace-normal leading-tight"><?= htmlspecialchars($company['name'] ?? '') ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<!-- FOOTER -->
<?php include 'footer.php'; ?>
