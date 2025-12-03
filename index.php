<?php
// Set meta data for this page
$meta = [
    'title' => 'Cross-Cutting Excellence - Transforming Secular Institutions with Christian Professional Excellence',
    'description' => 'CCE mobilizes Christian professionals to transform secular institutions through faith-driven leadership, training, and the application of godly wisdom in professional spaces.',
    'image' => '/CCE/assets/image/hero/001-w800.jpg',
    'url' => 'https://crosscuttingexcellence.org',
    'type' => 'website',
    'json_ld' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => "Cross-Cutting Excellence",
        "description" => "Mobilizing Christian professionals to transform secular institutions through faith-driven excellence",
        "url" => "https://crosscuttingexcellence.org",
        "logo" => "assets/image/cce-logo.png",
        "sameAs" => [
            "https://twitter.com/cce_org",
            "https://linkedin.com/company/cross-cutting-excellence"
        ]
    ])
];
?>

<!-- HEADER -->
<?php include 'header.php'; ?>



<!-- MAIN CONTENT -->
<main id="main-content" role="main">
    <!-- HERO SECTION -->
    <!-- Hero Section -->
    <section class="hero-slider" id="heroSlider">
        <!-- Slide 1 -->
        <div class="slide active slide-1">
            <div class="hero-content">
                <div class="container">
                    <span class="hero-badge">Transforming Professions</span>
                    <h1 class="hero-title">
                        Empowering Excellence
                        <span class="accent">Cross-Cutting Impact</span>
                    </h1>
                    <p class="hero-description">
                        Empowering Christian professionals to transform secular institutions through godly wisdom and excellence.
                    </p>
                    
                    <div class="hero-buttons">
                        <a href="get-involved.php" class="btn-primary">
                            Join Our Mission
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="about.php" class="btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide slide-2">
            <div class="hero-content">
                <div class="container">
                    <span class="hero-badge">Community Impact</span>
                    <h1 class="hero-title">
                        Building Leaders
                        <span class="accent">Transforming Lives</span>
                    </h1>
                    
                    <div class="hero-testimonial">
                        <blockquote>
                            <p>"CCE has transformed how I approach leadership in my industry with both professional excellence and unwavering faith principles."</p>
                            <cite>
                                <strong>Dr. Sarah Johnson</strong>
                                <span>Healthcare Executive</span>
                            </cite>
                        </blockquote>
                    </div>
                    
                    <div class="hero-buttons">
                        <a href="events.php" class="btn-primary">
                            Upcoming Events
                            <i class="fas fa-calendar"></i>
                        </a>
                        <a href="faculty.php" class="btn-secondary">Meet Faculty</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide slide-3">
            <div class="hero-content">
                <div class="container">
                    <span class="hero-badge">Your Journey Starts Here</span>
                    <h1 class="hero-title">
                        Shape Tomorrow
                        <span class="accent">Lead with Purpose</span>
                    </h1>
                    
                    <div class="hero-features">
                        <div class="feature">
                            <i class="fas fa-star"></i>
                            <span>Excellence Recognition</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Proven Impact</span>
                        </div>
                    </div>
                    
                    <div class="hero-buttons">
                        <a href="get-involved.php" class="btn-primary">
                            Start Your Journey
                            <i class="fas fa-rocket"></i>
                        </a>
                        <a href="contact.php" class="btn-secondary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indicators -->
        <div class="slide-indicators">
            <span class="indicator active" onclick="currentSlide(1)"></span>
            <span class="indicator" onclick="currentSlide(2)"></span>
            <span class="indicator" onclick="currentSlide(3)"></span>
        </div>
    </section>
  
    <!-- WHO WE ARE SECTION -->
    <section id="who-we-are" class="who-we-are" aria-labelledby="who-we-are-heading">
        <div class="who-grid detailed">
            <div class="who-content full-width">
                <article class="who-card">
                    <h2 id="who-we-are-heading">Who We Are</h2>
                    <p class="lead">Cross-Cutting Excellence (CCE) mobilizes Christian professionals to reclaim and transform the secular institutions of society by applying the manifold wisdom of God in practical, professional, and ethical ways.</p>

                <div class="who-columns">
                    <div>
                        <h4>Context</h4>
                        <p>Our generation faces cascading crises—moral decay, geopolitical instability, environmental threats, and rising social fragmentation. CCE believes that principled, faith-driven leadership in professional spaces can reverse these trends and restore flourishing.</p>

                        <h4>Vision</h4>
                        <p>Christians establishing the glory of the Lord across the world through their secular professions until the kingdoms of this world become the kingdoms of our Lord and His Christ.</p>
                    </div>

                    <div>
                        <h4>Mission</h4>
                        <p>To build the capacity of Christian professionals—through training, mentorship, and mobilization—so they can ethically and effectively transform their spheres of influence.</p>

                        <h4>Strategy - SSA</h4>
                        <p><strong>Secular-Spiritual Aptitude (SSA)</strong> is our central philosophy: excellence in godliness while operating in the secular space. SSA means combining high professional competence with visible Christlike character.</p>
                    </div>
                </div>

          

                <div class="who-cta-row">
                    <div class="who-stats" role="group" aria-label="CCE Impact Statistics">
                        <div class="stat-item">
                            <div class="stat-number" data-count="20" aria-label="20 plus consultants">0+</div>
                            <div class="stat-label">Consultants</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="150" aria-label="150 plus volunteers">0+</div>
                            <div class="stat-label">Volunteers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-count="12" aria-label="12 plus conferences">0+</div>
                            <div class="stat-label">Conferences</div>
                        </div>
                    </div>

                    <aside class="who-quote">
                        <blockquote cite="#">
                            "CCE trained me to think Christianly in my profession — the impact is measurable." 
                            <cite>— Dr. A. Example</cite>
                        </blockquote>
                        <a class="hero-btn" href="get-involved.php" aria-label="Join CCE and become part of our community">Join CCE</a>
                    </aside>
                </div>
                </article>
            </div>
        </div>
    </section>

    <!-- FACULTY ENDEAVOURS SECTION -->
    <section id="faculty-endeavours" class="faculty-section" aria-labelledby="faculty-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="faculty-heading">Faculty Endeavours (FEs)</h2>
                <p class="lead">CCE engages professionals across eight strategic faculties to build capacity and transform the secular space.</p>
            </header>

            <div class="fe-grid" role="group" aria-label="CCE Faculty Endeavours">
                <article class="fe-card" id="fe-gad">
                    <div class="fe-icon"><img src="assets/icons/fe-gad.svg" alt="Governance and Development icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Governance & Development (GAD)</h3>
                        <p>Strengthening governance, public policy and institutional capacity for sustainable development and ethical leadership.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#gad" class="fe-link" aria-label="Explore Governance and Development faculty">Explore GAD</a></div>
                </article>

                <article class="fe-card" id="fe-eat">
                    <div class="fe-icon"><img src="assets/icons/fe-eat.svg" alt="Education and Training icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Education & Training (EAT)</h3>
                        <p>Equipping professionals with pedagogical skills, lifelong learning resources and training programs to uplift quality education.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#eat" class="fe-link" aria-label="Explore Education and Training faculty">Explore EAT</a></div>
                </article>

                <article class="fe-card" id="fe-sat">
                    <div class="fe-icon"><img src="assets/icons/fe-sat.svg" alt="Science and Technology icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Science & Technology (SAT)</h3>
                        <p>Promoting ethical innovation, research excellence and technology adoption that serve humanity and honour God.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#sat" class="fe-link" aria-label="Explore Science and Technology faculty">Explore SAT</a></div>
                </article>

                <article class="fe-card" id="fe-paa">
                    <div class="fe-icon"><img src="assets/icons/fe-paa.svg" alt="Philosophy and Arts icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Philosophy & the Arts (PAA)</h3>
                        <p>Integrating faith, culture and the arts to shape worldviews and communicate timeless truths with creativity.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#paa" class="fe-link" aria-label="Explore Philosophy and Arts faculty">Explore PAA</a></div>
                </article>

                <article class="fe-card" id="fe-fab">
                    <div class="fe-icon"><img src="assets/icons/fe-fab.svg" alt="Finance and Business icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Finance & Business (FAB)</h3>
                        <p>Championing integrity, stewardship and excellence in business practice and financial management.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#fab" class="fe-link" aria-label="Explore Finance and Business faculty">Explore FAB</a></div>
                </article>

                <article class="fe-card" id="fe-raf">
                    <div class="fe-icon"><img src="assets/icons/fe-raf.svg" alt="Relationship and Family icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Relationship & Family (RAF)</h3>
                        <p>Supporting healthy relationships, family resilience and community formation rooted in godly principles.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#raf" class="fe-link" aria-label="Explore Relationship and Family faculty">Explore RAF</a></div>
                </article>

                <article class="fe-card" id="fe-maa">
                    <div class="fe-icon"><img src="assets/icons/fe-maa.svg" alt="Missions and Apologetics icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Missions & Apologetics (MAA)</h3>
                        <p>Preparing professionals to engage culture with the gospel, defend the faith thoughtfully and serve missionally.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#maa" class="fe-link" aria-label="Explore Missions and Apologetics faculty">Explore MAA</a></div>
                </article>

                <article class="fe-card" id="fe-cam">
                    <div class="fe-icon"><img src="assets/icons/fe-cam.svg" alt="Communication and Media icon" loading="lazy"></div>
                    <div class="fe-body">
                        <h3>Communication & Media (CAM)</h3>
                        <p>Equipping communicators to shape narratives, produce high-quality content and influence public discourse with truth.</p>
                    </div>
                    <div class="fe-actions"><a href="faculty.php#cam" class="fe-link" aria-label="Explore Communication and Media faculty">Explore CAM</a></div>
                </article>
            </div>
        </div>
    </section>
    
     <!-- CCE PEOPLE SECTION -->
    <section id="cce-people" class="people-section" aria-labelledby="people-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="people-heading">CCE People</h2>
                <p class="lead">Meet a few members of the Cross-Cutting Excellence community — practitioners, mentors and volunteers who drive our mission.</p>
            </header>

            <div class="people-grid">
                <?php
                try {
                    $people = include __DIR__ . '/data/people.php';
                    if (empty($people) || !is_array($people)) {
                        throw new Exception('People data not available');
                    }
                    
                    // Group people by 'group' field
                    $groups = [];
                    foreach ($people as $p) {
                        if (isset($p['group'])) {
                            $groups[$p['group']][] = $p;
                        }
                    }

                    foreach ($groups as $groupName => $members):
                        $groupId = strtolower(str_replace([' ', '&'], ['-', 'and'], $groupName));
                        $groupId = preg_replace('/[^a-z0-9\-]/', '', $groupId);
                ?>
                        <section class="people-group" aria-labelledby="<?= 'people-' . htmlspecialchars($groupId) . '-heading' ?>">
                            <h3 id="<?= 'people-' . htmlspecialchars($groupId) . '-heading' ?>" class="people-group-heading"><?= htmlspecialchars($groupName) ?></h3>
                            <div class="group-grid" role="group" aria-label="<?= htmlspecialchars($groupName) ?> members">
                                <?php 
                                foreach ($members as $m): 
                                    $person = $m; 
                                    include __DIR__ . '/partials/person-card.php'; 
                                endforeach; 
                                ?>
                            </div>
                        </section>
                <?php 
                    endforeach; 
                } catch (Exception $e) {
                    echo '<div class="error-message" role="alert">';
                    echo '<p>Unable to load people data at this time. Please try again later.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
      <!-- CCE COMPANIES SECTION -->
    <section id="cce-companies" class="companies-section" aria-labelledby="companies-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="companies-heading">CCE Companies</h2>
                <p class="lead">CCE Companies are mission-driven enterprises founded, led, or stewarded by members of the CCE community. These organisations put our conviction into practice — that professional excellence and Christian character must be inseparable — by partnering with CCE faculties on training, research, policy advising and community programmes.</p>
            </header>

            <div class="companies-grid" role="group" aria-label="CCE partner companies">
                <?php
                try {
                    $companies = include __DIR__ . '/data/companies.php';
                    if (empty($companies) || !is_array($companies)) {
                        throw new Exception('Companies data not available');
                    }
                    
                    foreach ($companies as $c) { 
                        $company = $c; 
                        include __DIR__ . '/partials/company-card.php'; 
                    }
                } catch (Exception $e) {
                    echo '<div class="error-message" role="alert">';
                    echo '<p>Unable to load companies data at this time. Please try again later.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
    
    <!-- CONFERENCES & EVENTS SECTION -->
    <section id="conferences-events" class="events-section" aria-labelledby="events-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="events-heading">Conferences & Events</h2>
                <p class="lead">CCE organises and partners on events that bring professionals together to learn, network and multiply impact. Below are upcoming and flagship events — click through for details, registration, and ways to participate.</p>
            </header>

            <?php
            try {
                $events = include __DIR__ . '/data/events.php';
                if (empty($events) || !is_array($events)) {
                    throw new Exception('Events data not available');
                }
                
                // Sort by start datetime ascending (upcoming first). Prefer timezone-aware start_datetime, fall back to start_date.
                usort($events, function($a, $b) {
                    $toTs = function($e) {
                        // prefer start_datetime with timezone
                        if (!empty($e['start_datetime'])) {
                            try {
                                $tz = !empty($e['timezone']) ? new DateTimeZone($e['timezone']) : new DateTimeZone(date_default_timezone_get());
                                $d = new DateTime($e['start_datetime'], $tz);
                                return $d->getTimestamp();
                            } catch (Exception $ex) {
                                return PHP_INT_MAX;
                            }
                        }
                        // fallback to start_date
                        if (!empty($e['start_date'])) {
                            $t = strtotime($e['start_date']);
                            return $t !== false ? $t : PHP_INT_MAX;
                        }
                        return PHP_INT_MAX;
                    };
                    return $toTs($a) <=> $toTs($b);
                });

                // extract featured events
                $featured = array_filter($events, function($e){ return !empty($e['is_featured']); });
                $regular = array_filter($events, function($e){ return empty($e['is_featured']); });
            ?>

            <div class="events-list" role="group" aria-label="Upcoming conferences and events">
                <?php 
                foreach ($events as $ev) { 
                    $event = $ev; 
                    $is_featured = !empty($event['is_featured']); 
                    include __DIR__ . '/partials/event-row.php'; 
                } 
                ?>
            </div>
            
            <?php 
            } catch (Exception $e) {
                echo '<div class="error-message" role="alert">';
                echo '<p>Unable to load events data at this time. Please try again later.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
  
    <!-- NEWS & MEDIA SECTION -->
    <section id="news-media" class="news-section" aria-labelledby="news-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="news-heading">News & Media</h2>
                <p class="lead">Recent updates, stories and resources from CCE — reports, recaps and media that highlight our work and community.</p>
            </header>

            <?php
            try {
                $news = include __DIR__ . '/data/news.php';
                if (empty($news) || !is_array($news)) {
                    throw new Exception('News data not available');
                }
                
                // Sort by published date descending (newest first)
                usort($news, function($a,$b){ 
                    $timeA = isset($a['published_at']) ? strtotime($a['published_at']) : 0;
                    $timeB = isset($b['published_at']) ? strtotime($b['published_at']) : 0;
                    return $timeB <=> $timeA; 
                });
                
                $recent = array_slice($news, 0, 3);
                
                if (!empty($recent)) {
                    echo '<div class="news-grid" role="group" aria-label="Latest news and media">';
                    foreach ($recent as $n) { 
                        $post = $n; 
                        include __DIR__ . '/partials/news-card.php'; 
                    }
                    echo '</div>';
                } else {
                    echo '<div class="no-content" role="status">';
                    echo '<p>No news articles available at this time.</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                echo '<div class="error-message" role="alert">';
                echo '<p>Unable to load news data at this time. Please try again later.</p>';
                echo '</div>';
            }
            ?>

            <div class="news-actions" style="text-align: center; margin-top: 2rem;">
                <a href="news.php" class="hero-btn" aria-label="View all news articles and media updates">View All News</a>
            </div>
        </div>
    </section>
</main>





<!-- FOOTER -->
<?php include 'footer.php'; ?>

<!-- HOMEPAGE JAVASCRIPT -->
<script>
// Hero Slider - Direct Implementation
document.addEventListener('DOMContentLoaded', function() {
    let currentSlideIndex = 0;
    let sliderInterval;
    
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    
    if (slides.length === 0) {
        console.log('No slides found');
        return;
    }
    
    console.log('Hero slider initialized with', slides.length, 'slides');
    
    function showSlide(index) {
        // Remove active from all
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Add active to current
        slides[index].classList.add('active');
        if (indicators[index]) {
            indicators[index].classList.add('active');
        }
        
        currentSlideIndex = index;
        
        console.log('Slide changed to:', index);
    }
    
    function nextSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        showSlide(currentSlideIndex);
    }
    
    function prevSlide() {
        currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
        showSlide(currentSlideIndex);
    }
    
    function startAutoSlide() {
        sliderInterval = setInterval(nextSlide, 6000);
    }
    
    function stopAutoSlide() {
        if (sliderInterval) clearInterval(sliderInterval);
    }
    
    function restartAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }
    
    // Global functions for onclick handlers
    window.changeSlide = function(direction) {
        if (direction > 0) {
            nextSlide();
        } else {
            prevSlide();
        }
        restartAutoSlide();
    };
    
    window.currentSlide = function(slideNumber) {
        showSlide(slideNumber - 1);
        restartAutoSlide();
    };
    
    // Initialize
    showSlide(0);
    startAutoSlide();
    
    // Event listeners
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        heroSlider.addEventListener('mouseenter', stopAutoSlide);
        heroSlider.addEventListener('mouseleave', startAutoSlide);
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            restartAutoSlide();
        }
        if (e.key === 'ArrowRight') {
            nextSlide();
            restartAutoSlide();
        }
    });
    
    // Touch support
    let startX = 0;
    if (heroSlider) {
        heroSlider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });
        
        heroSlider.addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            const deltaX = startX - endX;
            
            if (Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
                restartAutoSlide();
            }
        });
    }
    
    console.log('Hero slider setup complete');
});
</script>

<script src="assets/js/homepage.js" defer></script>
