<?php
require_once __DIR__ . '/config/database.php';

// Pagination settings
$newsPerPage = 9;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $newsPerPage;

// Get total count for pagination
$totalNews = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
$totalPages = max(1, ceil($totalNews / $newsPerPage));
$currentPage = min($currentPage, $totalPages);

// Fetch articles for this page
$stmt = $pdo->prepare("SELECT * FROM news ORDER BY published_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $newsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$newsToDisplay = $stmt->fetchAll(PDO::FETCH_ASSOC);

$meta = [
    'title' => 'News & Reports - CCE Official',
    'description' => 'Latest news, stories and media from Cross-Cutting Excellence (CCE). Stay updated with our latest reports, recaps and announcements.',
    'image' => 'assets/image/logo.webp'
];

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">News & Reports</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Press Center</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-6 leading-none">NEWS & REPORTS</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    Stay updated with the latest stories, policy briefs, and institutional reports from the Cross-Cutting Excellence network.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16 border-t border-white/20 pt-12 max-w-2xl">
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-2"><?= $totalNews ?></div>
                    <div class="text-sm uppercase tracking-widest text-gray-400 font-bold">Published Reports</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-2">24/7</div>
                    <div class="text-sm uppercase tracking-widest text-gray-400 font-bold">Global Updates</div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS GRID -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            
            <?php if (empty($newsToDisplay)): ?>
                <div class="bg-white p-12 text-center border border-gray-200">
                    <h3 class="text-2xl font-heading font-bold text-primary mb-2">No Reports Found</h3>
                    <p class="text-gray-500">There are currently no news articles available. Check back soon.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($newsToDisplay as $newsItem): 
                        $publishedDate = new DateTimeImmutable($newsItem['published_at']);
                    ?>
                    <article class="bg-white border border-gray-200 flex flex-col hover:border-secondary transition-colors group">
                        <div class="relative overflow-hidden h-56 bg-gray-100">
                            <img src="<?= htmlspecialchars($newsItem['featured_image']) ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-0 right-0 bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1 m-4">
                                Article
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 text-xs text-gray-500 font-bold uppercase tracking-wider mb-3">
                                <span><?= $publishedDate->format('M j, Y') ?></span>
                                <span class="border-l border-gray-300 h-3"></span>
                                <span><?= htmlspecialchars($newsItem['author']) ?></span>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-primary mb-3 leading-tight group-hover:text-secondary transition-colors">
                                <a href="news-article?id=<?= urlencode($newsItem['id']) ?>"><?= htmlspecialchars($newsItem['title']) ?></a>
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                <?= htmlspecialchars($newsItem['excerpt']) ?>
                            </p>
                            <div class="border-t border-gray-100 pt-4 mt-auto">
                                <a href="news-article?id=<?= urlencode($newsItem['id']) ?>" class="text-primary font-bold text-xs uppercase tracking-widest hover:text-secondary flex items-center gap-1">
                                    Read Full Report <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="mt-16 flex justify-center items-center gap-2">
                    <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-2 border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-primary font-bold text-sm uppercase tracking-wider">Prev</a>
                    <?php endif; ?>

                    <div class="flex items-center gap-1">
                        <?php
                        $range = 2;
                        for ($i = 1; $i <= $totalPages; $i++):
                            if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $range && $i <= $currentPage + $range)):
                                $activeClass = ($i == $currentPage) ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-600 hover:bg-gray-100';
                        ?>
                            <a href="?page=<?= $i ?>" class="w-10 h-10 flex items-center justify-center border <?= $activeClass ?> font-bold text-sm"><?= $i ?></a>
                        <?php
                            elseif ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1):
                        ?>
                            <span class="text-gray-400 font-bold px-2">...</span>
                        <?php
                            endif;
                        endfor;
                        ?>
                    </div>

                    <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-2 border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-primary font-bold text-sm uppercase tracking-wider">Next</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
