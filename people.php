<?php
require_once __DIR__ . '/config/database.php';

$meta = [
    'title' => 'Global Network & Leadership - CCE',
    'description' => 'Meet the people of the Cross-Cutting Excellence Network, transforming secular institutions through faith-driven leadership.',
];

// Fetch people
$stmt = $pdo->query("SELECT * FROM people ORDER BY name ASC");
$people = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Leadership & Network</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Global Network</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-6 leading-none">LEADERSHIP & NETWORK</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    Profiles of dedicated Christian professionals, consultants, and leaders transforming their spheres of endeavour with the manifold wisdom of God.
                </p>
            </div>
        </div>
    </section>

    <!-- PEOPLE GRID -->
    <section class="py-20 bg-light">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($people as $person): ?>
                <a href="person?id=<?= urlencode($person['id']) ?>" class="bg-white border border-gray-200 p-6 flex flex-col hover:border-secondary transition-colors group shadow-sm hover:shadow-md">
                    <div class="w-24 h-24 mb-6 border-2 border-gray-100 overflow-hidden group-hover:border-secondary transition-colors mx-auto shrink-0">
                        <?php if (!empty($person['photo']) || !empty($person['image'])): ?>
                            <?php $img = !empty($person['image']) ? $person['image'] : $person['photo']; ?>
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($person['name'] ?? '') ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <svg class="w-full h-full text-gray-300 p-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <?php endif; ?>
                    </div>
                    <div class="text-center flex-grow flex flex-col justify-start">
                        <h3 class="font-heading font-bold text-xl text-primary mb-1 line-clamp-2"><?= htmlspecialchars($person['name'] ?? '') ?></h3>
                        <p class="text-secondary text-xs uppercase tracking-widest font-bold mb-2"><?= htmlspecialchars($person['role'] ?? 'CCE Member') ?></p>
                        <?php if (!empty($person['company'])): ?>
                            <p class="text-gray-500 text-sm italic line-clamp-2 mt-auto pt-2"><?= htmlspecialchars($person['company']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-center mt-auto shrink-0">
                        <span class="text-primary font-bold text-xs uppercase tracking-widest group-hover:text-secondary flex items-center gap-1 transition-colors">
                            View Profile <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            
            <?php if (empty($people)): ?>
                <div class="bg-white p-12 text-center border border-gray-200">
                    <p class="text-gray-500">No members found.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
