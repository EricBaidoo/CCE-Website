<?php
$news = include __DIR__ . '/data/news.php';

// If id is provided, prepare single post meta; otherwise prepare listing meta
$id = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;
if ($id) {
    foreach ($news as $n) { if ($n['id'] === $id) { $post = $n; break; } }
}

if ($post) {
    $meta = [
        'title' => $post['title'],
        'description' => $post['excerpt'] ?? '',
        'image' => $post['featured_image'] ?? '/CCE/assets/image/logo.jpeg',
        'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $_SERVER['REQUEST_URI'],
        'type' => 'article'
    ];
    // JSON-LD for NewsArticle
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'headline' => $post['title'],
        'image' => [$post['featured_image'] ?? '/CCE/assets/image/logo.jpeg'],
        'datePublished' => $post['published_at'],
        'author' => ['@type' => 'Person', 'name' => $post['author'] ?? 'CCE'],
        'description' => $post['excerpt'] ?? ''
    ];
    $meta['json_ld'] = json_encode($jsonld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
} else {
    $meta = [
        'title' => 'News & Media - CCE',
        'description' => 'Latest news, stories and media from Cross-Cutting Excellence (CCE).',
        'image' => '/CCE/assets/image/logo.jpeg',
        'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $_SERVER['REQUEST_URI'],
        'type' => 'website'
    ];
}

include 'header.php';
?>

<main>
    <section class="news-listing container">
        <div class="section-header">
            <h1>News & Media</h1>
            <p class="lead">Recent updates, stories and resources from CCE.</p>
        </div>

        <?php
        // If id is provided, show single post
        if ($post) {
            ?>
            <article class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p class="meta"><?= htmlspecialchars(date('F j, Y', strtotime($post['published_at']))) ?> • <?= htmlspecialchars($post['author']) ?></p>
                <?php if (!empty($post['featured_image'])): ?>
                    <div class="post-media"><img src="<?= htmlspecialchars($post['featured_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"></div>
                <?php endif; ?>
                <div class="post-content"><?= $post['content'] ?></div>
                <p><a href="news.php">Back to news</a></p>
            </article>
            <?php
        } else {
            // listing view
            usort($news, function($a,$b){ return strtotime($b['published_at']) <=> strtotime($a['published_at']); });
            echo '<div class="news-grid">';
            foreach ($news as $n) { $post = $n; include __DIR__ . '/partials/news-card.php'; }
            echo '</div>';
        }
        ?>

    </section>
</main>

<?php include 'footer.php'; ?>
