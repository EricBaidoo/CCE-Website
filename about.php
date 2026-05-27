<?php
$meta = [
    'title' => 'About CCE - Official Mandate',
    'description' => 'Building the capacity of Christian professionals to transform their various spheres of endeavour with the manifold wisdom of God.',
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
                <span class="text-white">About CCE</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Official Charter</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-6 leading-none"><?= htmlspecialchars($setting('about_hero_title', 'THE CROSS-CUTTING EXCELLENCE MANDATE')) ?></h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    <?= htmlspecialchars($setting('about_hero_desc', 'Building the capacity of professionals to transform their various spheres of endeavour with the manifold wisdom of God.')) ?>
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 border-t border-white/20 pt-12">
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-2">8</div>
                    <div class="text-sm uppercase tracking-widest text-gray-400 font-bold">Strategic Faculties</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-2">10+</div>
                    <div class="text-sm uppercase tracking-widest text-gray-400 font-bold">Years of Active Service</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-secondary mb-2">25+</div>
                    <div class="text-sm uppercase tracking-widest text-gray-400 font-bold">Nations Reached</div>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT - INSTITUTIONAL LAYOUT -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <!-- LEFT SIDEBAR: QUICK NAVIGATION / VISION -->
            <div class="lg:col-span-4 space-y-12">
                <div class="bg-light p-8 border-t-4 border-primary">
                    <h2 class="font-heading font-bold text-2xl text-primary mb-4 border-b-2 border-gray-200 pb-2">OUR VISION</h2>
                    <p class="text-gray-800 leading-relaxed font-medium">
                        <?= htmlspecialchars($setting('about_vision', 'We see Christians establishing the glory of the Lord Jesus Christ across the world through their secular professions.')) ?>
                    </p>
                </div>
                
                <div class="bg-light p-8 border-t-4 border-secondary">
                    <h2 class="font-heading font-bold text-2xl text-primary mb-4 border-b-2 border-gray-200 pb-2">OUR MISSION</h2>
                    <p class="text-gray-800 leading-relaxed font-medium">
                        <?= htmlspecialchars($setting('about_mission', 'Building the capacity of Christian professionals to transform their various spheres of endeavour with the manifold wisdom of God.')) ?>
                    </p>
                </div>

                <div class="hidden lg:block">
                    <h3 class="font-heading font-bold text-lg text-primary mb-4 uppercase tracking-widest border-b border-gray-200 pb-2">Contents</h3>
                    <ul class="space-y-3 text-sm font-bold uppercase tracking-wider text-gray-500">
                        <li><a href="#introduction" class="hover:text-secondary">1. Introduction</a></li>
                        <li><a href="#charter" class="hover:text-secondary">2. The CCE Charter</a></li>
                        <li><a href="#history" class="hover:text-secondary">3. Institutional History</a></li>
                        <li><a href="#future" class="hover:text-secondary">4. Strategic Roadmap</a></li>
                        <li><a href="#operations" class="hover:text-secondary">5. Operational Framework</a></li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT CONTENT AREA -->
            <div class="lg:col-span-8">
                
                <!-- Introduction -->
                <article id="introduction" class="mb-16">
                    <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-primary pb-2 inline-block">1. INTRODUCTION</h2>
                    <div class="prose max-w-none text-gray-700 leading-loose text-lg">
                        <?php 
                        $defaultP1 = 'Cross-Cutting Excellence (CCE) is a network of Christian Professionals endeavouring to transform their secular space with the wisdom of God; and we are serious about this. Our mission is to build the capability of Christian Professionals through Seculo-Spiritual Aptitude (SSA).';
                        $defaultQuote = 'Excellence is to excel, to have excess competence, be abundantly fruitful, to have more than may be immediately required...relevant more. Excellence is to possess eternal life.';
                        $defaultP2 = 'Christians are made to be excellent across-board: perfect unto every good work. The capacity of Christians is more than is needed for themselves; we have capacity to transform our lives, help transform others, catalyse the transformation of a whole global generation, generations; we have capacity even to judge angels. These are not mere accolades; they are the word of God that does not return unto him void until it has accomplished its purpose.';
                        ?>
                        <p class="mb-6"><?= htmlspecialchars($setting('about_intro_p1', $defaultP1)) ?></p>
                        <p class="mb-6 border-l-4 border-gray-300 pl-6 text-xl text-gray-800 font-light italic"><?= htmlspecialchars($setting('about_intro_quote', $defaultQuote)) ?></p>
                        <p><?= htmlspecialchars($setting('about_intro_p2', $defaultP2)) ?></p>
                    </div>
                </article>

                <!-- The Charter -->
                <article id="charter" class="mb-16 bg-light p-8 md:p-12 border border-gray-200">
                    <h2 class="text-3xl font-heading font-bold text-primary mb-2">2. THE CCE CHARTER</h2>
                    <h3 class="text-lg font-bold text-secondary uppercase tracking-widest mb-8 border-b border-gray-300 pb-4">Promoting godliness in the secular space</h3>
                    
                    <div class="space-y-6 text-gray-700">
                        <?php for($i=1; $i<=8; $i++): 
                            $defaultTitles = [
                                1 => 'Freedom and Responsibility',
                                2 => 'Godliness Produces Excellence',
                                3 => 'Seculo-Spiritual Aptitude (SSA)',
                                4 => 'Understanding Secularism',
                                5 => 'Godly Wisdom',
                                6 => 'Truth is a Person',
                                7 => 'Our Eight Faculty Endeavours',
                                8 => 'No Room for Self-Conceit'
                            ];
                            $defaultDescs = [
                                1 => 'Freedom is a gift from God and includes a consequential sense of responsibility. When we choose freedom we make a decision of eternal value, and demonstrate that humanity is indeed created in the image of God.',
                                2 => 'Godliness is the mechanism by which freedom produces excellence; it is the expression of the character of God in a manner that excels and produces relevant more, abundant life.',
                                3 => 'God\'s word, encapsulated in the Bible and inspired by the Spirit of Christ Jesus, is the guidance by which the skill of godliness is manifested in secular endeavours.',
                                4 => 'Secularism is ideally neutral and practically atheistic or godly. Thus, secular humanism is either godly or atheistic. It is delusional to perceive secularism as automated or independent humanity.',
                                5 => 'Godly wisdom is the sapience and skill to perceive truth and enjoy the eternal pleasure of manifesting it in one\'s secular endeavours.',
                                6 => 'Truth is not a mere philosophy, ideology, or intelligent reasoning: Truth is a Person.',
                                7 => 'At CCE-Network we pleasurably work through eight Faculty Endeavours (FEs) to express the truth of the Lord Jesus Christ in secular engagements that promote the well-being of humanity.',
                                8 => 'In the CCE-Network there is no room for self conceit, selfishness and corruption. We are admonished to eschew unhealthy political, religious, racial, sexual and national attitudes.'
                            ];
                            $titleKey = "about_charter_{$i}_title";
                            $descKey = "about_charter_{$i}_desc";
                        ?>
                        <div class="flex gap-4 items-start">
                            <span class="bg-primary text-white font-bold w-8 h-8 flex items-center justify-center shrink-0"><?= $i ?></span>
                            <div>
                                <h4 class="font-bold text-primary text-lg mb-1"><?= htmlspecialchars($setting($titleKey, $defaultTitles[$i])) ?></h4>
                                <p class="leading-relaxed"><?= htmlspecialchars($setting($descKey, $defaultDescs[$i])) ?></p>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </article>

                <!-- History -->
                <article id="history" class="mb-16">
                    <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-primary pb-2 inline-block">3. INSTITUTIONAL HISTORY</h2>
                    <div class="space-y-8 text-gray-700 leading-loose">
                        <?php for($i=1; $i<=3; $i++): 
                            $defaultTitles = [
                                1 => '2010 - 2012: The Genesis',
                                2 => '2013: First Pre-CCE Conference',
                                3 => '2017: Official Formation of CCE'
                            ];
                            $defaultDescs = [
                                1 => 'A schematic summary of a Christian life purpose plan was discussed with several young Christian friends. It included a mission to glorify the Lord through transforming our generations by the power of Christ. Ordinary but spiritual fellowships galvanised the vision into concrete actions of prayer, sharing and planning for a conference called The Salvage Group (TSG).',
                                2 => 'TSG organised the first pre-CCE conference under the theme "Purity and Prosperity". The outcome was the mobilisation of a promising group of ordinary Christians, including professionals and students, excited to be part of a vision to transform our generations. This continued through annual conferences on various themes.',
                                3 => 'CCE was formally established with a clear vision and strategy. CCE began operating through 8 Faculty Endeavours (FEs), applying the Christian principles of Seculo-Spiritual Aptitude (SSA) to manifest godliness in excellence.'
                            ];
                            $titleKey = "about_history_{$i}_title";
                            $descKey = "about_history_{$i}_desc";
                        ?>
                        <div class="pl-6 border-l-2 border-secondary">
                            <h4 class="font-bold text-lg text-primary"><?= htmlspecialchars($setting($titleKey, $defaultTitles[$i])) ?></h4>
                            <p><?= htmlspecialchars($setting($descKey, $defaultDescs[$i])) ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>
                </article>

                <!-- Roadmap -->
                <article id="future" class="mb-16">
                    <h2 class="text-3xl font-heading font-bold text-primary mb-8 border-b-2 border-primary pb-2 inline-block">4. STRATEGIC ROADMAP</h2>
                    
                    <?php
                    $roadmap_phases = $pdo->query("SELECT * FROM roadmap_phases ORDER BY sort_order ASC")->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <?php 
                        $fullWidthPhases = [];
                        foreach ($roadmap_phases as $index => $phase): 
                            $lines = array_filter(array_map('trim', explode("\n", $phase['bullets'])));
                            
                            // Every 3rd phase is full width to break up the grid
                            if ($index % 3 == 2) {
                                $fullWidthPhases[] = $phase;
                                continue;
                            }
                            
                            $styleClasses = ($index % 2 == 0) 
                                ? 'border border-gray-200 p-8 hover:border-secondary transition-colors' 
                                : 'border border-secondary p-8 shadow-sm';
                                
                            $iconHtml = ($index % 2 == 0)
                                ? '<svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                                : '<span class="w-1.5 h-1.5 bg-secondary rounded-full"></span>';
                        ?>
                        <div class="<?= $styleClasses ?>">
                            <h3 class="font-heading font-bold text-xl text-primary mb-4 border-b border-gray-100 pb-2"><?= htmlspecialchars($phase['title']) ?></h3>
                            <ul class="space-y-2 text-gray-600 font-medium">
                                <?php foreach($lines as $line): ?>
                                <li class="flex items-center gap-2"><?= $iconHtml ?> <?= htmlspecialchars($line) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php foreach($fullWidthPhases as $phase): 
                        $lines = array_filter(array_map('trim', explode("\n", $phase['bullets'])));
                    ?>
                    <div class="bg-primary text-white p-8 mb-8">
                        <h3 class="font-heading font-bold text-xl mb-4 border-b border-white/20 pb-2 text-secondary"><?= htmlspecialchars($phase['title']) ?></h3>
                        <ul class="space-y-3 font-light text-gray-200">
                            <?php foreach($lines as $line): ?>
                            <li class="flex items-start gap-3">
                                <span class="text-secondary mt-1">&#9658;</span> 
                                <?= htmlspecialchars($line) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </article>

                <!-- Operations -->
                <article id="operations">
                    <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-primary pb-2 inline-block">5. OPERATIONAL FRAMEWORK</h2>
                    <p class="text-gray-700 leading-loose mb-8 text-lg">
                        <?= htmlspecialchars($setting('about_ops_intro', 'CCE provides concepts, courses and chances to young people who are committed to the Lord Jesus Christ and engaged in professional quests in any of the Faculty Endeavours. We are a hub of opportunity.')) ?>
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php for($i=1; $i<=5; $i++): 
                            $defaultTitles = [
                                1 => 'Research',
                                2 => 'Conferences',
                                3 => 'School Clubs',
                                4 => 'Community Development',
                                5 => 'Volunteering and Internships'
                            ];
                            $defaultDescs = [
                                1 => 'We conduct robust Researches to generate dynamic knowledge for innovative solutions. Our interventions are driven by standardized evidence-based information.',
                                2 => 'CCE organizes EXCEL conferences for tertiary and post-tertiary agents of transformation. Designed to inspire and equip young Christian professionals with foresight and insight.',
                                3 => 'C-Excellence Clubs are established in Basic Schools to nurture excellence and godliness from an early age.',
                                4 => 'We undertake projects aimed at achieving Sustainable Development Goals (SDGs) at the basic level where real lives are touched. Areas include Education, Social Protection, Gender, and Nutrition.',
                                5 => 'Our projects provide opportunities for young people to acquire practical experience in development work. Students are exposed to practical situations that draw out their potential to explore solutions.'
                            ];
                            $titleKey = "about_ops_{$i}_title";
                            $descKey = "about_ops_{$i}_desc";
                            $colSpan = ($i == 5) ? 'md:col-span-2' : '';
                        ?>
                        <div class="border border-gray-200 p-6 <?= $colSpan ?>">
                            <h3 class="font-bold text-primary text-lg mb-2 uppercase tracking-wide"><?= htmlspecialchars($setting($titleKey, $defaultTitles[$i])) ?></h3>
                            <p class="text-sm text-gray-600 leading-relaxed"><?= htmlspecialchars($setting($descKey, $defaultDescs[$i])) ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>
                </article>

            </div>
        </div>
    </section>

</main>

<?php include 'footer.php'; ?>
