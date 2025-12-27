<?php
$allNews = include __DIR__ . '/data/news.php';

// Sort by published date descending (newest first)
usort($allNews, function($a,$b){ 
    return strtotime($b['published_at']) <=> strtotime($a['published_at']); 
});

// Pagination settings
$newsPerPage = 9;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalNews = count($allNews);
$totalPages = max(1, ceil($totalNews / $newsPerPage));
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $newsPerPage;
$newsToDisplay = array_slice($allNews, $offset, $newsPerPage);

$meta = [
    'title' => 'News & Media - CCE',
    'description' => 'Latest news, stories and media from Cross-Cutting Excellence (CCE). Stay updated with our latest reports, recaps and announcements.',
    'image' => '/CCE/assets/image/logo.jpeg',
    'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $_SERVER['REQUEST_URI'],
    'type' => 'website'
];

include 'header.php';
?>

<main class="news-page">
    <!-- Hero Section -->
    <section class="news-hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-content-wrapper">
            <nav class="news-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">Home</a>
                <span class="separator">/</span>
                <span class="current">News & Media</span>
            </nav>
            
            <div class="news-hero-content">
                <h1 class="news-hero-title">News & Media</h1>
                <p class="news-hero-subtitle">Stay updated with the latest stories, reports, and media from Cross-Cutting Excellence. Discover insights, recaps, and announcements that highlight our work and community impact.</p>
                
                <div class="news-stats">
                    <div class="stat-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                        </svg>
                        <div class="stat-content">
                            <span class="stat-value"><?= count($allNews) ?></span>
                            <span class="stat-label">Articles</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <div class="stat-content">
                            <span class="stat-value">Regular</span>
                            <span class="stat-label">Updates</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Listing Section -->
    <section class="news-listing-section">
        <div class="container">
            <div class="news-grid">
                <?php foreach ($newsToDisplay as $newsItem): 
                    $publishedDate = new DateTimeImmutable($newsItem['published_at']);
                ?>
                <article class="news-article-card">
                    <div class="article-image">
                        <img src="<?= htmlspecialchars($newsItem['featured_image']) ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>" loading="lazy">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="article-content">
                        <div class="article-meta">
                            <span class="article-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <?= $publishedDate->format('M j, Y') ?>
                            </span>
                            <span class="article-author">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <?= htmlspecialchars($newsItem['author']) ?>
                            </span>
                        </div>
                        <h3 class="article-title">
                            <a href="<?= htmlspecialchars($newsItem['link']) ?>"><?= htmlspecialchars($newsItem['title']) ?></a>
                        </h3>
                        <p class="article-excerpt"><?= htmlspecialchars($newsItem['excerpt']) ?></p>
                        <div class="article-actions">
                            <a href="<?= htmlspecialchars($newsItem['link']) ?>" class="btn-read-article">
                                Read Article
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <div class="news-pagination">
                <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="pagination-btn prev">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </a>
                <?php endif; ?>

                <div class="pagination-numbers">
                    <?php
                    $range = 2;
                    for ($i = 1; $i <= $totalPages; $i++):
                        if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $range && $i <= $currentPage + $range)):
                            $activeClass = ($i == $currentPage) ? ' active' : '';
                    ?>
                        <a href="?page=<?= $i ?>" class="pagination-number<?= $activeClass ?>"><?= $i ?></a>
                    <?php
                        elseif ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1):
                    ?>
                        <span class="pagination-ellipsis">...</span>
                    <?php
                        endif;
                    endfor;
                    ?>
                </div>

                <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="pagination-btn next">
                    Next
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
