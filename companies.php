<?php
$meta = [
    'title' => 'CCE Companies',
    'description' => 'Partner organizations and companies connected to the CCE Network.',
];
include 'header.php';
$companies = include __DIR__ . '/data/companies.php';
?>
<main class="companies-page">
    <section class="page-header">
        <h1 class="page-title">Our Partner Companies</h1>
        <p class="page-subtitle">Transforming industries through excellence, innovation, and principled leadership across Ghana and Africa</p>
    </section>
    <section class="companies-grid">
        <?php foreach ($companies as $company): ?>
            <a href="company.php?id=<?= htmlspecialchars($company['id']) ?>" class="company-card">
                <div class="company-card-logo">
                    <img src="<?= htmlspecialchars($company['logo']) ?>" alt="<?= htmlspecialchars($company['name']) ?> logo" loading="lazy">
                </div>
                <div class="company-card-body">
                    <h3 class="company-card-title"><?= htmlspecialchars($company['name']) ?></h3>
                    <p class="company-card-desc"><?= htmlspecialchars($company['excerpt']) ?></p>
                    <span class="company-card-link">Learn more</span>
                </div>
            </a>
        <?php endforeach; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
