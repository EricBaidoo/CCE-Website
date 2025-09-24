<?php
// Expect $person variable available in scope
if (!isset($person)) return;
?>
<?php $avatar = 'assets/image/avatars/' . $person['id'] . '-w400.jpg';
if (!file_exists(__DIR__ . '/../' . $avatar)) { $avatar = $person['photo']; }
?>
<article class="person-card" tabindex="0" data-person-id="<?= htmlspecialchars($person['id']) ?>" data-person-name="<?= htmlspecialchars($person['name']) ?>" data-person-role="<?= htmlspecialchars($person['role']) ?>" data-person-photo="<?= htmlspecialchars($avatar) ?>" data-person-bio="<?= htmlspecialchars($person['bio_long']) ?>" data-person-email="<?= htmlspecialchars(isset($person['email']) ? $person['email'] : '') ?>" data-person-linkedin="<?= htmlspecialchars(isset($person['linkedin']) ? $person['linkedin'] : '') ?>">
    <div class="person-avatar"><img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($person['name']) ?>" loading="lazy" decoding="async"></div>
    <div class="person-body">
        <h3 class="person-name"><?= htmlspecialchars($person['name']) ?></h3>
        <p class="person-role"><?= htmlspecialchars($person['role']) ?></p>
        <p class="person-bio"><?= htmlspecialchars($person['bio_short']) ?></p>
        <p><a class="person-link" href="person.php?id=<?= urlencode($person['id']) ?>">View profile</a></p>
    </div>
    <?php if (!empty($person['email']) || !empty($person['linkedin'])): ?>
    <div class="person-contacts" aria-hidden="false">
        <?php if (!empty($person['email'])): ?>
            <a class="contact-email" href="mailto:<?= htmlspecialchars($person['email']) ?>" aria-label="Email <?= htmlspecialchars($person['name']) ?>">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6.5v11A2.5 2.5 0 0 0 5.5 20h13a2.5 2.5 0 0 0 2.5-2.5v-11A2.5 2.5 0 0 0 18.5 4h-13A2.5 2.5 0 0 0 3 6.5z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21 7.2l-9 6-9-6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <span>Email</span>
            </a>
        <?php endif; ?>
        <?php if (!empty($person['linkedin'])): ?>
            <a class="contact-linkedin" href="<?= htmlspecialchars($person['linkedin']) ?>" target="_blank" rel="noopener" aria-label="Open <?= htmlspecialchars($person['name']) ?> on LinkedIn">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="2" stroke="currentColor" stroke-width="1.2"/><path d="M7.5 10.5v6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><circle cx="7.5" cy="7.5" r="1.5" fill="currentColor"/><path d="M11 13.5v3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><path d="M11 10.5c0.9 0 3 0 4.5 0v6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                <span>LinkedIn</span>
            </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</article>
