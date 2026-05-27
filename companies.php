<?php
require_once __DIR__ . '/config/database.php';

$meta = [
    'title' => 'CCE Corporate Business Alliances',
    'description' => 'Partner organizations and companies connected to the CCE Network, transforming industries through excellence and principled leadership.',
];

// Fetch companies
$stmt = $pdo->query("SELECT * FROM companies ORDER BY name ASC");
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Corporate Alliances</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Institutional Partners</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-6 leading-none">CORPORATE BUSINESS ALLIANCES</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    Transforming industries through excellence, innovation, and principled leadership across Africa and beyond.
                </p>
            </div>
        </div>
    </section>

    <!-- COMPANIES GRID -->
    <section class="py-20 bg-light">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($companies as $company): ?>
                <a href="company?id=<?= urlencode($company['id']) ?>" class="bg-white border border-gray-200 p-8 flex flex-col hover:border-secondary transition-all group shadow-sm hover:shadow-md hover:-translate-y-1">
                    <div class="h-32 mb-8 flex items-center justify-center p-4 border border-gray-100 bg-gray-50 group-hover:bg-white transition-colors mx-auto w-full">
                        <img src="<?= htmlspecialchars($company['logo'] ?? 'assets/image/companies-and-people/cce-logo.webp') ?>" alt="<?= htmlspecialchars($company['name'] ?? 'Company') ?> Logo" class="max-h-full max-w-full object-contain mix-blend-multiply">
                    </div>
                    <div class="flex-grow flex flex-col">
                        <h3 class="font-heading font-bold text-2xl text-primary mb-3 leading-tight"><?= htmlspecialchars($company['name']) ?></h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            <?= htmlspecialchars($company['description'] ?? 'This organization is part of the Cross-Cutting Excellence (CCE) global network of institutional partners.') ?>
                        </p>
                    </div>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <span class="text-secondary font-bold text-xs uppercase tracking-widest group-hover:text-primary flex items-center justify-between transition-colors w-full">
                            Learn More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            
            <?php if (empty($companies)): ?>
                <div class="bg-white p-12 text-center border border-gray-200">
                    <p class="text-gray-500">No partner companies found.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
