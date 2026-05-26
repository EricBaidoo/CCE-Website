<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
$stmt->execute([$id]);
$company = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$company) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "Company not found.";
    exit;
}

$meta = [
    'title' => $company['name'] . ' - Institutional Partner',
    'description' => 'Institutional Partner of CCE',
];
include 'header.php';
?>

<main class="flex-grow bg-light py-20 min-h-[60vh] flex flex-col justify-center">
    <div class="max-w-4xl mx-auto px-4 w-full">
        
        <div class="bg-white border-t-4 border-secondary p-12 md:p-16 shadow-lg text-center">
            
            <div class="w-48 h-48 md:w-64 md:h-64 mx-auto mb-10 flex items-center justify-center p-8 border border-gray-100 shadow-inner bg-gray-50/50">
                <img src="<?= htmlspecialchars($company['logo'] ?? 'assets/image/placeholder.jpg') ?>" alt="<?= htmlspecialchars($company['name']) ?> Logo" class="max-w-full max-h-full object-contain mix-blend-multiply">
            </div>

            <h1 class="text-primary font-heading font-bold text-4xl mb-4 uppercase tracking-widest"><?= htmlspecialchars($company['name']) ?></h1>
            <p class="text-secondary font-bold tracking-widest uppercase text-sm mb-10">Official Institutional Partner</p>
            
            <div class="max-w-2xl mx-auto prose text-gray-600 font-light text-lg">
                <?php if (!empty($company['description'])): ?>
                    <p><?= nl2br(htmlspecialchars($company['description'])) ?></p>
                <?php else: ?>
                    <p>This organization is part of the Cross-Cutting Excellence (CCE) global network of institutional partners.</p>
                <?php endif; ?>
            </div>

        </div>

        <div class="mt-12 text-center">
            <a href="index" class="inline-flex text-primary font-bold text-sm uppercase tracking-widest hover:text-secondary items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Homepage
            </a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
