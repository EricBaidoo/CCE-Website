<?php
$meta = [
    'title' => 'CCE Resources',
    'description' => 'Curated resources across governance, education, technology, philosophy, finance, family, missions, and media.',
];
include 'header.php';

$categories = [
    ['code' => 'POL', 'name' => 'Policy'],
    ['code' => 'LAW', 'name' => 'Law'],
    ['code' => 'CAB', 'name' => 'Capacity Building & Advocacy'],
    ['code' => 'ACT', 'name' => 'Direct Action'],
    ['code' => 'KM',  'name' => 'Knowledge Management'],
];

$resources = [
    ['title' => 'Governance Toolkit', 'category' => 'Policy', 'desc' => 'Practical frameworks for ethical governance in public institutions.', 'link' => '#'],
    ['title' => 'Legal Briefs Compendium', 'category' => 'Law', 'desc' => 'Summaries of relevant statutes and case law for practitioners.', 'link' => '#'],
    ['title' => 'Capacity Building Guide', 'category' => 'Capacity Building & Advocacy', 'desc' => 'Designing training programmes and monitoring impact.', 'link' => '#'],
    ['title' => 'Action Playbook', 'category' => 'Direct Action', 'desc' => 'Steps for principled interventions in complex environments.', 'link' => '#'],
    ['title' => 'KM Templates', 'category' => 'Knowledge Management', 'desc' => 'Templates for documentation, learning loops and scaling.', 'link' => '#'],
];
?>
<main class="resources-page">
    <section class="page-header">
        <h1 class="page-title">Resources</h1>
        <p class="page-subtitle">Curated guides, toolkits and briefs to empower Christian professionals in their spheres of influence</p>
        <div class="category-badges">
            <?php foreach ($categories as $cat): ?>
                <span class="category-badge" title="<?= htmlspecialchars($cat['name']) ?>"><?= htmlspecialchars($cat['code']) ?></span>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="resources-grid">
        <?php foreach ($resources as $res): ?>
            <article class="resource-card">
                <div class="resource-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="resource-category"><?= htmlspecialchars($res['category']) ?></p>
                <h3 class="resource-title"><?= htmlspecialchars($res['title']) ?></h3>
                <p class="resource-desc"><?= htmlspecialchars($res['desc']) ?></p>
                <a href="<?= htmlspecialchars($res['link']) ?>" class="resource-link">View resource</a>
            </article>
        <?php endforeach; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
