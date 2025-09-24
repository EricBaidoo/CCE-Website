<?php
if (!isset($post)) return;
?>
<article class="news-card" data-news-id="<?= htmlspecialchars($post['id']) ?>" aria-labelledby="news-<?= htmlspecialchars($post['id']) ?>">
    <div class="news-media">
        <img src="<?= htmlspecialchars($post['featured_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
    </div>
    <div class="news-body">
        <h3 id="news-<?= htmlspecialchars($post['id']) ?>"><?= htmlspecialchars($post['title']) ?></h3>
        <p class="meta"><time datetime="<?= htmlspecialchars(date('Y-m-d', strtotime($post['published_at']))) ?>"><?= htmlspecialchars(date('M j, Y', strtotime($post['published_at']))) ?></time> • <?= htmlspecialchars($post['author']) ?></p>
        <p class="news-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
        <p class="news-actions"><a class="news-cta" href="<?= htmlspecialchars($post['link']) ?>">Read more</a></p>
    </div>
</article>
