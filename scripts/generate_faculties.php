<?php
require_once __DIR__ . '/config/database.php';

echo "<h2>Database Schema Updates</h2>";

try {
    $pdo->exec("ALTER TABLE events ADD COLUMN faculty_id VARCHAR(10) NULL AFTER location");
    echo "<p>Added faculty_id to events table.</p>";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<p>faculty_id already exists in events table.</p>";
    } else {
        echo "<p>Error on events: " . $e->getMessage() . "</p>";
    }
}

try {
    $pdo->exec("ALTER TABLE people ADD COLUMN faculty_id VARCHAR(10) NULL AFTER role");
    echo "<p>Added faculty_id to people table.</p>";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<p>faculty_id already exists in people table.</p>";
    } else {
        echo "<p>Error on people: " . $e->getMessage() . "</p>";
    }
}

try {
    $pdo->exec("ALTER TABLE news ADD COLUMN faculty_id VARCHAR(10) NULL AFTER featured_image");
    echo "<p>Added faculty_id to news table.</p>";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<p>faculty_id already exists in news table.</p>";
    } else {
        echo "<p>Error on news: " . $e->getMessage() . "</p>";
    }
}

echo "<h2>Generating Faculty Pages</h2>";

$faculties = [
    [
        'id' => 'gad',
        'icon' => 'GAD',
        'name' => 'Governance & Development',
        'code' => 'GAD',
        'desc' => 'Governance practitioners are equipped with seculo-spiritual aptitude so they can produce godly and competent leadership to drive true development locally, nationally and globally.',
        'extended_desc' => 'The Governance & Development (GAD) faculty is dedicated to raising a new generation of leaders who understand that true development is rooted in righteous governance. We believe that when governance is driven by godly principles, the resulting policies and structures will invariably lead to sustainable development, justice, and equity.',
        'objectives' => [
            'Equip leaders with biblical principles for public administration and policy-making.',
            'Develop frameworks for ethical governance and anti-corruption strategies.',
            'Train practitioners to implement sustainable development goals with a Christian worldview.',
            'Foster a network of Christian politicians, civil servants, and development workers.'
        ],
        'audience' => 'Politicians, Civil Servants, Policy Makers, NGO Leaders, and Development Consultants.'
    ],
    [
        'id' => 'eat',
        'icon' => 'EAT',
        'name' => 'Education & Training',
        'code' => 'EAT',
        'desc' => 'Professional educationist and technical trainers receive knowledge and skills to formulate and implement an educational system that functions efficiently to drive industry and promote the glory of God.',
        'extended_desc' => 'Education shapes the mind of the next generation. The Education & Training (EAT) faculty seeks to redeem the educational sector by infusing curriculum development, pedagogical methods, and institutional administration with the manifold wisdom of God. We aim to produce educators who do not just impart knowledge, but build character.',
        'objectives' => [
            'Design and advocate for value-based educational curricula.',
            'Enhance the pedagogical skills of Christian educators.',
            'Promote excellence and integrity in educational administration.',
            'Bridge the gap between academia and industry through functional training.'
        ],
        'audience' => 'Teachers, Lecturers, School Administrators, Curriculum Developers, and Corporate Trainers.'
    ],
    [
        'id' => 'sat',
        'icon' => 'SAT',
        'name' => 'Science & Technology',
        'code' => 'SAT',
        'desc' => 'Christian professional scientist and technologist are provided with further resources to position them at the cutting edge of explorative science and innovative technology which is both ethical and godly.',
        'extended_desc' => 'Innovation drives the modern world. In the Science & Technology (SAT) faculty, we challenge Christian professionals to be at the forefront of scientific discovery and technological advancement. We emphasize that God is the author of science, and technology should be harnessed ethically to solve human problems and glorify the Creator.',
        'objectives' => [
            'Promote ethical research and innovation in STEM fields.',
            'Equip tech professionals to build solutions that address real-world challenges.',
            'Foster discussions on the intersection of faith, science, and bioethics.',
            'Provide mentorship for young Christian scientists and engineers.'
        ],
        'audience' => 'Engineers, Software Developers, Researchers, Medical Scientists, and IT Professionals.'
    ],
    [
        'id' => 'paa',
        'icon' => 'PAA',
        'name' => 'Philosophy & Arts',
        'code' => 'PAA',
        'desc' => 'When serious Christians take charge of the music, film and entertainment industry the moral degeneration will stop and entertainment will be a tool for godliness.',
        'extended_desc' => 'Culture is largely shaped by the arts and entertainment. The Philosophy & Arts (PAA) faculty is committed to reclaiming the creative space. We empower artists, musicians, writers, and philosophers to produce compelling, high-quality work that reflects the beauty, truth, and goodness of God, thereby shifting cultural narratives.',
        'objectives' => [
            'Train creatives to produce world-class, value-driven content.',
            'Engage contemporary philosophical thought with robust Christian apologetics.',
            'Support Christian artists in navigating the secular entertainment industry.',
            'Establish platforms for the exhibition of godly art, music, and literature.'
        ],
        'audience' => 'Musicians, Filmmakers, Writers, Visual Artists, Philosophers, and Entertainment Executives.'
    ],
    [
        'id' => 'fab',
        'icon' => 'FAB',
        'name' => 'Finance & Business',
        'code' => 'FAB',
        'desc' => 'Finance and business drive economies because they are the gatekeepers of global resources. Christians must engage this arena with competence and godliness.',
        'extended_desc' => 'Wealth creation and resource management are crucial for global influence. The Finance & Business (FAB) faculty equips Christian entrepreneurs and financial professionals to operate with uncompromised integrity while achieving market-leading excellence. We believe business is a legitimate calling that can be used to advance God\'s kingdom.',
        'objectives' => [
            'Instill biblical principles of wealth creation, stewardship, and investment.',
            'Equip entrepreneurs to build scalable, sustainable, and ethical businesses.',
            'Promote Kingdom-minded economic policies and financial practices.',
            'Facilitate networking and resource sharing among Christian business leaders.'
        ],
        'audience' => 'Entrepreneurs, Bankers, Accountants, Investors, and Corporate Executives.'
    ],
    [
        'id' => 'raf',
        'icon' => 'RAF',
        'name' => 'Relationship & Family',
        'code' => 'RAF',
        'desc' => 'Relationships are the foundation of society. CCE has programmes that grow multi-dimensional relationships and build strong godly families. We train counselors and life coaches.',
        'extended_desc' => 'The family is the basic unit of society, and strong relationships are the bedrock of human flourishing. The Relationship & Family (RAF) faculty focuses on restoring the biblical model of family and community. We train professionals to provide healing, guidance, and structure to broken relationships and families.',
        'objectives' => [
            'Train and certify Christian counselors and life coaches.',
            'Develop programs that strengthen marriages and family dynamics.',
            'Address contemporary relational challenges with biblical wisdom.',
            'Promote mental and emotional wellness within the Christian community.'
        ],
        'audience' => 'Counselors, Social Workers, Life Coaches, Marriage Therapists, and Pastors.'
    ],
    [
        'id' => 'maa',
        'icon' => 'MAA',
        'name' => 'Missions & Apologetics',
        'code' => 'MAA',
        'desc' => 'Preparing professionals to engage culture with the gospel, defend the faith thoughtfully and serve missionally across borders.',
        'extended_desc' => 'The Great Commission requires both passion and intellectual rigor. The Missions & Apologetics (MAA) faculty prepares professionals to articulate and defend the Christian worldview in a pluralistic society. We also mobilize professionals to use their secular skills as vehicles for global missions and cross-cultural outreach.',
        'objectives' => [
            'Equip believers to defend the Christian faith with logic, evidence, and grace.',
            'Train professionals for bi-vocational missions in closed or secular nations.',
            'Engage secular ideologies and alternative worldviews effectively.',
            'Support frontline missionaries with professional and technical expertise.'
        ],
        'audience' => 'Apologists, Missionaries, Theologians, and Bi-vocational Professionals.'
    ],
    [
        'id' => 'cam',
        'icon' => 'CAM',
        'name' => 'Communication & Media',
        'code' => 'CAM',
        'desc' => 'The Lord Jesus Christ was a master communicator. Christians must be well equipped to access and control the global communication and media space.',
        'extended_desc' => 'Media is the most powerful tool for shaping public opinion in the 21st century. The Communication & Media (CAM) faculty trains Christian communicators, journalists, and media executives to tell compelling stories with truth and integrity. We aim to flood the media space with light and counteract narratives of despair.',
        'objectives' => [
            'Develop excellence in journalism, broadcasting, and digital media.',
            'Train media professionals in ethical reporting and truth-telling.',
            'Equip ministries and organizations with modern communication strategies.',
            'Create platforms for authentic and impactful Christian storytelling.'
        ],
        'audience' => 'Journalists, Broadcasters, PR Professionals, Social Media Managers, and Content Creators.'
    ]
];

foreach ($faculties as $fac) {
    $file = __DIR__ . '/faculty-' . $fac['id'] . '.php';
    
    $objHtml = '';
    foreach ($fac['objectives'] as $obj) {
        $objHtml .= '<li>' . htmlspecialchars($obj) . '</li>' . "\n                                ";
    }

    $template = <<<HTML
<?php
require_once 'config/database.php';
\$meta = [
    'title' => '{$fac['name']} | Faculty Endeavour | CCE',
    'description' => '{$fac['desc']}',
];
include 'header.php';

// Fetch Faculty Leader
\$leaderStmt = \$pdo->prepare("SELECT * FROM people WHERE faculty_id = ? LIMIT 1");
\$leaderStmt->execute(['{$fac['id']}']);
\$leader = \$leaderStmt->fetch();

// Fetch Recent & Upcoming Events for this Faculty
\$eventsStmt = \$pdo->prepare("SELECT * FROM events WHERE faculty_id = ? ORDER BY start_date DESC LIMIT 3");
\$eventsStmt->execute(['{$fac['id']}']);
\$events = \$eventsStmt->fetchAll();

// Fetch Latest News for this Faculty
\$newsStmt = \$pdo->prepare("SELECT * FROM news WHERE faculty_id = ? ORDER BY published_at DESC LIMIT 3");
\$newsStmt->execute(['{$fac['id']}']);
\$news = \$newsStmt->fetchAll();
?>

<main class="flex-grow bg-white">
    <!-- FACULTY HERO -->
    <section class="bg-primary text-white border-b-4 border-secondary pt-16 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 flex items-center justify-center pointer-events-none">
            <span class="text-[250px] md:text-[400px] font-heading font-bold leading-none tracking-tighter">{$fac['code']}</span>
        </div>
        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <a href="faculty" class="hover:text-white transition-colors">Faculties</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">{$fac['code']}</span>
            </nav>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block bg-secondary text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Faculty Endeavour</span>
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1">{$fac['code']}</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-heading font-bold mb-6 leading-tight max-w-4xl">
                {$fac['name']}
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                {$fac['desc']}
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
                            {$fac['extended_desc']}
                        </p>
                    </div>

                    <div class="mb-12">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">KEY OBJECTIVES</h2>
                        <ul class="list-disc pl-6 space-y-4 text-gray-700 text-lg font-light marker:text-secondary">
                            {$objHtml}
                        </ul>
                    </div>
                    
                    <?php if(\$events): ?>
                    <div class="mt-16 pt-12 border-t border-gray-100">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-secondary pb-2 inline-block">RECENT & UPCOMING EVENTS</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach(\$events as \$event): ?>
                            <a href="event?id=<?= \$event['id'] ?>" class="block group border border-gray-200 hover:border-secondary transition-colors bg-gray-50">
                                <?php if(\$event['image']): ?>
                                <img src="<?= htmlspecialchars(\$event['image']) ?>" alt="<?= htmlspecialchars(\$event['title']) ?>" class="w-full h-48 object-cover">
                                <?php endif; ?>
                                <div class="p-6">
                                    <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-2"><?= htmlspecialchars(\$event['date_display']) ?></div>
                                    <h3 class="text-xl font-heading font-bold text-primary group-hover:text-secondary transition-colors mb-2"><?= htmlspecialchars(\$event['title']) ?></h3>
                                    <p class="text-gray-600 text-sm line-clamp-2"><?= htmlspecialchars(\$event['excerpt']) ?></p>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(\$news): ?>
                    <div class="mt-16 pt-12 border-t border-gray-100">
                        <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-secondary pb-2 inline-block">LATEST NEWS</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach(\$news as \$article): ?>
                            <a href="news-article?id=<?= \$article['id'] ?>" class="block group border border-gray-200 hover:border-secondary transition-colors bg-gray-50">
                                <?php if(\$article['featured_image']): ?>
                                <img src="<?= htmlspecialchars(\$article['featured_image']) ?>" alt="<?= htmlspecialchars(\$article['title']) ?>" class="w-full h-48 object-cover">
                                <?php endif; ?>
                                <div class="p-6">
                                    <div class="text-xs font-bold text-secondary uppercase tracking-widest mb-2"><?= date('M d, Y', strtotime(\$article['published_at'])) ?></div>
                                    <h3 class="text-xl font-heading font-bold text-primary group-hover:text-secondary transition-colors mb-2"><?= htmlspecialchars(\$article['title']) ?></h3>
                                    <p class="text-gray-600 text-sm line-clamp-2"><?= htmlspecialchars(\$article['excerpt']) ?></p>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Area -->
                <div class="lg:w-1/3 space-y-8">
                    <?php if(\$leader): ?>
                    <!-- Faculty Leader Card -->
                    <div class="bg-gray-50 p-8 border border-gray-200 border-t-4 border-t-primary text-center">
                        <?php if(\$leader['photo']): ?>
                        <img src="<?= htmlspecialchars(\$leader['photo']) ?>" alt="<?= htmlspecialchars(\$leader['name']) ?>" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-white shadow-md mb-4">
                        <?php else: ?>
                        <div class="w-32 h-32 rounded-full mx-auto bg-gray-200 flex items-center justify-center border-4 border-white shadow-md mb-4">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                        <?php endif; ?>
                        <h3 class="text-xl font-heading font-bold text-primary"><?= htmlspecialchars(\$leader['name']) ?></h3>
                        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4"><?= htmlspecialchars(\$leader['role']) ?></p>
                        <p class="text-gray-600 font-light text-sm mb-4"><?= htmlspecialchars(\$leader['bio_short']) ?></p>
                        <?php if(\$leader['email']): ?>
                        <a href="mailto:<?= htmlspecialchars(\$leader['email']) ?>" class="inline-block bg-primary hover:bg-gray-800 text-white text-xs font-bold uppercase tracking-widest px-4 py-2 transition-colors">Contact</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Target Audience Card -->
                    <div class="bg-gray-50 p-8 border border-gray-200 border-t-4 border-t-primary">
                        <h3 class="text-xl font-heading font-bold text-primary mb-4 uppercase tracking-wider">Who Should Join?</h3>
                        <p class="text-gray-600 font-light leading-relaxed mb-6">
                            {$fac['audience']}
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
                            Become a member of the {$fac['code']} faculty and start transforming your sphere of influence today.
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
HTML;

    file_put_contents($file, $template);
    echo "<p>Generated {$file}</p>";
}
echo "<p><b>All faculty pages generated successfully.</b></p>";
?>
