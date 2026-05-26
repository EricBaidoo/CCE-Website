<?php
require_once 'config/database.php';
$meta = [
    'title' => 'Science & Technology | Faculty Endeavour | CCE',
    'description' => 'Christian professional scientist and technologist are provided with further resources to position them at the cutting edge of explorative science and innovative technology which is both ethical and godly.',
];
include 'header.php';

// Fetch Faculty Leader
$leaderStmt = $pdo->prepare("SELECT * FROM people WHERE faculty_id = ? LIMIT 1");
$leaderStmt->execute(['sat']);
$leader = $leaderStmt->fetch();

// Fetch Recent & Upcoming Events for this Faculty
$eventsStmt = $pdo->prepare("SELECT * FROM events WHERE faculty_id = ? ORDER BY start_date DESC LIMIT 3");
$eventsStmt->execute(['sat']);
$events = $eventsStmt->fetchAll();

// Fetch Latest News for this Faculty
$newsStmt = $pdo->prepare("SELECT * FROM news WHERE faculty_id = ? ORDER BY published_at DESC LIMIT 3");
$newsStmt->execute(['sat']);
$news = $newsStmt->fetchAll();
?>

<main class="flex-grow bg-white">
    <!-- FACULTY HERO -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 flex items-center justify-center pointer-events-none">
            <span class="text-[250px] md:text-[400px] font-heading font-bold leading-none tracking-tighter">SAT</span>
        </div>
        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <a href="faculty" class="hover:text-white transition-colors">Faculties</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">SAT</span>
            </nav>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Faculty Endeavour</span>
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1">SAT</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-heading font-bold mb-6 leading-tight max-w-4xl">
                Science & Technology
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                Christian professional scientist and technologist are provided with further resources to position them at the cutting edge of explorative science and innovative technology which is both ethical and godly.
            </p>
        </div>
    </section>

    <!-- FACULTY CONTENT -->
    <section class="py-16 -mt-20 relative z-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Main Content Area -->
                <div class="lg:w-2/3 bg-white p-8 md:p-12 shadow-xl border border-gray-100">
                    <div class="mb-12">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">VISION & MISSION</h2>
                        <p class="text-gray-700 leading-loose text-lg font-light">
                            Innovation drives the modern world. In the Science & Technology (SAT) faculty, we challenge Christian professionals to be at the forefront of scientific discovery and technological advancement. We emphasize that God is the author of science, and technology should be harnessed ethically to solve human problems and glorify the Creator.
                        </p>
                    </div>

                    <div class="mb-12">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">KEY OBJECTIVES</h2>
                        <ul class="list-disc pl-6 space-y-4 text-gray-700 text-lg font-light marker:text-secondary">
                            <li>Promote ethical research and innovation in STEM fields.</li>
                                <li>Equip tech professionals to build solutions that address real-world challenges.</li>
                                <li>Foster discussions on the intersection of faith, science, and bioethics.</li>
                                <li>Provide mentorship for young Christian scientists and engineers.</li>
                                
                        </ul>
                    </div>
                    
                    <?php if($events): ?>
                    <div class="mt-16 pt-12 border-t border-gray-100">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-secondary pb-2 inline-block">RECENT & UPCOMING EVENTS</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach($events as $event): ?>
                            <a href="event?id=<?= $event['id'] ?>" class="block group border border-gray-200 hover:border-secondary transition-colors bg-gray-50">
                                <?php if($event['image']): ?>
                                <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-48 object-cover">
                                <?php endif; ?>
                                <div class="p-6">
                                    <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-2"><?= htmlspecialchars($event['date_display']) ?></div>
                                    <h3 class="text-xl font-heading font-bold text-primary group-hover:text-secondary transition-colors mb-2"><?= htmlspecialchars($event['title']) ?></h3>
                                    <p class="text-gray-600 text-sm line-clamp-2"><?= htmlspecialchars($event['excerpt']) ?></p>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($news): ?>
                    <div class="mt-16 pt-12 border-t border-gray-100">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-secondary pb-2 inline-block">LATEST NEWS</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach($news as $article): ?>
                            <a href="news-article?id=<?= $article['id'] ?>" class="block group border border-gray-200 hover:border-secondary transition-colors bg-gray-50">
                                <?php if($article['featured_image']): ?>
                                <img src="<?= htmlspecialchars($article['featured_image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-48 object-cover">
                                <?php endif; ?>
                                <div class="p-6">
                                    <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-2"><?= date('M d, Y', strtotime($article['published_at'])) ?></div>
                                    <h3 class="text-xl font-heading font-bold text-primary group-hover:text-secondary transition-colors mb-2"><?= htmlspecialchars($article['title']) ?></h3>
                                    <p class="text-gray-600 text-sm line-clamp-2"><?= htmlspecialchars($article['excerpt']) ?></p>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Area -->
                <div class="lg:w-1/3 space-y-8">
                    <?php if($leader): ?>
                    <!-- Faculty Leader Card -->
                    <div class="bg-gray-50 p-8 border border-gray-200 border-t-4 border-t-primary text-center">
                        <?php if($leader['photo']): ?>
                        <img src="<?= htmlspecialchars($leader['photo']) ?>" alt="<?= htmlspecialchars($leader['name']) ?>" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-white shadow-md mb-4">
                        <?php else: ?>
                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-200 flex items-center justify-center border-4 border-white shadow-md mb-4">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                        <?php endif; ?>
                        <h3 class="text-xl font-heading font-bold text-primary"><?= htmlspecialchars($leader['name']) ?></h3>
                        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4"><?= htmlspecialchars($leader['role']) ?></p>
                        <p class="text-gray-600 font-light text-sm mb-4"><?= htmlspecialchars($leader['bio_short']) ?></p>
                        <?php if($leader['email']): ?>
                        <a href="mailto:<?= htmlspecialchars($leader['email']) ?>" class="inline-block bg-primary hover:bg-gray-800 text-white text-xs font-bold uppercase tracking-widest px-4 py-2 transition-colors">Contact</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Target Audience Card -->
                    <div class="bg-gray-50 p-8 border border-gray-200 border-t-4 border-t-primary">
                        <h3 class="text-xl font-heading font-bold text-primary mb-4 uppercase tracking-wider">Who Should Join?</h3>
                        <p class="text-gray-600 font-light leading-relaxed mb-6">
                            Engineers, Software Developers, Researchers, Medical Scientists, and IT Professionals.
                        </p>
                        <hr class="border-gray-200 mb-6">
                        <p class="text-sm text-gray-500 italic">
                            Professionals seeking to align their career with God's redemptive purpose.
                        </p>
                    </div>

                    <!-- Call to Action Card -->
                    <div class="bg-primary text-white p-8 border-b-4 border-secondary">
                        <h3 class="text-2xl font-heading font-bold mb-4">Ready to Engage?</h3>
                        <p class="text-gray-300 font-light mb-6">
                            Become a member of the SAT faculty and start transforming your sphere of influence today.
                        </p>
                        <a href="get-involved" class="block w-full text-center bg-secondary hover:bg-orange-600 text-white font-bold uppercase tracking-widest px-6 py-4 transition-colors">
                            Apply Now
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>