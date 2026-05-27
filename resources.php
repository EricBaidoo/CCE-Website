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
<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Resources</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Knowledge Base</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-6 leading-none">CURATED RESOURCES</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    Curated guides, toolkits and briefs to empower Christian professionals in their spheres of influence.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-3 mt-12 pt-8 border-t border-white/20">
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold mr-2 mt-2">Filter by Category:</span>
                <?php foreach ($categories as $cat): ?>
                    <span class="bg-white/10 hover:bg-secondary text-white text-xs font-bold uppercase tracking-widest px-4 py-2 border border-white/20 cursor-pointer transition-colors" title="<?= htmlspecialchars($cat['name']) ?>">
                        <?= htmlspecialchars($cat['code']) ?> - <?= htmlspecialchars($cat['name']) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- RESOURCES GRID -->
    <section class="py-20 bg-light">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($resources as $res): ?>
                <article class="bg-white border border-gray-200 p-8 flex flex-col hover:border-secondary transition-colors group shadow-sm">
                    <div class="w-12 h-12 bg-gray-50 border border-gray-100 flex items-center justify-center text-secondary mb-6 group-hover:bg-secondary group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2"><?= htmlspecialchars($res['category']) ?></p>
                    <h3 class="font-heading font-bold text-2xl text-primary mb-3 leading-tight"><?= htmlspecialchars($res['title']) ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-8 flex-grow">
                        <?= htmlspecialchars($res['desc']) ?>
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="<?= htmlspecialchars($res['link']) ?>" class="text-primary font-bold text-xs uppercase tracking-widest hover:text-secondary flex items-center gap-1 transition-colors">
                            Download Resource <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
