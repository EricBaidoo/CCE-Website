<?php
// Company profile page
$id = isset($_GET['id']) ? $_GET['id'] : null;
$companies = include __DIR__ . '/data/companies.php';
$found = null;
foreach ($companies as $c) {
    if ($c['id'] === $id) { $found = $c; break; }
}
if (!$found) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Company Not Found</title></head><body><h1>Company not found</h1><p>The requested company does not exist.</p><p><a href="index.php">Return</a></p></body></html>';
    exit;
}

// Load people data to show company owners
$people = include __DIR__ . '/data/people.php';
$owners = [];
if (!empty($found['owners'])) {
    foreach ($people as $p) {
        if (in_array($p['id'], $found['owners'])) {
            $owners[] = $p;
        }
    }
}
?>
<?php include 'header.php'; ?>
<main class="container company-profile">
    <article class="company-article">
        <div class="company-grid">
            <div class="company-sidebar">
                <div class="company-logo-wrapper">
                    <img src="<?= htmlspecialchars($found['logo']) ?>" alt="<?= htmlspecialchars($found['name']) ?> logo" class="company-logo-large">
                </div>
            </div>
            <div class="company-content">
                <h1 class="company-name-title"><?= htmlspecialchars($found['name']) ?></h1>
                
                <?php if (!empty($found['tagline'])): ?>
                    <p class="company-tagline"><?= htmlspecialchars($found['tagline']) ?></p>
                <?php endif; ?>

                <?php if (!empty($found['description'])): ?>
                    <div class="company-description">
                        <h2 class="company-section-heading">About</h2>
                        <p><?= htmlspecialchars($found['description']) ?></p>
                    </div>
                <?php elseif (!empty($found['excerpt'])): ?>
                    <div class="company-description">
                        <h2 class="company-section-heading">About</h2>
                        <p><?= htmlspecialchars($found['excerpt']) ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($owners)): ?>
                    <div class="company-team-section">
                        <h2 class="company-section-heading">Key Contacts</h2>
                        <div class="company-team-grid">
                            <?php foreach ($owners as $owner): ?>
                                <a href="person.php?id=<?= htmlspecialchars($owner['id']) ?>" class="company-team-member">
                                    <img src="<?= htmlspecialchars($owner['photo']) ?>" alt="<?= htmlspecialchars($owner['name']) ?>" class="company-team-photo">
                                    <div class="company-team-info">
                                        <h3 class="company-team-name"><?= htmlspecialchars($owner['name']) ?></h3>
                                        <p class="company-team-role"><?= htmlspecialchars($owner['role']) ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="company-actions">
                    <?php if (!empty($found['website'])): ?>
                        <a href="<?= htmlspecialchars($found['website']) ?>" target="_blank" rel="noopener noreferrer" class="hero-btn hero-btn-primary">Visit Website</a>
                    <?php endif; ?>
                    <a href="index.php#companies" class="hero-btn">Back to Companies</a>
                </div>
            </div>
        </div>
    </article>
</main>
<?php include 'footer.php'; ?>
