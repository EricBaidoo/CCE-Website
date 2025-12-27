<?php
// Set meta data for this page
$meta = [
    'title' => 'Cross-Cutting Excellence - Transforming Secular Institutions with Christian Professional Excellence',
    'description' => 'CCE mobilizes Christian professionals to transform secular institutions through faith-driven leadership, training, and the application of godly wisdom in professional spaces.',
    'image' => 'assets/image/hero/001-w800.jpg',
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

<main id="main-content" role="main">
    <!-- HERO SECTION -->
    
    <section class="hero-slider" id="heroSlider">
        <!-- Slide 1 -->
        <div class="slide active">
          <div class="hero-content">
            <div class="container">
              <span class="hero-badge">Welcome to CCE</span>
              <h1 class="hero-title">
                Transforming Institutions Globally
                <span class="accent">Empowering Excellence Everywhere</span>
              </h1>
              <div class="hero-buttons">
                <a href="get-involved.php" class="btn-primary">Get Involved</a>
                <a href="about.php" class="btn-secondary">Learn More</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="slide">
          <div class="hero-content">
            <div class="container">
              <span class="hero-badge">Global Community</span>
              <h1 class="hero-title">
                Connect & Collaborate
                <span class="accent">Across Borders</span>
              </h1>
              <div class="hero-buttons">
                <a href="events.php" class="btn-primary">See Events</a>
                <a href="contact.php" class="btn-secondary">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="slide">
          <div class="hero-content">
            <div class="container">
              <span class="hero-badge">Lead with Purpose</span>
              <h1 class="hero-title">
                Make an Impact
                <span class="accent">Join the Movement</span>
              </h1>
              <div class="hero-buttons">
                <a href="get-involved.php" class="btn-primary">Start Now</a>
                <a href="about.php" class="btn-secondary">Learn More</a>
              </div>
            </div>
          </div>
        </div>
    </section>



  
    <!-- WHO WE ARE SECTION (Modernized) -->
    <section class="who-we-are-section">
      <div class="who-we-are-container">
        <div class="who-we-are-header">
          <h2 class="who-we-are-title">Who We Are</h2>
          <p class="who-we-are-subtitle">Cross-Cutting Excellence (CCE) mobilizes Christian professionals to reclaim and transform the secular institutions of society by applying the manifold wisdom of God in practical, professional, and ethical ways.</p>
        </div>
        <div class="who-we-are-content">
          <div class="who-we-are-text">
            <h4>Context</h4>
            <p>Our generation faces cascading crises—moral decay, geopolitical instability, environmental threats, and rising social fragmentation. CCE believes that principled, faith-driven leadership in professional spaces can reverse these trends and restore flourishing.</p>
            <h4>Vision</h4>
            <p>Christians establishing the glory of the Lord across the world through their secular professions until the kingdoms of this world become the kingdoms of our Lord and His Christ.</p>
            <h4>Mission</h4>
            <p>To build the capacity of Christian professionals—through training, mentorship, and mobilization—so they can ethically and effectively transform their spheres of influence.</p>
            <h4>Strategy - SSA</h4>
            <p><strong>Secular-Spiritual Aptitude (SSA)</strong> is our central philosophy: excellence in godliness while operating in the secular space. SSA means combining high professional competence with visible Christlike character.</p>
          </div>
          <div class="who-we-are-image">
            <img src="assets/image/hero/001-w800.jpg" alt="Who We Are Image">
          </div>
        </div>
        <div class="who-we-are-stats-row">
          <div class="who-we-are-stats">
            <div class="stat">
              <span class="stat-number">20+</span>
              <span class="stat-label">Consultants</span>
            </div>
            <div class="stat">
              <span class="stat-number">150+</span>
              <span class="stat-label">Volunteers</span>
            </div>
            <div class="stat">
              <span class="stat-number">12+</span>
              <span class="stat-label">Conferences</span>
            </div>
          </div>
        </div>
      </div>
        <div class="who-cta-row">
      <div class="who-cta-row">
        <div class="who-stats" role="group" aria-label="CCE Impact Statistics">
          <div class="stat">
            <span class="stat-number" data-count="20">20+</span>
            <span class="stat-label">Consultants</span>
          </div>
          <div class="stat">
            <span class="stat-number" data-count="150">150+</span>
            <span class="stat-label">Volunteers</span>
          </div>
          <div class="stat">
            <span class="stat-number" data-count="12">12+</span>
            <span class="stat-label">Conferences</span>
          </div>
        </div>
      </div>
      </div>
     
    </section>

    <!-- FACULTY ENDEAVOURS SECTION -->
    <section id="faculty-endeavours" class="faculty-endeavours-section" aria-labelledby="faculty-heading">
      <div class="faculty-endeavours-container">
        <header class="faculty-endeavours-header">
          <h2 id="faculty-heading" class="faculty-endeavours-title">Faculty Endeavours (FEs)</h2>
          <p class="faculty-endeavours-subtitle">CCE engages professionals across eight strategic faculties to build capacity and transform the secular space.</p>
        </header>
        <div class="faculty-endeavours-grid" role="group" aria-label="CCE Faculty Endeavours">
          <article class="faculty-endeavours-card" id="fe-gad">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-gad.svg" alt="Governance and Development icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Governance & Development (GAD)</h3>
              <p>Strengthening governance, public policy and institutional capacity for sustainable development and ethical leadership.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#gad" class="faculty-endeavours-link" aria-label="Explore Governance and Development faculty">Explore GAD</a></div>
                              <!-- Language selector moved to header -->
          </article>

          <article class="faculty-endeavours-card" id="fe-sat">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-sat.svg" alt="Science and Technology icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Science & Technology (SAT)</h3>
              <p>Promoting ethical innovation, research excellence and technology adoption that serve humanity and honour God.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#sat" class="faculty-endeavours-link" aria-label="Explore Science and Technology faculty">Explore SAT</a></div>
          </article>

          <article class="faculty-endeavours-card" id="fe-paa">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-paa.svg" alt="Philosophy and Arts icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Philosophy & the Arts (PAA)</h3>
              <p>Integrating faith, culture and the arts to shape worldviews and communicate timeless truths with creativity.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#paa" class="faculty-endeavours-link" aria-label="Explore Philosophy and Arts faculty">Explore PAA</a></div>
          </article>

          <article class="faculty-endeavours-card" id="fe-fab">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-fab.svg" alt="Finance and Business icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Finance & Business (FAB)</h3>
              <p>Championing integrity, stewardship and excellence in business practice and financial management.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#fab" class="faculty-endeavours-link" aria-label="Explore Finance and Business faculty">Explore FAB</a></div>
          </article>

          <article class="faculty-endeavours-card" id="fe-raf">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-raf.svg" alt="Relationship and Family icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Relationship & Family (RAF)</h3>
              <p>Supporting healthy relationships, family resilience and community formation rooted in godly principles.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#raf" class="faculty-endeavours-link" aria-label="Explore Relationship and Family faculty">Explore RAF</a></div>
          </article>

          <article class="faculty-endeavours-card" id="fe-maa">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-maa.svg" alt="Missions and Apologetics icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Missions & Apologetics (MAA)</h3>
              <p>Preparing professionals to engage culture with the gospel, defend the faith thoughtfully and serve missionally.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#maa" class="faculty-endeavours-link" aria-label="Explore Missions and Apologetics faculty">Explore MAA</a></div>
          </article>

          <article class="faculty-endeavours-card" id="fe-cam">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-cam.svg" alt="Communication and Media icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Communication & Media (CAM)</h3>
              <p>Equipping communicators to shape narratives, produce high-quality content and influence public discourse with truth.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#cam" class="faculty-endeavours-link" aria-label="Explore Communication and Media faculty">Explore CAM</a></div>
          </article>
        </div>
      </div>
    </section>
    
     <!-- CCE PEOPLE SECTION -->
    <section id="cce-people" class="people-section" aria-labelledby="people-heading">
      <div class="container">
        <header class="section-header">
          <h2 id="people-heading" class="section-title">CCE People</h2>
          <p class="lead">Meet a few members of the Cross-Cutting Excellence community — practitioners, mentors and volunteers who drive our mission.</p>
        </header>
        <div class="people-groups card-grid">
          <?php
          try {
            $people = include __DIR__ . '/data/people.php';
            if (empty($people) || !is_array($people)) {
              throw new Exception('People data not available');
            }
          ?>
            <div class="people-group card">
                <div class="people-carousel-wrapper">
                <div class="people-carousel" id="carousel-all-people">
                  <?php 
                  foreach ($people as $person): 
                    $avatar = 'assets/image/avatars/' . $person['id'] . '-w400.jpg';
                    if (!file_exists(__DIR__ . '/../' . $avatar)) { $avatar = $person['photo']; }
                  ?>
                  <div class="person-card card">
                    <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($person['name']) ?>" class="person-avatar" loading="lazy" decoding="async">
                    <h4 class="person-name"> <?= htmlspecialchars($person['name']) ?> </h4>
                    <div class="person-role"> <?= htmlspecialchars($person['role']) ?> </div>
                    <div class="person-bio"> <?= htmlspecialchars($person['bio_short']) ?> </div>
                    <div class="person-links">
                      <a href="person.php?id=<?= urlencode($person['id']) ?>" class="profile-link">View profile</a>
                      <?php if (!empty($person['email'])): ?>
                        <a href="mailto:<?= htmlspecialchars($person['email']) ?>" class="email-link" aria-label="Email <?= htmlspecialchars($person['name']) ?>"><i class="fas fa-envelope"></i></a>
                      <?php endif; ?>
                      <?php if (!empty($person['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($person['linkedin']) ?>" target="_blank" rel="noopener" class="linkedin-link" aria-label="Open <?= htmlspecialchars($person['name']) ?> on LinkedIn"><i class="fab fa-linkedin"></i></a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="carousel-nav">
                  <button class="carousel-btn carousel-prev" data-carousel="carousel-all-people" aria-label="Previous">‹</button>
                  <button class="carousel-btn carousel-next" data-carousel="carousel-all-people" aria-label="Next">›</button>
                </div>
              </div>
            </div>
          <?php 
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
          <h2 id="companies-heading" class="section-title">CCE Companies</h2>
          <p class="lead">CCE Companies are mission-driven enterprises founded, led, or stewarded by members of the CCE community. These organisations put our conviction into practice — that professional excellence and Christian character must be inseparable — by partnering with CCE faculties on training, research, policy advising and community programmes.</p>
        </header>
        <div class="companies-grid" role="group" aria-label="CCE partner companies">
          <?php
          try {
            $companies = include __DIR__ . '/data/companies.php';
            if (empty($companies) || !is_array($companies)) {
              throw new Exception('Companies data not available');
            }
            // No duplication: show only unique companies from data
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
          <h2 id="events-heading" class="section-title">Conferences & Events</h2>
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
          <h2 id="news-heading" class="section-title">News & Media</h2>
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
          if (!empty($news)) {
            echo '<div class="news-grid" role="group" aria-label="Latest news and media">';
            foreach ($news as $n) { 
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
        <div class="news-actions">
          <a href="news.php" class="hero-btn" aria-label="View all news articles and media updates">View All News</a>
        </div>
      </div>
    </section>

    <!-- GLOBAL IMPACT SECTION -->

    <section id="global-impact" class="global-impact-section" aria-labelledby="global-impact-heading">
      <h2 id="global-impact-heading" class="section-title">Global Impact</h2>
      <p class="section-desc">CCE's reach spans continents, empowering professionals and organizations to transform their communities with excellence and integrity.</p>
      <div class="global-impact-content">
        <div class="container">
          <h2 id="who-we-are-heading" class="section-title">Who We Are</h2>
          <p class="section-subtitle">Cross-Cutting Excellence (CCE) mobilizes Christian professionals to reclaim and transform the secular institutions of society by applying the manifold wisdom of God in practical, professional, and ethical ways.</p>
          <div class="who-cards-row">
            <div class="who-card who-card-text">
              <div class="who-card-section">
                <h4>Context</h4>
                <p>Our generation faces cascading crises—moral decay, geopolitical instability, environmental threats, and rising social fragmentation. CCE believes that principled, faith-driven leadership in professional spaces can reverse these trends and restore flourishing.</p>
              </div>
              <div class="who-card-section">
                <h4>Vision</h4>
                <p>Christians establishing the glory of the Lord across the world through their secular professions until the kingdoms of this world become the kingdoms of our Lord and His Christ.</p>
              </div>
              <div class="who-card-section">
                <h4>Mission</h4>
                <p>To build the capacity of Christian professionals—through training, mentorship, and mobilization—so they can ethically and effectively transform their spheres of influence.</p>
              </div>
              <div class="who-card-section">
                <h4>Strategy - SSA</h4>
                <p><strong>Secular-Spiritual Aptitude (SSA)</strong> is our central philosophy: excellence in godliness while operating in the secular space. SSA means combining high professional competence with visible Christlike character.</p>
              </div>
            </div>
            <div class="who-card who-card-image">
              <img src="assets/image/hero/001-w800.jpg" alt="Who We Are Image" style="width:100%;border-radius:1.2rem;box-shadow:0 0.2em 0.7em rgba(58,12,163,0.09);">
            </div>
          </div>
          <div class="who-cta-row">
            <div class="who-stats" role="group" aria-label="CCE Impact Statistics">
              <div class="stat">
                <span class="stat-number" data-count="5000">5,000+</span>
                <span class="stat-label">People Trained</span>
              </div>
              <div class="stat">
                <span class="stat-number" data-count="25">25+</span>
                <span class="stat-label">Countries Reached</span>
              </div>
              <div class="stat">
                <span class="stat-number" data-count="50">50+</span>
                <span class="stat-label">Partner Organizations</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- GET INVOLVED SECTION -->
    <section id="get-involved" class="get-involved-section" aria-labelledby="get-involved-heading">
      <div class="get-involved-container">
        <header class="get-involved-header">
          <h2 id="get-involved-heading" class="get-involved-title">Get Involved</h2>
          <p class="get-involved-subtitle">Join the CCE movement and help transform secular institutions through faith-driven professional excellence.</p>
        </header>
        <div class="involvement-options">
          <div class="involvement-card">
            <div class="involvement-icon">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="30" cy="30" r="28" fill="#ff8800" opacity="0.1"/>
                <path d="M30 15C21.7 15 15 21.7 15 30C15 38.3 21.7 45 30 45C38.3 45 45 38.3 45 30C45 21.7 38.3 15 30 15ZM30 22.5C32.5 22.5 34.5 24.5 34.5 27C34.5 29.5 32.5 31.5 30 31.5C27.5 31.5 25.5 29.5 25.5 27C25.5 24.5 27.5 22.5 30 22.5ZM30 42C26 42 22.5 39.8 20.5 36.5C20.5 33 27.5 31 30 31C32.5 31 39.5 33 39.5 36.5C37.5 39.8 34 42 30 42Z" fill="#ff8800"/>
              </svg>
            </div>
            <h3 class="involvement-card-title">Volunteer</h3>
            <p class="involvement-card-desc">Contribute your time and skills to support CCE programs, events, and community initiatives.</p>
            <a href="get-involved.php#volunteer" class="involvement-btn">Learn More</a>
          </div>
          
          <div class="involvement-card">
            <div class="involvement-icon">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="30" cy="30" r="28" fill="#252163" opacity="0.1"/>
                <path d="M38 18H22C19.8 18 18 19.8 18 22V38C18 40.2 19.8 42 22 42H38C40.2 42 42 40.2 42 38V22C42 19.8 40.2 18 38 18ZM38 38H22V22H38V38ZM26 34H34V36H26V34ZM26 30H34V32H26V30ZM26 26H34V28H26V26Z" fill="#252163"/>
              </svg>
            </div>
            <h3 class="involvement-card-title">Join as Consultant</h3>
            <p class="involvement-card-desc">Share your professional expertise and mentor emerging leaders in your field.</p>
            <a href="get-involved.php#consultant" class="involvement-btn">Apply Now</a>
          </div>
          
          <div class="involvement-card">
            <div class="involvement-icon">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="30" cy="30" r="28" fill="#ff8800" opacity="0.1"/>
                <path d="M42 26L38 22L30 30L22 22L18 26L30 38L42 26Z" fill="#ff8800"/>
                <path d="M26 18H34V24L30 28L26 24V18Z" fill="#ff8800"/>
              </svg>
            </div>
            <h3 class="involvement-card-title">Partnerships</h3>
            <p class="involvement-card-desc">Collaborate with CCE to expand impact through institutional partnerships and joint initiatives.</p>
            <a href="get-involved.php#partnerships" class="involvement-btn">Partner With Us</a>
          </div>
        </div>
      </div>
    </section>

 
</main>





<!-- FOOTER -->
<?php include 'footer.php'; ?>

<!-- HERO SLIDER JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Hero Slider
  let currentSlide = 0;
  const slides = document.querySelectorAll('.hero-slider .slide');
  function showSlide(idx) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === idx);
      slide.style.display = i === idx ? 'block' : 'none';
    });
  }
  function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }
  showSlide(currentSlide);
  setInterval(nextSlide, 5000);

  // People Carousel Navigation and Auto-scroll
  const carousels = document.querySelectorAll('.people-carousel');
  
  // Auto-scroll every 3 seconds
  carousels.forEach(carousel => {
    setInterval(() => {
      const scrollAmount = 340; // Card width + gap
      const maxScroll = carousel.scrollWidth - carousel.clientWidth;
      
      if (carousel.scrollLeft >= maxScroll - 10) {
        // Reset to beginning
        carousel.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }, 3000);
  });
  
  // Manual navigation buttons
  const carouselBtns = document.querySelectorAll('.carousel-btn');
  carouselBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const carouselId = this.getAttribute('data-carousel');
      const carousel = document.getElementById(carouselId);
      const scrollAmount = 340; // Card width + gap
      
      if (this.classList.contains('carousel-prev')) {
        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      } else {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    });
  });
});
</script>

