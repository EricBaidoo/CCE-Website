<?php
$meta = [
    'title' => 'Faculty Endeavours - 8 Strategic Areas of Excellence',
    'description' => 'We equip Christian Professionals to be excellent in high-end productivity across 8 Faculty Endeavours',
    'image' => '/CCE/assets/image/hero/001-w2000.jpg'
];
include 'header.php';

$faculties = [
    ['id'=>'gad', 'icon'=>'GAD', 'name'=>'Governance & Development', 'code'=>'GAD', 'desc'=>'Governance practitioners are equipped with seculo-spiritual aptitude so they can produce godly and competent leadership to drive true development locally, nationally and globally.'],
    ['id'=>'eat', 'icon'=>'EAT', 'name'=>'Education & Training', 'code'=>'EAT', 'desc'=>'Professional educationist and technical trainers receive knowledge and skills to formulate and implement an educational system that functions efficiently to drive industry and promote the glory of God.'],
    ['id'=>'sat', 'icon'=>'SAT', 'name'=>'Science & Technology', 'code'=>'SAT', 'desc'=>'Christian professional scientist and technologist are provided with further resources to position them at the cutting edge of explorative science and innovative technology which is both ethical and godly.'],
    ['id'=>'paa', 'icon'=>'PAA', 'name'=>'Philosophy & Arts', 'code'=>'PAA', 'desc'=>'When serious Christians take charge of the music, film and entertainment industry the moral degeneration will stop and entertainment will be a tool for godliness.'],
    ['id'=>'fab', 'icon'=>'FAB', 'name'=>'Finance & Business', 'code'=>'FAB', 'desc'=>'Finance and business drive economies because they are the gatekeepers of global resources. Christians must engage this arena with competence and godliness.'],
    ['id'=>'raf', 'icon'=>'RAF', 'name'=>'Relationship & Family', 'code'=>'RAF', 'desc'=>'Relationships are the foundation of society. CCE has programmes that grow multi-dimensional relationships and build strong godly families. We train counselors and life coaches.'],
    ['id'=>'maa', 'icon'=>'MAA', 'name'=>'Missions & Apologetics', 'code'=>'MAA', 'desc'=>'Preparing professionals to engage culture with the gospel, defend the faith thoughtfully and serve missionally across borders.'],
    ['id'=>'cam', 'icon'=>'CAM', 'name'=>'Communication & Media', 'code'=>'CAM', 'desc'=>'The Lord Jesus Christ was a master communicator. Christians must be well equipped to access and control the global communication and media space.'],
];
?>

<main class="flex-grow bg-white">
    <!-- AUTHORITATIVE HERO BANNER -->
    <section class="bg-primary text-white border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <nav class="flex text-sm text-gray-400 font-medium uppercase tracking-widest mb-8">
                <a href="index" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 border-l border-gray-500"></span>
                <span class="text-white">Faculty Endeavours</span>
            </nav>
            <div class="max-w-4xl">
                <span class="inline-block bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 mb-6">Strategic Focus Areas</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold mb-6 leading-none">THE 8 FACULTY ENDEAVOURS</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                    We equip Christian Professionals to be excellent in high-end productivity across eight distinct spheres of global influence.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-16 max-w-3xl">
                <h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">WHAT ARE FACULTY ENDEAVOURS?</h2>
                <p class="text-gray-700 leading-loose text-lg font-medium">
                    CCE engages professionals across eight strategic faculties to build capacity and transform the secular space. Each Faculty Endeavour represents a critical sphere of influence where Christian professionals can apply godly wisdom and excellence to bring sustainable transformation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach($faculties as $index => $fac): ?>
                <div class="bg-white border border-gray-200 hover:border-secondary transition-colors p-8 flex flex-col group relative">
                    <!-- Top Section -->
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-16 h-16 shrink-0 bg-gray-50 border border-gray-100 p-2 flex items-center justify-center">
                            <img src="assets/image/FE-icons/<?= $fac['icon'] ?>.svg" alt="<?= $fac['code'] ?>" class="w-full h-full" onerror="this.style.display='none'">
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">FE-<?= $index + 1 ?> (<?= $fac['code'] ?>)</div>
                            <h3 class="text-2xl font-heading font-bold text-primary group-hover:text-secondary transition-colors">
                                <?= $fac['name'] ?>
                            </h3>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed mb-8 flex-grow">
                        <?= $fac['desc'] ?>
                    </p>
                    
                    <!-- Link -->
                    <div class="mt-auto border-t border-gray-100 pt-6">
                        <a href="faculty-<?= $fac['id'] ?>" class="text-primary font-bold text-sm uppercase tracking-widest hover:text-secondary flex items-center gap-2">
                            Explore <?= $fac['name'] ?> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Call to Action -->
            <div class="mt-20 bg-primary text-white p-12 text-center border-t-8 border-secondary">
                <h2 class="text-3xl font-heading font-bold mb-4">Join a Faculty Endeavour</h2>
                <p class="text-gray-300 max-w-2xl mx-auto mb-8 text-lg font-light">
                    Are you a professional passionate about transforming your sphere of influence? Connect with one of our Faculty Endeavours and be equipped for excellence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="get-involved" class="bg-secondary hover:bg-orange-600 text-white font-bold uppercase tracking-widest px-8 py-4 transition-colors">Get Involved</a>
                    <a href="contact" class="bg-transparent border border-white hover:bg-white hover:text-primary font-bold uppercase tracking-widest px-8 py-4 transition-colors">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
