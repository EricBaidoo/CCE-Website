<?php
require_once __DIR__ . '/../config/database.php';

$defaults = [
    'about_hero_title' => 'THE CROSS-CUTTING EXCELLENCE MANDATE',
    'about_hero_desc' => 'Building the capacity of professionals to transform their various spheres of endeavour with the manifold wisdom of God.',
    'about_vision' => 'We see Christians establishing the glory of the Lord Jesus Christ across the world through their secular professions.',
    'about_mission' => 'Building the capacity of Christian professionals to transform their various spheres of endeavour with the manifold wisdom of God.',
    'about_intro_html' => '<p class="mb-6"><strong class="text-primary text-xl font-heading">Cross-Cutting Excellence (CCE)</strong> is a network of Christian Professionals endeavouring to transform their secular space with the wisdom of God; and we are serious about this. Our mission is to build the capability of Christian Professionals through Seculo-Spiritual Aptitude (SSA).</p>
<p class="mb-6 border-l-4 border-gray-300 pl-6 text-xl text-gray-800 font-light italic">Excellence is to excel, to have excess competence, be abundantly fruitful, to have more than may be immediately required...relevant more. Excellence is to possess eternal life.</p>
<p>Christians are made to be excellent across-board: perfect unto every good work. The capacity of Christians is more than is needed for themselves; we have capacity to transform our lives, help transform others, catalyse the transformation of a whole global generation, generations; we have capacity even to judge angels. These are not mere accolades; they are the word of God that does not return unto him void until it has accomplished its purpose.</p>',
    
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

    'about_roadmap_1_title' => 'PHASE I: Establishment (2016-2021)',
    'about_roadmap_1_html' => '<li class="flex items-center gap-2"><svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Clear Vision Defined</li>
<li class="flex items-center gap-2"><svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Comprehensive Mission</li>
<li class="flex items-center gap-2"><svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Competent Operational Structures</li>',
    'about_roadmap_2_title' => 'PHASE II: Expansion (2021-2031)',
    'about_roadmap_2_html' => '<li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Harness Resources</li>
<li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Expand Engagement</li>
<li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Measure Impact</li>',
    'about_roadmap_3_title' => 'PHASE III: 2031-2050 AND BEYOND',
    'about_roadmap_3_html' => '<li class="flex items-start gap-3">
    <span class="text-secondary mt-1">&#9658;</span> 
    CCE becomes a preferred alternative default Operational System for the national and continental socio-economic space.
</li>
<li class="flex items-start gap-3">
    <span class="text-secondary mt-1">&#9658;</span> 
    The CCE-OS becomes commonly accessible to the rural communities of Africa.
</li>
<li class="flex items-start gap-3">
    <span class="text-secondary mt-1">&#9658;</span> 
    The CCE-OS serves as the default lifestyle of young people in urban Ghana and across Africa, reaching globally.
</li>',

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

echo "Executed ON DUPLICATE KEY UPDATE for $count settings into the database.";
