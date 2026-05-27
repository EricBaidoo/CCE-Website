<?php
require_once __DIR__ . '/config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: events.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    header("Location: events.php");
    exit;
}

// Determine if past
$isPastEvent = false;
if (!empty($event['end_date'])) {
    $isPastEvent = (strtotime($event['end_date']) < time());
} elseif (!empty($event['start_date'])) {
    $isPastEvent = (strtotime($event['start_date']) < time());
}

$meta = [
    'title' => $event['title'] . ' - CCE Event',
    'description' => $event['excerpt'],
    'image' => '/CCE/' . ltrim($event['image'], '/')
];

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- EVENT HERO -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32">
        <div class="max-w-5xl mx-auto px-4">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <a href="events" class="hover:text-white transition-colors">Events</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white truncate w-32 md:w-auto">Event Details</span>
            </nav>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Conference</span>
                <?php if ($isPastEvent): ?>
                    <span class="inline-block bg-gray-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Past Event</span>
                <?php endif; ?>
            </div>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-8 leading-tight max-w-4xl">
                <?= htmlspecialchars($event['title']) ?>
            </h1>
        </div>
    </section>

    <!-- EVENT CONTENT -->
    <section class="py-12 -mt-20">
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- LEFT MAIN CONTENT -->
            <div class="lg:col-span-2">
                <div class="bg-white p-2 shadow-xl border border-gray-100 mb-12">
                    <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-auto object-cover">
                </div>
                
                <div class="prose max-w-none text-gray-700 leading-loose text-lg font-light mb-16">
                    <h2 class="font-heading font-bold text-3xl text-primary mb-6 border-b-2 border-primary pb-2 inline-block">ABOUT THIS EVENT</h2>
                    <p class="text-xl mb-8 leading-relaxed font-medium">
                        <?= htmlspecialchars($event['excerpt']) ?>
                    </p>
                    
                    <!-- We can render full content here if we add a content field to events later, for now we show the excerpt -->
                </div>
                
                <!-- BACK BUTTON -->
                <div class="border-t border-gray-200 pt-8 pb-12">
                    <a href="events" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-primary font-bold uppercase tracking-widest text-sm py-3 px-8 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Back to All Events
                    </a>
                </div>
            </div>

            <!-- RIGHT SIDEBAR (Sticky) -->
            <div class="lg:col-span-1">
                <div class="sticky top-32 bg-light border-t-4 border-secondary p-8 shadow-sm">
                    <h3 class="font-heading font-bold text-2xl text-primary mb-6 border-b border-gray-200 pb-4">Event Information</h3>
                    
                    <div class="space-y-6">
                        <!-- Date -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white border border-gray-200 flex items-center justify-center shrink-0 text-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-1">Date & Time</h4>
                                <p class="text-primary font-medium"><?= htmlspecialchars($event['date_display']) ?></p>
                                <?php if (!empty($event['timezone'])): ?>
                                <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($event['timezone']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white border border-gray-200 flex items-center justify-center shrink-0 text-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-1">Location</h4>
                                <p class="text-primary font-medium"><?= !empty($event['location']) ? htmlspecialchars($event['location']) : 'Virtual / TBD' ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($event['registration_url'])): ?>
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <?php if (!$isPastEvent): ?>
                                <a href="<?= htmlspecialchars($event['registration_url']) ?>" target="_blank" rel="noopener" class="block w-full text-center bg-secondary hover:bg-orange-600 text-white font-bold uppercase tracking-widest py-4 transition-colors shadow-lg">
                                    Register Now
                                </a>
                                <p class="text-xs text-gray-500 text-center mt-3">Link opens in a new tab</p>
                            <?php else: ?>
                                <button disabled class="block w-full text-center bg-gray-300 text-gray-500 font-bold uppercase tracking-widest py-4 cursor-not-allowed">
                                    Registration Closed
                                </button>
                                <p class="text-xs text-gray-500 text-center mt-3">This event has already occurred.</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <p class="text-sm text-gray-600 leading-relaxed italic">
                            For inquiries regarding this event, please contact the CCE organizing team via our contact page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
