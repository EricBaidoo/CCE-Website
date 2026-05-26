<?php
require_once __DIR__ . '/config/database.php';

try {
    // 1. Run database.sql to create new tables
    $sql = file_get_contents(__DIR__ . '/database.sql');
    $pdo->exec($sql);
    echo "Database schema updated successfully.\n";

    // 2. Seed default Site Settings
    $settings = [
        ['site_title', 'CCE - Cross-Cutting Excellence'],
        ['site_description', 'Cross-Cutting Excellence (CCE) mobilizes Christian professionals to reclaim and transform secular institutions through godly wisdom and professional excellence.'],
        ['welcome_message', 'Welcome to the CCE Official Website'],
        ['contact_email', 'info@ccegh.org'],
        ['contact_phone', '+233 123 456 789'],
        ['contact_address', 'Accra, Ghana'],
        ['coordinator_name', 'The General Coordinator'],
        ['coordinator_image', 'assets/image/pics/coordinator.jpg'],
        ['coordinator_quote', 'CCE is on the move—empowered by the anointing of the Holy Ghost to manifest high-end Seculo-Spiritual Aptitude (SSA).'],
        ['coordinator_message', 'At CCE we train and equip God\'s Children in the areas of Governance and Development, Education and Training, Science and Technology, Philosophy and the Arts, Finance and Business, Relationships and Family, Missions and Apologetics, Communication and Media.<br><br>We are transforming our secular spaces and spheres of influence to the glory of our God, in Christ Jesus.<br><br>This anointing living in us makes us meek, hard working, patient, wise, bold, highly intelligent, efficient and driven by conviction. CCE provides what you need to make your life have eternal relevance: we focus on issues of eternal value. We are on the ground, engaged in local government and community development, national policy and programme implementation.<br><br>We train and equip volunteers and facilitators who drive change at national and internal levels, building bottom-up experience and top-down execution in a way that integrate functional systems into real life outcomes—with eternal value! We work in the arts and philosophy, guiding film-makers, theatre performers and creatives across the range to engineer the culture of godliness that provides oxygen for prosperity in communities, nations and generations.<br><br>CCE People are business owners and consultants spreading out across everywhere, reaching out to all the continents and creating the stable network yielding the critical mass of Christian Professionals required to transform our world until the kingdoms of this world become the kingdoms of our God and of his Christ.'],
        ['social_facebook', 'https://facebook.com/cce'],
        ['social_twitter', 'https://twitter.com/cce'],
        ['social_linkedin', 'https://linkedin.com/company/cce'],
        ['social_instagram', 'https://instagram.com/cce']
    ];

    $stmtSettings = $pdo->prepare("INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES (?, ?)");
    foreach ($settings as $setting) {
        $stmtSettings->execute($setting);
    }
    echo "Site settings seeded successfully.\n";

    // 3. Seed default Hero Slides (only if empty)
    $heroCount = $pdo->query("SELECT COUNT(*) FROM hero_slides")->fetchColumn();
    if ($heroCount == 0) {
        $slides = [
            [
                'assets/image/hero/001-w2000.jpg',
                'Transforming Nations Through Christ',
                'Equipping professionals to manifest high-end Seculo-Spiritual Aptitude across all spheres of influence.',
                'Get Involved',
                'get-involved.php',
                1
            ],
            [
                'assets/image/hero/002-w2000.jpg',
                'Governance & Development',
                'Building functional systems and policies that drive real-life outcomes with eternal value.',
                'View Faculties',
                'faculty.php',
                2
            ],
            [
                'assets/image/hero/003-w2000.jpg',
                'Education & Training',
                'Empowering the next generation of leaders with the manifold wisdom of God.',
                'Read Our Charter',
                'about.php',
                3
            ]
        ];

        $stmtHero = $pdo->prepare("INSERT INTO hero_slides (image_path, title, description, button_text, button_link, slide_order) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($slides as $slide) {
            $stmtHero->execute($slide);
        }
        echo "Hero slides seeded successfully.\n";
    } else {
        echo "Hero slides already exist, skipping seed.\n";
    }

} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}
?>
