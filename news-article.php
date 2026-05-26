<?php
require_once __DIR__ . '/config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: news.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    header("Location: news.php");
    exit;
}

$publishedDate = new DateTimeImmutable($article['published_at']);

$meta = [
    'title' => $article['title'] . ' - CCE News',
    'description' => $article['excerpt'],
    'image' => '/CCE/' . ltrim($article['featured_image'], '/')
];

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- ARTICLE HERO -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32">
        <div class="max-w-4xl mx-auto px-4">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <a href="news" class="hover:text-white transition-colors">News</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white truncate w-32 md:w-auto">Article</span>
            </nav>
            
            <span class="inline-block bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Report</span>
            <h1 class="text-4xl md:text-6xl font-heading font-bold mb-8 leading-tight">
                <?= htmlspecialchars($article['title']) ?>
            </h1>
            
            <div class="flex items-center gap-4 text-sm uppercase tracking-widest text-gray-300 font-bold border-t border-white/20 pt-6">
                <span>By <?= htmlspecialchars($article['author']) ?></span>
                <span class="border-l border-gray-500 h-4"></span>
                <span><?= $publishedDate->format('F j, Y') ?></span>
            </div>
        </div>
    </section>

    <!-- ARTICLE CONTENT -->
    <section class="py-12 -mt-20">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white p-2 md:p-4 shadow-xl border border-gray-100 mb-12">
                <img src="<?= htmlspecialchars($article['featured_image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-auto max-h-[600px] object-cover">
            </div>
            
            <div class="prose max-w-none text-gray-700 leading-loose text-lg font-light mb-16">
                <!-- EXCERPT INTRO -->
                <p class="text-2xl text-primary font-medium mb-8 leading-relaxed">
                    <?= htmlspecialchars($article['excerpt']) ?>
                </p>
                
                <!-- MAIN HTML CONTENT -->
                <div class="content-body">
                    <?= $article['content'] ?>
                </div>
            </div>
            
            <!-- BACK BUTTON -->
            <div class="border-t border-gray-200 pt-8 pb-12">
                <a href="news" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-primary font-bold uppercase tracking-widest text-sm py-3 px-8 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back to News
                </a>
            </div>
        </div>
    </section>
</main>

<style>
    .content-body p { margin-bottom: 1.5rem; }
    .content-body h2 { font-family: 'Oswald', sans-serif; font-size: 1.875rem; color: #251A5A; margin-top: 3rem; margin-bottom: 1rem; text-transform: uppercase; }
    .content-body h3 { font-family: 'Oswald', sans-serif; font-size: 1.5rem; color: #251A5A; margin-top: 2rem; margin-bottom: 1rem; }
    .content-body ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; }
    .content-body li { margin-bottom: 0.5rem; }
    .content-body blockquote { border-left: 4px solid #E07A2A; padding-left: 1rem; font-style: italic; color: #4B5563; margin-bottom: 1.5rem; }
</style>

<?php include 'footer.php'; ?>
