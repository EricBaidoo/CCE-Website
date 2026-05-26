<?php
require_once __DIR__ . '/config/database.php';

// Read filters from query
$status = isset($_GET['status']) ? $_GET['status'] : 'upcoming'; // upcoming | past | all
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Build Query
$whereClauses = [];
$params = [];

if ($status === 'upcoming') {
    $whereClauses[] = "(end_date >= CURDATE() OR (end_date IS NULL AND start_date >= CURDATE()) OR start_date IS NULL)";
} elseif ($status === 'past') {
    $whereClauses[] = "(end_date < CURDATE() OR (end_date IS NULL AND start_date < CURDATE())) AND start_date IS NOT NULL";
}

if (!empty($q)) {
    $whereClauses[] = "(title LIKE :q OR excerpt LIKE :q OR location LIKE :q)";
    $params[':q'] = "%{$q}%";
}

$whereSql = '';
if (!empty($whereClauses)) {
    $whereSql = "WHERE " . implode(' AND ', $whereClauses);
}

// Order: Featured first, then start_date (asc for upcoming, desc for past)
$orderSql = "ORDER BY is_featured DESC";
if ($status === 'past') {
    $orderSql .= ", start_date DESC";
} else {
    $orderSql .= ", start_date ASC";
}

$stmt = $pdo->prepare("SELECT * FROM events $whereSql $orderSql");
$stmt->execute($params);
$filtered = $stmt->fetchAll(PDO::FETCH_ASSOC);

$meta = [
    'title' => 'Events & Conferences - CCE',
    'description' => 'Explore upcoming and past events, workshops, and conferences by the Cross-Cutting Excellence Network.',
    'image' => '/CCE/assets/image/logo.webp'
];

include 'header.php';
?>

<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Events & Conferences</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Global Gatherings</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold mb-6 leading-none">EVENTS & CONFERENCES</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    Join us at upcoming summits, workshops, and conferences designed to equip Christian professionals for transformative leadership.
                </p>
            </div>
        </div>
    </section>

    <!-- FILTER BAR -->
    <section class="bg-light border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <form method="get" action="events" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <select name="status" class="bg-white border border-gray-300 text-gray-700 text-sm font-bold uppercase tracking-wider rounded-none px-4 py-2 focus:ring-secondary focus:border-secondary" onchange="this.form.submit()">
                            <option value="upcoming" <?= $status==='upcoming'?'selected':'' ?>>Upcoming Events</option>
                            <option value="past" <?= $status==='past'?'selected':'' ?>>Past Events</option>
                            <option value="all" <?= $status==='all'?'selected':'' ?>>All Events</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 w-full md:w-1/3">
                    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search events..." class="w-full bg-white border border-gray-300 text-gray-700 text-sm px-4 py-2 focus:ring-secondary focus:border-secondary">
                    <button type="submit" class="bg-primary hover:bg-indigo-900 text-white px-4 py-2 font-bold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- EVENTS GRID -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="mb-8 text-sm uppercase tracking-widest text-gray-500 font-bold border-b border-gray-200 pb-4">
                Found <?= count($filtered) ?> Event<?= count($filtered) !== 1 ? 's' : '' ?>
            </div>

            <?php if (empty($filtered)): ?>
                <div class="bg-gray-50 p-12 text-center border border-gray-200">
                    <h3 class="text-2xl font-heading font-bold text-primary mb-2">No Events Found</h3>
                    <p class="text-gray-500 mb-6">We couldn't find any events matching your criteria.</p>
                    <a href="events" class="inline-block border border-gray-300 bg-white text-gray-700 font-bold text-sm uppercase tracking-wider px-6 py-2 hover:bg-gray-100 transition-colors">Reset Filters</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <?php foreach ($filtered as $event): 
                        $isPastEvent = false;
                        if (!empty($event['end_date'])) {
                            $isPastEvent = (strtotime($event['end_date']) < time());
                        } elseif (!empty($event['start_date'])) {
                            $isPastEvent = (strtotime($event['start_date']) < time());
                        }
                    ?>
                    <article class="flex flex-col sm:flex-row bg-white border border-gray-200 hover:border-secondary transition-colors group relative">
                        <!-- Badges -->
                        <div class="absolute top-0 left-0 z-10 flex flex-col gap-2 p-3">
                            <?php if ($event['is_featured']): ?>
                                <span class="bg-secondary text-white text-[10px] font-bold uppercase tracking-widest px-2 py-1 shadow-sm">Featured</span>
                            <?php endif; ?>
                            <?php if ($isPastEvent): ?>
                                <span class="bg-gray-800 text-white text-[10px] font-bold uppercase tracking-widest px-2 py-1 shadow-sm">Past Event</span>
                            <?php endif; ?>
                        </div>

                        <!-- Image -->
                        <div class="w-full sm:w-2/5 h-64 sm:h-auto relative overflow-hidden bg-gray-100 shrink-0">
                            <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 sm:p-8 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 text-xs text-secondary font-bold uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span><?= htmlspecialchars($event['date_display']) ?></span>
                            </div>
                            
                            <?php if (!empty($event['location'])): ?>
                            <div class="flex items-start gap-2 text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span><?= htmlspecialchars($event['location']) ?></span>
                            </div>
                            <?php endif; ?>

                            <h3 class="text-2xl font-heading font-bold text-primary mb-3 leading-tight group-hover:text-secondary transition-colors">
                                <a href="event?id=<?= urlencode($event['id']) ?>" class="focus:outline-none">
                                    <span class="absolute inset-0 z-0"></span>
                                    <?= htmlspecialchars($event['title']) ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                <?= htmlspecialchars(mb_substr($event['excerpt'], 0, 150)) ?><?= mb_strlen($event['excerpt']) > 150 ? '...' : '' ?>
                            </p>
                            
                            <div class="flex items-center gap-4 mt-auto relative z-10">
                                <a href="event?id=<?= urlencode($event['id']) ?>" class="text-primary font-bold text-xs uppercase tracking-widest hover:text-secondary flex items-center gap-1 border-b-2 border-primary hover:border-secondary pb-1 transition-colors">
                                    Event Details
                                </a>
                                <?php if (!empty($event['registration_url']) && !$isPastEvent): ?>
                                <a href="<?= htmlspecialchars($event['registration_url']) ?>" target="_blank" rel="noopener" class="bg-secondary hover:bg-orange-600 text-white font-bold text-xs uppercase tracking-widest px-4 py-2 transition-colors">
                                    Register Now
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
