<?php
// scripts/production_migration.php
require_once __DIR__ . '/../config/database.php';

echo "<h1>Production Database Migration</h1>";

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Update hero_slides table
    echo "<h3>1. Updating hero_slides table...</h3>";
    $columns = [
        'image_position' => "VARCHAR(50) DEFAULT 'object-center'",
        'layout_style' => "VARCHAR(50) DEFAULT 'text_left'",
        'image_caption_name' => "VARCHAR(255) DEFAULT ''",
        'image_caption_title' => "VARCHAR(255) DEFAULT ''"
    ];

    foreach ($columns as $column => $definition) {
        try {
            // Check if column exists
            $stmt = $pdo->query("SHOW COLUMNS FROM hero_slides LIKE '$column'");
            if ($stmt->rowCount() == 0) {
                $pdo->exec("ALTER TABLE hero_slides ADD COLUMN $column $definition");
                echo "Added column '$column' to hero_slides.<br>";
            } else {
                echo "Column '$column' already exists.<br>";
            }
        } catch (Exception $e) {
            echo "<span style='color:red'>Error adding $column: " . $e->getMessage() . "</span><br>";
        }
    }


    // 2. Create roadmap_phases table
    echo "<h3>2. Creating roadmap_phases table...</h3>";
    $sql = "CREATE TABLE IF NOT EXISTS roadmap_phases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        bullets TEXT NOT NULL,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'roadmap_phases' created/verified.<br>";

    // Seed roadmap_phases
    $phases = [
        ['title' => 'PHASE I: Establishment (2016-2021)', 'bullets' => "Clear Vision Defined\nComprehensive Mission\nCompetent Operational Structures", 'sort_order' => 1],
        ['title' => 'PHASE II: Expansion (2021-2031)', 'bullets' => "Harness Resources\nExpand Engagement\nMeasure Impact", 'sort_order' => 2],
        ['title' => 'PHASE III: 2031-2050 AND BEYOND', 'bullets' => "CCE becomes a preferred alternative default Operational System for the national and continental socio-economic space.\nThe CCE-OS becomes commonly accessible to the rural communities of Africa.\nThe CCE-OS serves as the default lifestyle of young people in urban Ghana and across Africa, reaching globally.", 'sort_order' => 3]
    ];
    
    $check = (int)$pdo->query("SELECT COUNT(*) FROM roadmap_phases")->fetchColumn();
    if ($check === 0) {
        $stmt = $pdo->prepare("INSERT INTO roadmap_phases (title, bullets, sort_order) VALUES (?, ?, ?)");
        foreach ($phases as $phase) {
            $stmt->execute([$phase['title'], $phase['bullets'], $phase['sort_order']]);
        }
        echo "Seeded 3 initial roadmap phases.<br>";
    } else {
        echo "roadmap_phases is already seeded.<br>";
    }


    // 3. Update site_settings table (About page fields)
    echo "<h3>3. Updating site_settings...</h3>";
    $defaults = [
        'about_hero_title' => 'THE CROSS-CUTTING EXCELLENCE MANDATE',
        'about_hero_desc' => 'Building the capacity of professionals to transform their various spheres of endeavour with the manifold wisdom of God.',
        'about_vision' => 'We see Christians establishing the glory of the Lord Jesus Christ across the world through their secular professions.',
        'about_mission' => 'Building the capacity of Christian professionals to transform their various spheres of endeavour with the manifold wisdom of God.',
        'about_intro_p1' => 'Cross-Cutting Excellence (CCE) is a network of Christian Professionals endeavouring to transform their secular space with the wisdom of God; and we are serious about this. Our mission is to build the capability of Christian Professionals through Seculo-Spiritual Aptitude (SSA).',
        'about_intro_quote' => 'Excellence is to excel, to have excess competence, be abundantly fruitful, to have more than may be immediately required...relevant more. Excellence is to possess eternal life.',
        'about_intro_p2' => 'Christians are made to be excellent across-board: perfect unto every good work. The capacity of Christians is more than is needed for themselves; we have capacity to transform our lives, help transform others, catalyse the transformation of a whole global generation, generations; we have capacity even to judge angels. These are not mere accolades; they are the word of God that does not return unto him void until it has accomplished its purpose.',
        'about_charter_1_title' => 'Freedom and Responsibility',
        'about_charter_1_desc' => 'Freedom is a gift from God and includes a consequential sense of responsibility. When we choose freedom we make a decision of eternal value, and demonstrate that humanity is indeed created in the image of God.',
        'about_charter_2_title' => 'Godliness Produces Excellence',
        'about_charter_2_desc' => 'Godliness is the mechanism by which freedom produces excellence; it is the expression of the character of God in a manner that excels and produces relevant more, abundant life.',
        'about_charter_3_title' => 'Seculo-Spiritual Aptitude (SSA)',
        'about_charter_3_desc' => 'God\'s word, encapsulated in the Bible and inspired by the Spirit of Christ Jesus, is the guidance by which the skill of godliness is manifested in secular endeavours.',
        'about_charter_4_title' => 'Understanding Secularism',
        'about_charter_4_desc' => 'Secularism is ideally neutral and practically atheistic or godly. Thus, secular humanism is either godly or atheistic. It is delusional to perceive secularism as automated or independent humanity.',
        'about_charter_5_title' => 'Godly Wisdom',
        'about_charter_5_desc' => 'Godly wisdom is the sapience and skill to perceive truth and enjoy the eternal pleasure of manifesting it in one\'s secular endeavours.',
        'about_charter_6_title' => 'Truth is a Person',
        'about_charter_6_desc' => 'Truth is not a mere philosophy, ideology, or intelligent reasoning: Truth is a Person.',
        'about_charter_7_title' => 'Our Eight Faculty Endeavours',
        'about_charter_7_desc' => 'At CCE-Network we pleasurably work through eight Faculty Endeavours (FEs) to express the truth of the Lord Jesus Christ in secular engagements that promote the well-being of humanity.',
        'about_charter_8_title' => 'No Room for Self-Conceit',
        'about_charter_8_desc' => 'In the CCE-Network there is no room for self conceit, selfishness and corruption. We are admonished to eschew unhealthy political, religious, racial, sexual and national attitudes.',
        'about_history_1_title' => '2010 - 2012: The Genesis',
        'about_history_1_desc' => 'A schematic summary of a Christian life purpose plan was discussed with several young Christian friends. It included a mission to glorify the Lord through transforming our generations by the power of Christ. Ordinary but spiritual fellowships galvanised the vision into concrete actions of prayer, sharing and planning for a conference called The Salvage Group (TSG).',
        'about_history_2_title' => '2013: First Pre-CCE Conference',
        'about_history_2_desc' => 'TSG organised the first pre-CCE conference under the theme "Purity and Prosperity". The outcome was the mobilisation of a promising group of ordinary Christians, including professionals and students, excited to be part of a vision to transform our generations. This continued through annual conferences on various themes.',
        'about_history_3_title' => '2017: Official Formation of CCE',
        'about_history_3_desc' => 'CCE was formally established with a clear vision and strategy. CCE began operating through 8 Faculty Endeavours (FEs), applying the Christian principles of Seculo-Spiritual Aptitude (SSA) to manifest godliness in excellence.',
        'about_ops_intro' => 'CCE provides concepts, courses and chances to young people who are committed to the Lord Jesus Christ and engaged in professional quests in any of the Faculty Endeavours. We are a hub of opportunity.',
        'about_ops_1_title' => 'Research',
        'about_ops_1_desc' => 'We conduct robust Researches to generate dynamic knowledge for innovative solutions. Our interventions are driven by standardized evidence-based information.',
        'about_ops_2_title' => 'Conferences',
        'about_ops_2_desc' => 'CCE organizes EXCEL conferences for tertiary and post-tertiary agents of transformation. Designed to inspire and equip young Christian professionals with foresight and insight.',
        'about_ops_3_title' => 'School Clubs',
        'about_ops_3_desc' => 'C-Excellence Clubs are established in Basic Schools to nurture excellence and godliness from an early age.',
        'about_ops_4_title' => 'Community Development',
        'about_ops_4_desc' => 'We undertake projects aimed at achieving Sustainable Development Goals (SDGs) at the basic level where real lives are touched. Areas include Education, Social Protection, Gender, and Nutrition.',
        'about_ops_5_title' => 'Volunteering and Internships',
        'about_ops_5_desc' => 'Our projects provide opportunities for young people to acquire practical experience in development work. Students are exposed to practical situations that draw out their potential to explore solutions.'
    ];

    $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = IF(setting_value = '' OR setting_value IS NULL, VALUES(setting_value), setting_value)");
    
    $count = 0;
    foreach ($defaults as $key => $value) {
        $stmt->execute([$key, $value]);
        $count++;
    }
    echo "Checked/Inserted $count missing settings.<br>";

    // Remove obsolete settings to keep db clean
    $pdo->exec("DELETE FROM site_settings WHERE setting_key LIKE 'home_welcome_%' OR setting_key LIKE 'about_roadmap_%'");
    echo "Cleaned up old obsolete settings.<br>";

    echo "<h2 style='color:green'>Migration Completed Successfully!</h2>";
    echo "<p>You can now safely delete this file (scripts/production_migration.php) from your server.</p>";

} catch (PDOException $e) {
    echo "<h2 style='color:red'>Database Error: " . $e->getMessage() . "</h2>";
}
