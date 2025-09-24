<?php
if (!isset($company)) return;
$logo = $company['logo'];
?>
<article class="company-card" data-company-id="<?= htmlspecialchars($company['id']) ?>">
    <div class="company-logo"><img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($company['name']) ?> logo" loading="lazy"></div>
    <div class="company-body">
        <h3 class="company-name"><?= htmlspecialchars($company['name']) ?></h3>
        <p><?= htmlspecialchars($company['excerpt']) ?></p>
        <p><a class="company-link" href="<?= htmlspecialchars($company['link']) ?>">View partnership</a></p>
        <?php if (!empty($company['owners']) && is_array($company['owners'])): ?>
            <?php
            // load people data and create a map by id
            static $peopleMap = null;
            if ($peopleMap === null) {
                $people = include __DIR__ . '/../data/people.php';
                $peopleMap = [];
                foreach ($people as $p) { $peopleMap[$p['id']] = $p; }
            }
            ?>
          
        <?php endif; ?>
    </div>
</article>
