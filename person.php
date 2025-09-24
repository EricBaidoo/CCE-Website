<?php
// Simple profile page fallback for each person
$id = isset($_GET['id']) ? $_GET['id'] : null;
$people = include __DIR__ . '/data/people.php';
$found = null;
foreach ($people as $p) {
    if ($p['id'] === $id) { $found = $p; break; }
}
if (!$found) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Profile Not Found</title></head><body><h1>Profile not found</h1><p>The requested profile does not exist.</p><p><a href="index.php">Return</a></p></body></html>';
    exit;
}
?>
<?php include 'header.php'; ?>
<main class="container" style="padding:4vh 2rem;">
    <article style="max-width:62rem;margin:0 auto;background:#fff;padding:2rem;border-radius:8px;box-shadow:0 8px 24px rgba(0,0,0,0.06);">
        <div style="display:grid;grid-template-columns:160px 1fr;gap:1.4rem;align-items:start;">
            <img src="<?= htmlspecialchars($found['photo']) ?>" alt="<?= htmlspecialchars($found['name']) ?>" style="width:160px;height:160px;object-fit:cover;border-radius:8px;">
            <div>
                <h1 style="margin:0"><?= htmlspecialchars($found['name']) ?></h1>
                <p style="color:#666;margin:0.4rem 0 1rem 0"><?= htmlspecialchars($found['role']) ?></p>
                <div style="color:#222;line-height:1.6"><?= nl2br(htmlspecialchars($found['bio_long'])) ?></div>
                <div style="margin-top:1.2rem;">
                    <?php if (!empty($found['email'])): ?>
                        <a href="mailto:<?= htmlspecialchars($found['email']) ?>" style="margin-right:1rem;">Email</a>
                    <?php endif; ?>
                    <?php if (!empty($found['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($found['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn</a>
                    <?php endif; ?>
                </div>
                <p style="margin-top:1.2rem;"><a href="index.php" class="hero-btn">Back to CCE People</a></p>
            </div>
        </div>
    </article>
</main>
<?php include 'footer.php'; ?>
