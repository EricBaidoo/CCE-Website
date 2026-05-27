<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM people WHERE id = ?");
$stmt->execute([$id]);
$person = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$person) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "Person not found.";
    exit;
}

$meta = [
    'title' => $person['name'] . ' - CCE Profile',
    'description' => $person['role'] . ' at ' . ($person['company'] ?? 'CCE'),
];
include 'header.php';
?>

<main class="flex-grow bg-light py-20">
    <div class="max-w-4xl mx-auto px-4">
        
        <div class="bg-white border border-gray-200 p-8 md:p-12 shadow-sm">
            <div class="flex flex-col md:flex-row gap-10 items-start">
                
                <!-- Portrait -->
                <div class="w-48 h-48 md:w-64 md:h-64 shrink-0 border-4 border-white shadow-lg overflow-hidden bg-gray-100">
                    <?php if (!empty($person['photo']) || !empty($person['image'])): ?>
                        <?php $img = !empty($person['image']) ? $person['image'] : $person['photo']; ?>
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($person['name']) ?>" class="w-full h-full object-cover object-top">
                    <?php else: ?>
                        <svg class="w-full h-full text-gray-300 p-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <?php endif; ?>
                </div>

                <!-- Details -->
                <div class="flex-1">
                    <h1 class="text-primary font-heading font-bold text-4xl mb-2 uppercase tracking-wide"><?= htmlspecialchars($person['name']) ?></h1>
                    
                    <div class="border-b-2 border-secondary pb-4 mb-6 inline-block">
                        <p class="text-secondary font-bold tracking-widest uppercase text-sm"><?= htmlspecialchars($person['role'] ?? 'CCE Member') ?></p>
                        <?php if (!empty($person['company'])): ?>
                            <p class="text-gray-500 text-sm mt-1 uppercase tracking-wider"><?= htmlspecialchars($person['company']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg font-light mb-8">
                        <p><?= nl2br(htmlspecialchars($person['bio_short'] ?? 'No biography available at this time.')) ?></p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <?php if (!empty($person['email'])): ?>
                        <a href="mailto:<?= htmlspecialchars($person['email']) ?>" class="bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-6 uppercase tracking-widest text-xs transition-colors flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Email
                        </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($person['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($person['linkedin']) ?>" target="_blank" class="bg-gray-800 hover:bg-black text-white font-bold py-3 px-6 uppercase tracking-widest text-xs transition-colors flex items-center gap-2 shadow-sm">
                            LinkedIn
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="mt-8 text-center md:text-left">
            <a href="index" class="inline-flex text-primary font-bold text-sm uppercase tracking-widest hover:text-secondary items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Homepage
            </a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
