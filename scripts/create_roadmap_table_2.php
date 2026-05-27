<?php
require_once __DIR__ . '/../config/database.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS roadmap_phases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        bullets TEXT NOT NULL,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'roadmap_phases' created successfully.\n";

    // Seed the initial 3 phases
    $phases = [
        [
            'title' => 'PHASE I: Establishment (2016-2021)',
            'bullets' => "Clear Vision Defined\nComprehensive Mission\nCompetent Operational Structures",
            'sort_order' => 1
        ],
        [
            'title' => 'PHASE II: Expansion (2021-2031)',
            'bullets' => "Harness Resources\nExpand Engagement\nMeasure Impact",
            'sort_order' => 2
        ],
        [
            'title' => 'PHASE III: 2031-2050 AND BEYOND',
            'bullets' => "CCE becomes a preferred alternative default Operational System for the national and continental socio-economic space.\nThe CCE-OS becomes commonly accessible to the rural communities of Africa.\nThe CCE-OS serves as the default lifestyle of young people in urban Ghana and across Africa, reaching globally.",
            'sort_order' => 3
        ]
    ];

    $check = (int)$pdo->query("SELECT COUNT(*) FROM roadmap_phases")->fetchColumn();
    if ($check === 0) {
        $stmt = $pdo->prepare("INSERT INTO roadmap_phases (title, bullets, sort_order) VALUES (?, ?, ?)");
        foreach ($phases as $phase) {
            $stmt->execute([$phase['title'], $phase['bullets'], $phase['sort_order']]);
        }
        echo "Seeded 3 initial roadmap phases.\n";
    } else {
        echo "Table already seeded with $check rows.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
