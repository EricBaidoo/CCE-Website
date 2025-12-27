<?php
if (!isset($company)) return;
$logo = $company['logo'];
?>
<a class="company-card company-link-card" href="company.php?id=<?= htmlspecialchars($company['id']) ?>" data-company-id="<?= htmlspecialchars($company['id']) ?>" tabindex="0">
    <div class="company-logo"><img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($company['name']) ?> logo" loading="lazy"></div>
    <div class="company-body">
        <h3 class="company-name"><?= htmlspecialchars($company['name']) ?></h3>
    </div>
</a>
