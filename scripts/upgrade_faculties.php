<?php
$files = glob(__DIR__ . '/faculty-*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Extract pieces using regex
    preg_match('/<title>(.*?) \|/', $content, $titleMatch);
    $metaTitle = $titleMatch[1] ?? 'Faculty Endeavour';
    
    preg_match('/<div class="hero-icon">(.*?)<\/div>/', $content, $iconMatch);
    $icon = $iconMatch[1] ?? 'F';
    
    preg_match('/<h1 class="hero-title">(.*?)<\/h1>/', $content, $h1Match);
    $h1 = $h1Match[1] ?? 'Faculty';
    
    preg_match('/<p class="hero-description">(.*?)<\/p>/', $content, $descMatch);
    $heroDesc = $descMatch[1] ?? '';
    
    preg_match('/<span class="hero-badge">(.*?)<\/span>/', $content, $badgeMatch);
    $badge = $badgeMatch[1] ?? 'FE';
    
    // Extract main content section block
    // We'll just grab everything inside <div class="faculty-content"> ... </div>
    preg_match('/<div class="faculty-content">(.*?)<\/div>\s*<\/main>/s', $content, $bodyMatch);
    $bodyContent = $bodyMatch[1] ?? '';
    
    // Clean up body content (remove old classes, add tailwind)
    $bodyContent = preg_replace('/<section class="content-section[^"]*">/', '<section class="mb-16">', $bodyContent);
    $bodyContent = preg_replace('/<h2>/', '<h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-primary pb-2 inline-block">', $bodyContent);
    $bodyContent = preg_replace('/<p>/', '<p class="text-gray-700 leading-loose text-lg font-light mb-6">', $bodyContent);
    $bodyContent = preg_replace('/<ul class="focus-list">/', '<ul class="list-disc pl-6 space-y-2 text-gray-700 text-lg font-light mb-8">', $bodyContent);
    
    // Fix CTA section if exists
    $bodyContent = preg_replace('/<a href="get-involved" class="cta-button">/', '<a href="get-involved" class="inline-block bg-secondary hover:bg-orange-600 text-white font-bold uppercase tracking-widest px-8 py-4 transition-colors mt-4">', $bodyContent);
    
    // Fix Events Grid
    $bodyContent = str_replace('<div class="events-grid">', '<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">', $bodyContent);
    $bodyContent = str_replace('<div class="event-item">', '<div class="border border-gray-200 p-6 hover:border-secondary transition-colors">', $bodyContent);
    $bodyContent = str_replace('<div class="event-date">', '<div class="text-sm font-bold text-secondary uppercase tracking-widest mb-2">', $bodyContent);
    $bodyContent = preg_replace('/<h3>(.*?)<\/h3>/', '<h3 class="font-heading font-bold text-xl text-primary mb-3">$1</h3>', $bodyContent);

    // Rebuild the file
    $newTemplate = <<<HTML
<?php
\$meta = [
    'title' => '$metaTitle | Cross-Cutting Excellence',
    'description' => '$heroDesc',
];
include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- FACULTY HERO -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 flex items-center justify-center">
            <span class="text-[300px] font-heading font-bold leading-none">$icon</span>
        </div>
        <div class="max-w-5xl mx-auto px-4 relative z-10">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <a href="faculty" class="hover:text-white transition-colors">Faculties</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">$badge</span>
            </nav>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Faculty Endeavour</span>
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1">$badge</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-heading font-bold mb-8 leading-tight max-w-4xl">
                $h1
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                $heroDesc
            </p>
        </div>
    </section>

    <!-- FACULTY CONTENT -->
    <section class="py-12 -mt-20 relative z-20">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white p-8 md:p-12 shadow-xl border border-gray-100 mb-12">
                $bodyContent
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
HTML;

    file_put_contents($file, $newTemplate);
    echo "Upgraded " . basename($file) . "\n";
}
echo "All faculties upgraded.";
?>
