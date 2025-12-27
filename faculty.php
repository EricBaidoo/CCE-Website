<?php
$meta = [
    'title' => 'CCE Faculty Endeavours',
    'description' => 'Eight faculties mobilizing Christian professionals to transform institutions with excellence.',
];
include 'header.php';

$faculties = [
    ['code' => 'GAD', 'name' => 'Governance & Development', 'desc' => 'Ethical governance, policy and institutional reform.', 'icon' => 'G'],
    ['code' => 'EAT', 'name' => 'Education & Training', 'desc' => 'Pedagogy, curriculum and professional development.', 'icon' => 'E'],
    ['code' => 'SAT', 'name' => 'Science & Technology', 'desc' => 'Evidence, innovation and responsible tech adoption.', 'icon' => 'S'],
    ['code' => 'PAA', 'name' => 'Philosophy & the Arts', 'desc' => 'Christian thought informing culture and creativity.', 'icon' => 'P'],
    ['code' => 'FAB', 'name' => 'Finance & Business', 'desc' => 'Stewardship, entrepreneurship and market integrity.', 'icon' => 'F'],
    ['code' => 'RAF', 'name' => 'Relationship & Family', 'desc' => 'Wholesome communities and family flourishing.', 'icon' => 'R'],
    ['code' => 'MAA', 'name' => 'Missions & Apologetics', 'desc' => 'Witness, defense of truth and service.', 'icon' => 'M'],
    ['code' => 'CAM', 'name' => 'Communication & Media', 'desc' => 'Narratives, public discourse and media excellence.', 'icon' => 'C'],
];
?>
<main class="faculty-page">
    <section class="page-header">
        <h1 class="page-title">Faculty Endeavours</h1>
        <p class="page-subtitle">Eight faculties working in concert to reclaim and transform secular institutions through godly wisdom and professional excellence</p>
    </section>
    <section class="faculty-grid">
        <?php foreach ($faculties as $fac): ?>
            <article class="faculty-card">
                <div class="faculty-icon"><?= htmlspecialchars($fac['icon']) ?></div>
                <p class="faculty-code"><?= htmlspecialchars($fac['code']) ?></p>
                <h3 class="faculty-name"><?= htmlspecialchars($fac['name']) ?></h3>
                <p class="faculty-desc"><?= htmlspecialchars($fac['desc']) ?></p>
            </article>
        <?php endforeach; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
