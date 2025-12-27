<?php
$meta = [
    'title' => 'CCE Faculty Endeavours',
    'description' => 'Eight faculties mobilizing Christian professionals to transform institutions with excellence.',
];
include 'header.php';

$faculties = [
    ['code' => 'GAD', 'name' => 'Governance & Development', 'desc' => 'Governance practitioners (e.g. politicians, legislators, technocrats and civil society actors and media) are equipped with seculo-spiritual aptitude so they can produce godly and competent leadership to drive true development locally, nationally and globally.', 'icon' => 'G'],
    ['code' => 'EAT', 'name' => 'Education & Training', 'desc' => 'Professional educationist and technical trainers receive knowledge and skills to formulate and implement an educational system that functions efficiently to drive industry and promote the glory of God.', 'icon' => 'E'],
    ['code' => 'SAT', 'name' => 'Science & Technology', 'desc' => 'Christian professional scientist and technologist are provided with further resources to position them at the cutting edge of explorative science and innovative technology which is both ethical and godly.', 'icon' => 'S'],
    ['code' => 'PAA', 'name' => 'Philosophy & Arts', 'desc' => 'CCE has measures designed to produce P&A poised to promote the glory of Jesus. When serious Christians take charge of the music, film and entertainment industry the moral degeneration will stop and entertainment will be a tool for godliness.', 'icon' => 'P'],
    ['code' => 'FAB', 'name' => 'Finance & Business', 'desc' => 'Finance and business drive economies because they are the gatekeepers of global resources. Christians must engage this arena with competence and godliness. CCE provides professional support for this engagement.', 'icon' => 'F'],
    ['code' => 'CAR', 'name' => 'Christianity & Religion', 'desc' => 'CCE trains Christian Apologists to competently explain the Christian faith to thinking skeptics who could then make informed decisions on following Christ Jesus.', 'icon' => 'C'],
    ['code' => 'RAF', 'name' => 'Relationship & Family', 'desc' => 'R&F are the foundation of society. CCE has programmes that grow multi-dimensional relationships and build strong godly families. We train Christians called to be counselors and life coaches.', 'icon' => 'R'],
    ['code' => 'CAM', 'name' => 'Communication & Media', 'desc' => 'The Lord Jesus Christ was a master communicator. His words keep transforming lives. Christians must be well equipped to access and control the global communication and media space.', 'icon' => 'M'],
];
?>
<main class="faculty-page">
    <section class="page-header">
        <h1 class="page-title">Faculty Endeavours</h1>
        <p class="page-subtitle">Eight faculties working in concert to reclaim and transform secular institutions through godly wisdom and professional excellence</p>
    </section>
    <section class="faculty-grid">
        <?php foreach ($faculties as $fac): ?>
            <article class="faculty-card">
                <div class="faculty-icon"><?= htmlspecialchars($fac['icon']) ?></div>
                <p class="faculty-code"><?= htmlspecialchars($fac['code']) ?></p>
                <h3 class="faculty-name"><?= htmlspecialchars($fac['name']) ?></h3>
                <p class="faculty-desc"><?= htmlspecialchars($fac['desc']) ?></p>
            </article>
        <?php endforeach; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
