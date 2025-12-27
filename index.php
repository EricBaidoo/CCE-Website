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
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-gradient-overlay"></div>
            <div class="hero-pattern"></div>
        </div>
        
        <div class="hero-container">
            <div class="hero-content-wrapper">
                <!-- Hero Badge -->
                <div class="hero-badge-wrapper">
                    <span class="hero-badge">FOCUS • DILIGENCE • CONSISTENCY</span>
                </div>
                
                <!-- Main Hero Content -->
                <div class="hero-main-content">
                    <h1 class="hero-main-title">
                        <span class="title-line-1">Cross-Cutting</span>
                        <span class="title-line-2">Excellence</span>
                    </h1>
                    <p class="hero-tagline">Christians Establishing the Glory of the Lord Jesus Christ</p>
                    <p class="hero-description">Building the capacity of Christian professionals to transform their spheres of endeavour with the manifold wisdom of God</p>
                    
                    <!-- Hero Actions -->
                    <div class="hero-actions">
                        <a href="get-involved.php" class="hero-btn hero-btn-primary">
                            <span>Get Involved</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="about.php" class="hero-btn hero-btn-secondary">
                            <span>Learn More</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Hero Stats -->
            <div class="hero-stats-wrapper">
                <div class="hero-stat-card">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">200+</div>
                        <div class="stat-label">Professionals</div>
                    </div>
                </div>
                
                <div class="hero-stat-card">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Countries</div>
                    </div>
                </div>
                
                <div class="hero-stat-card">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Years Active</div>
                    </div>
                </div>
                
                <div class="hero-stat-card">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19 21V5C19 4.46957 18.7893 3.96086 18.4142 3.58579C18.0391 3.21071 17.5304 3 17 3H7C6.46957 3 5.96086 3.21071 5.58579 3.58579C5.21071 3.96086 5 4.46957 5 5V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 21H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 7H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 11H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 15H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Faculty Endeavours</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="hero-floating-element hero-float-1"></div>
        <div class="hero-floating-element hero-float-2"></div>
        <div class="hero-floating-element hero-float-3"></div>
    </section>



  
    <!-- WHO WE ARE SECTION (Modernized) -->
    <section class="who-we-are-section">
      <div class="who-we-are-container">
        <div class="who-we-are-header">
          <h2 class="who-we-are-title">Excellence is to Excel</h2>
          <p class="who-we-are-subtitle">To have excess competence, be abundantly fruitful, to have more than may be immediately required... relevant more</p>
        </div>
        <div class="who-we-are-content">
          <div class="who-we-are-text">
            <h4>What is Excellence?</h4>
            <p>Excellence is to excel, to have excess competence, be abundantly fruitful, to have more than may be immediately required...relevant more. Excellence is to possess eternal life.</p>
            
            <h4>Our Vision</h4>
            <p>We see Christians establishing the glory of the Lord Jesus Christ across the world through their secular professions.</p>
            
            <h4>Our Mission</h4>
            <p>Building the capacity of Christian professionals to transform their various spheres of endeavour with the manifold wisdom of God.</p>
            
            <h4>Seculo-Spiritual Aptitude (SSA)</h4>
            <p>God's word, inspired by the Spirit of Christ Jesus, is the guidance by which the skill of godliness is manifested in secular endeavours. We call this Seculo-Spiritual Aptitude (SSA).</p>
          </div>
          <div class="who-we-are-image">
            <img src="assets/image/hero/001-w800.jpg" alt="Excellence in Christian Professional Engagement">
          </div>
        </div>
        <div class="who-we-are-stats-row">
          <div class="who-we-are-stats">
            <div class="stat">
              <span class="stat-number">8</span>
              <span class="stat-label">Faculty Endeavours</span>
            </div>
            <div class="stat">
              <span class="stat-number">10+</span>
              <span class="stat-label">Years Active</span>
            </div>
            <div class="stat">
              <span class="stat-number">12+</span>
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
          </article>

          <article class="faculty-endeavours-card" id="fe-eat">
            <div class="faculty-endeavours-icon"><img src="assets/icons/fe-eat.svg" alt="Education and Training icon" loading="lazy"></div>
            <div class="faculty-endeavours-body">
              <h3>Education & Training (EAT)</h3>
              <p>Empowering educators and trainers to formulate educational systems that drive industry and promote the glory of God.</p>
            </div>
            <div class="faculty-endeavours-actions"><a href="faculty.php#eat" class="faculty-endeavours-link" aria-label="Explore Education and Training faculty">Explore EAT</a></div>
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
            <div class="faculty-endeavours-actions"><a href="faculty-maa.php" class="faculty-endeavours-link" aria-label="Explore Missions and Apologetics faculty">Explore MAA</a></div>
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
    <section id="cce-people" class="cce-people-section" aria-labelledby="people-heading">
      <div class="people-section-container">
        <div class="people-section-header">
          <h2 id="people-heading" class="people-section-title">CCE People</h2>
          <p class="people-section-subtitle">Meet practitioners, mentors and volunteers who drive our mission of excellence</p>
        </div>
        
        <div class="people-carousel-container">
          <?php
          try {
            $people = include __DIR__ . '/data/people.php';
            if (empty($people) || !is_array($people)) {
              throw new Exception('People data not available');
            }
          ?>
            <div class="carousel-wrapper">
              <div class="people-carousel" id="cce-people-carousel">
                <?php 
                foreach ($people as $person): 
                  $avatar = 'assets/image/avatars/' . $person['id'] . '-w400.jpg';
                  if (!file_exists(__DIR__ . '/../' . $avatar)) { $avatar = $person['photo']; }
                ?>
                <div class="people-card">
                  <div class="people-card-image">
                    <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($person['name']) ?>" loading="lazy" decoding="async">
                  </div>
                  <div class="people-card-content">
                    <h3 class="people-card-name"><?= htmlspecialchars($person['name']) ?></h3>
                    <p class="people-card-role"><?= htmlspecialchars($person['role']) ?></p>
                    <p class="people-card-bio"><?= htmlspecialchars($person['bio_short']) ?></p>
                    <div class="people-card-actions">
                      <a href="person.php?id=<?= urlencode($person['id']) ?>" class="people-card-link">View Profile</a>
                      <?php if (!empty($person['email'])): ?>
                        <a href="mailto:<?= htmlspecialchars($person['email']) ?>" class="people-card-social" title="Email" aria-label="Email <?= htmlspecialchars($person['name']) ?>">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </a>
                      <?php endif; ?>
                      <?php if (!empty($person['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($person['linkedin']) ?>" target="_blank" rel="noopener" class="people-card-social" title="LinkedIn" aria-label="LinkedIn profile">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              
              <div class="carousel-controls">
                <button class="carousel-control-btn prev" data-carousel="cce-people-carousel" aria-label="Previous person">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="carousel-control-btn next" data-carousel="cce-people-carousel" aria-label="Next person">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                </button>
              </div>
            </div>
          <?php 
          } catch (Exception $e) {
            echo '<div class="error-message" role="alert" style="text-align: center; padding: 3rem;">';
            echo '<p>Unable to load people data. Please try again later.</p>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </section>
      <!-- CCE COMPANIES SECTION -->
    <section id="cce-companies" class="companies-section" aria-labelledby="companies-heading">
      <div class="companies-section-container">
        <header class="companies-section-header">
          <h2 id="companies-heading" class="companies-section-title">CCE Companies</h2>
          <p class="companies-section-subtitle">Mission-driven enterprises partnering with CCE to transform their spheres of influence</p>
        </header>
        
        <div class="companies-carousel-container">
          <?php
          try {
            $companies = include __DIR__ . '/data/companies.php';
            if (empty($companies) || !is_array($companies)) {
              throw new Exception('Companies data not available');
            }
          ?>
            <div class="companies-carousel-wrapper">
              <div class="companies-carousel" id="companies-carousel">
                <?php 
                // Display companies twice for infinite scroll effect
                for ($repeat = 0; $repeat < 2; $repeat++):
                  foreach ($companies as $company): 
                ?>
                <a href="company.php?id=<?= urlencode($company['id']) ?>" class="company-carousel-card" title="View <?= htmlspecialchars($company['name']) ?> profile">
                  <div class="company-carousel-logo">
                    <img src="<?= htmlspecialchars($company['logo']) ?>" alt="<?= htmlspecialchars($company['name']) ?>" loading="lazy" decoding="async">
                  </div>
                  <h3 class="company-carousel-name"><?= htmlspecialchars($company['name']) ?></h3>
                </a>
                <?php 
                  endforeach;
                endfor;
                ?>
              </div>
            </div>
          <?php 
          } catch (Exception $e) {
            echo '<div class="error-message" role="alert" style="text-align: center; padding: 3rem;">';
            echo '<p>Unable to load companies data. Please try again later.</p>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </section>
    
    <!-- CONFERENCES & EVENTS SECTION -->
    <section id="conferences-events" class="home-events-section" aria-labelledby="events-heading">
      <div class="container">
        <header class="section-header-modern">
          <div class="header-content-wrapper">
            <span class="section-label-badge">Connect & Learn</span>
            <h2 id="events-heading" class="section-title-modern">Conferences & Events</h2>
            <p class="section-description">Join professionals from across industries at our transformative conferences, workshops, and networking events designed to equip you with godly wisdom and professional excellence</p>
          </div>
          <a href="events.php" class="view-all-btn">
            View All Events
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </header>
        <?php
        try {
          $events = include __DIR__ . '/data/events.php';
          if (empty($events) || !is_array($events)) {
            throw new Exception('Events data not available');
          }
          
          // Sort: upcoming first, then by start date
          usort($events, function($a, $b) {
            $tz = new DateTimeZone('Africa/Accra');
            $today = new DateTimeImmutable('now', $tz);
            
            $aEnd = null;
            $bEnd = null;
            
            if (!empty($a['end_datetime'])) {
              $aEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $a['end_datetime'], $tz);
            } elseif (!empty($a['end_date'])) {
              $aEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $a['end_date'] . ' 23:59:59', $tz);
            }
            
            if (!empty($b['end_datetime'])) {
              $bEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $b['end_datetime'], $tz);
            } elseif (!empty($b['end_date'])) {
              $bEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $b['end_date'] . ' 23:59:59', $tz);
            }
            
            $aIsPast = $aEnd ? ($aEnd < $today) : false;
            $bIsPast = $bEnd ? ($bEnd < $today) : false;
            
            // Upcoming events first
            if ($aIsPast !== $bIsPast) {
              return $aIsPast ? 1 : -1;
            }
            
            // Then by start date
            $aStart = $a['start_datetime'] ?? ($a['start_date'] ?? '');
            $bStart = $b['start_datetime'] ?? ($b['start_date'] ?? '');
            return strcmp($aStart, $bStart);
          });
          
          // Pagination
          $perPage = 6;
          $page = isset($_GET['events_page']) ? max(1, intval($_GET['events_page'])) : 1;
          $totalEvents = count($events);
          $totalPages = ceil($totalEvents / $perPage);
          $page = min($page, max(1, $totalPages));
          $offset = ($page - 1) * $perPage;
          $paginatedEvents = array_slice($events, $offset, $perPage);
        ?>
        <div class="home-events-grid" role="group" aria-label="Upcoming conferences and events">
          <?php foreach ($paginatedEvents as $ev): ?>
            <?php
            // Check if past event
            $tz = isset($ev['timezone']) ? new DateTimeZone($ev['timezone']) : new DateTimeZone('Africa/Accra');
            $today = new DateTimeImmutable('now', $tz);
            $end = null;
            if (!empty($ev['end_datetime'])) {
              $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $ev['end_datetime'], $tz);
            } elseif (!empty($ev['end_date'])) {
              $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $ev['end_date'] . ' 23:59:59', $tz);
            }
            $isPastEvent = $end ? ($end < $today) : false;
            ?>
            <article class="event-compact-card<?= $isPastEvent ? ' past-event' : '' ?>">
              <div class="event-compact-image">
                <img src="<?= htmlspecialchars($ev['image']) ?>" alt="<?= htmlspecialchars($ev['title']) ?>" loading="lazy">
                <div class="event-image-overlay"></div>
                <?php if ($isPastEvent): ?>
                <span class="event-compact-badge past">Past Event</span>
                <?php elseif (!empty($ev['is_featured'])): ?>
                <span class="event-compact-badge featured">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                  </svg>
                  Featured
                </span>
                <?php else: ?>
                <span class="event-compact-badge upcoming">Upcoming</span>
                <?php endif; ?>
              </div>
              <div class="event-compact-body">
                <div class="event-compact-meta">
                  <span class="compact-date">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <?= htmlspecialchars($ev['date']) ?>
                  </span>
                  <span class="compact-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                      <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <?= htmlspecialchars($ev['location']) ?>
                  </span>
                </div>
                <h3 class="event-compact-title">
                  <a href="event.php?id=<?= urlencode($ev['id']) ?>">
                    <?= htmlspecialchars($ev['title']) ?>
                  </a>
                </h3>
                <p class="event-compact-excerpt"><?= htmlspecialchars(mb_substr($ev['excerpt'], 0, 90)) ?><?= mb_strlen($ev['excerpt']) > 90 ? '...' : '' ?></p>
                <div class="event-compact-actions">
                  <a href="event.php?id=<?= urlencode($ev['id']) ?>" class="btn-compact-learn">
                    Learn More
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                      <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                  </a>
                  <?php if (!empty($ev['registration_url']) && !$isPastEvent): ?>
                  <a href="<?= htmlspecialchars($ev['registration_url']) ?>" class="btn-compact-register" target="_blank" rel="noopener">
                    Register
                  </a>
                  <?php endif; ?>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
        <div class="home-events-pagination">
          <?php if ($page > 1): ?>
            <a href="?events_page=<?= $page - 1 ?>#conferences-events" class="pagination-arrow prev">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
              </svg>
              Previous
            </a>
          <?php endif; ?>

          <div class="pagination-page-numbers">
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);
            
            if ($startPage > 1): ?>
              <a href="?events_page=1#conferences-events" class="page-num">1</a>
              <?php if ($startPage > 2): ?>
                <span class="page-ellipsis">...</span>
              <?php endif; ?>
            <?php endif; ?>

            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
              <a href="?events_page=<?= $i ?>#conferences-events" class="page-num<?= $i === $page ? ' active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($endPage < $totalPages): ?>
              <?php if ($endPage < $totalPages - 1): ?>
                <span class="page-ellipsis">...</span>
              <?php endif; ?>
              <a href="?events_page=<?= $totalPages ?>#conferences-events" class="page-num"><?= $totalPages ?></a>
            <?php endif; ?>
          </div>

          <?php if ($page < $totalPages): ?>
            <a href="?events_page=<?= $page + 1 ?>#conferences-events" class="pagination-arrow next">
              Next
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </a>
          <?php endif; ?>
        </div>
        <?php endif; ?>

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
    <section id="news-media" class="home-news-section" aria-labelledby="news-heading">
      <div class="container">
        <header class="section-header-modern">
          <div class="header-content-wrapper">
            <span class="section-label-badge">Latest Updates</span>
            <h2 id="news-heading" class="section-title-modern">News & Media</h2>
            <p class="section-description">Recent updates, stories and resources from CCE — reports, recaps and media that highlight our work and community.</p>
          </div>
          <a href="news.php" class="view-all-btn">
            View All News
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </header>
        
        <?php
        try {
          $allNews = include __DIR__ . '/data/news.php';
          if (empty($allNews) || !is_array($allNews)) {
            throw new Exception('News data not available');
          }
          
          // Sort by published date descending (newest first)
          usort($allNews, function($a,$b){ 
            $timeA = isset($a['published_at']) ? strtotime($a['published_at']) : 0;
            $timeB = isset($b['published_at']) ? strtotime($b['published_at']) : 0;
            return $timeB <=> $timeA; 
          });
          
          // Pagination settings
          $newsPerPage = 6;
          $currentNewsPage = isset($_GET['news_page']) ? max(1, intval($_GET['news_page'])) : 1;
          $totalNewsItems = count($allNews);
          $totalNewsPages = max(1, ceil($totalNewsItems / $newsPerPage));
          $currentNewsPage = min($currentNewsPage, $totalNewsPages);
          $newsOffset = ($currentNewsPage - 1) * $newsPerPage;
          $newsToDisplay = array_slice($allNews, $newsOffset, $newsPerPage);
          
          if (!empty($newsToDisplay)) {
            echo '<div class="home-news-grid">';
            foreach ($newsToDisplay as $newsItem) {
              $publishedDate = new DateTimeImmutable($newsItem['published_at']);
              ?>
              <article class="news-compact-card">
                <div class="news-compact-image">
                  <img src="<?= htmlspecialchars($newsItem['featured_image']) ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>" loading="lazy">
                  <div class="news-image-overlay"></div>
                </div>
                <div class="news-compact-body">
                  <div class="news-compact-meta">
                    <span class="compact-date">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      <?= $publishedDate->format('M j, Y') ?>
                    </span>
                    <span class="compact-author">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                      <?= htmlspecialchars($newsItem['author']) ?>
                    </span>
                  </div>
                  <h3 class="news-compact-title">
                    <a href="<?= htmlspecialchars($newsItem['link']) ?>"><?= htmlspecialchars($newsItem['title']) ?></a>
                  </h3>
                  <p class="news-compact-excerpt"><?= htmlspecialchars($newsItem['excerpt']) ?></p>
                  <div class="news-compact-actions">
                    <a href="<?= htmlspecialchars($newsItem['link']) ?>" class="btn-compact-read">
                      Read More
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                  </div>
                </div>
              </article>
              <?php
            }
            echo '</div>';
            
            // Pagination
            if ($totalNewsPages > 1) {
              echo '<div class="home-news-pagination">';
              
              // Previous button
              if ($currentNewsPage > 1) {
                $prevPage = $currentNewsPage - 1;
                echo '<a href="?news_page=' . $prevPage . '#news-media" class="pagination-arrow prev">';
                echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>';
                echo 'Previous</a>';
              }
              
              // Page numbers
              echo '<div class="pagination-page-numbers">';
              $range = 2;
              for ($i = 1; $i <= $totalNewsPages; $i++) {
                if ($i == 1 || $i == $totalNewsPages || ($i >= $currentNewsPage - $range && $i <= $currentNewsPage + $range)) {
                  $activeClass = ($i == $currentNewsPage) ? ' active' : '';
                  echo '<a href="?news_page=' . $i . '#news-media" class="page-num' . $activeClass . '">' . $i . '</a>';
                } elseif ($i == $currentNewsPage - $range - 1 || $i == $currentNewsPage + $range + 1) {
                  echo '<span class="page-ellipsis">...</span>';
                }
              }
              echo '</div>';
              
              // Next button
              if ($currentNewsPage < $totalNewsPages) {
                $nextPage = $currentNewsPage + 1;
                echo '<a href="?news_page=' . $nextPage . '#news-media" class="pagination-arrow next">';
                echo 'Next<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
                echo '</a>';
              }
              
              echo '</div>';
            }
          } else {
            echo '<div class="no-content"><p>No news articles available at this time.</p></div>';
          }
        } catch (Exception $e) {
          echo '<div class="error-message"><p>Unable to load news data. Please try again later.</p></div>';
        }
        ?>
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

  // Companies Carousel - Infinite Scroll (Auto-scroll only)
  const companiesCarousel = document.getElementById('companies-carousel');
  if (companiesCarousel) {
    const cards = companiesCarousel.querySelectorAll('.company-carousel-card');
    const cardCount = cards.length / 2; // Original count (duplicated for infinite effect)
    const cardWidth = cards[0].offsetWidth + 32; // Card width + gap
    
    // Auto-scroll
    setInterval(() => {
      companiesCarousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
      
      // Reset to start when reaching duplicated section
      setTimeout(() => {
        if (companiesCarousel.scrollLeft >= cardWidth * cardCount - 50) {
          companiesCarousel.scrollTo({ left: 0, behavior: 'auto' });
        }
      }, 600);
    }, 4000);
  }
});
</script>

