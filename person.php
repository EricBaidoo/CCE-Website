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
<main class="container person-profile">
    <article class="person-article">
        <div class="person-grid">
            <img src="<?= htmlspecialchars($found['photo']) ?>" alt="<?= htmlspecialchars($found['name']) ?>" class="person-photo">
            <div>
                <h1 class="person-name"><?= htmlspecialchars($found['name']) ?></h1>
                <p class="people-modal-role"><?= htmlspecialchars($found['role']) ?></p>
                <div class="people-modal-bio"><?= nl2br(htmlspecialchars($found['bio_long'])) ?></div>
                <div class="person-contacts-row">
                    <?php if (!empty($found['email'])): ?>
                        <a href="mailto:<?= htmlspecialchars($found['email']) ?>" class="person-contact-link">Email</a>
                    <?php endif; ?>
                    <?php if (!empty($found['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($found['linkedin']) ?>" target="_blank" rel="noopener" class="person-contact-link">LinkedIn</a>
                    <?php endif; ?>
                </div>
                <p class="person-back"><a href="index.php" class="hero-btn">Back to CCE People</a></p>
            </div>
        </div>
    </article>
</main>
<?php include 'footer.php'; ?>
