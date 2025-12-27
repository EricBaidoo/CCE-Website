<?php
$meta = [
    'title' => 'CCE People',
    'description' => 'Meet the people of the Cross-Cutting Excellence Network.',
];
include 'header.php';
$people = include __DIR__ . '/data/people.php';
?>
<main class="container py-4">
    <section class="mb-4">
        <h1 class="company-name-title">CCE People</h1>
        <p class="company-tagline">Profiles of members and collaborators</p>
    </section>
    <section>
        <div class="row g-3">
            <?php foreach ($people as $person): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <?php $p = $person; $person = $p; include __DIR__ . '/partials/person-card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
