<?php
// test.php - Créez ce fichier à la racine de votre projet

echo "<!DOCTYPE html>
<html>
<head>
    <title>Test de diagnostic</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .section { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .error { background: #ffcdd2; }
        .success { background: #c8e6c9; }
        .warning { background: #fff9c4; }
    </style>
</head>
<body>";

echo "<h1>🔍 Test de diagnostic</h1>";

// 1. Test de base
echo "<div class='section success'>";
echo "<h3>✅ PHP fonctionne</h3>";
echo "<p>Ce fichier PHP s'exécute correctement</p>";
echo "</div>";

// 2. Informations sur la requête
echo "<div class='section'>";
echo "<h3>📋 Informations de la requête</h3>";
echo "<p><strong>URL complète :</strong> " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p><strong>Méthode :</strong> " . $_SERVER['REQUEST_METHOD'] . "</p>";
echo "<p><strong>Script actuel :</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p><strong>Répertoire :</strong> " . __DIR__ . "</p>";
echo "</div>";

// 3. Test des dossiers de projets
echo "<div class='section'>";
echo "<h3>📁 Vérification des projets</h3>";

$storageDir = __DIR__ . '/storage/Projets';
if (is_dir($storageDir)) {
    echo "<p class='success'>✅ Le dossier storage/Projets existe</p>";
    
    $projects = [
        'Projet2' => 'ALF',
        'Projet_Tech' => 'TechSolution', 
        'Hades' => 'Hades',
        '08-Leviator' => 'Léviator',
        '14-Disney' => 'Disney'
    ];
    
    foreach ($projects as $folder => $name) {
        $projectPath = $storageDir . '/' . $folder;
        if (is_dir($projectPath)) {
            echo "<p>✅ <strong>$name</strong> : Dossier '$folder' existe</p>";
            
            // Chercher les fichiers d'entrée
            $files = scandir($projectPath);
            $htmlFiles = array_filter($files, function($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'html';
            });
            
            if (!empty($htmlFiles)) {
                echo "<p>&nbsp;&nbsp;&nbsp;📄 Fichiers HTML trouvés : " . implode(', ', $htmlFiles) . "</p>";
            } else {
                echo "<p>&nbsp;&nbsp;&nbsp;⚠️ Aucun fichier HTML trouvé</p>";
            }
        } else {
            echo "<p class='error'>❌ <strong>$name</strong> : Dossier '$folder' manquant</p>";
        }
    }
} else {
    echo "<p class='error'>❌ Le dossier storage/Projets n'existe pas !</p>";
}
echo "</div>";

// 4. Test d'accès direct aux projets
echo "<div class='section'>";
echo "<h3>🔗 Test d'accès direct</h3>";
echo "<p>Essayons d'accéder directement aux projets :</p>";

$projects = [
    'Projet2' => 'ALF',
    'Projet_Tech' => 'TechSolution', 
    'Hades' => 'Hades',
    '08-Leviator' => 'Léviator',
    '14-Disney' => 'Disney'
];

foreach ($projects as $folder => $name) {
    $projectPath = __DIR__ . '/storage/Projets/' . $folder;
    if (is_dir($projectPath)) {
        // Chercher le premier fichier HTML
        $files = scandir($projectPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                $directUrl = "/storage/Projets/$folder/$file";
                echo "<a href='$directUrl' target='_blank' style='display:inline-block; margin:5px; padding:8px 15px; background:#2196F3; color:white; text-decoration:none; border-radius:4px;'>$name (accès direct)</a>";
                break;
            }
        }
    }
}
echo "</div>";

// 5. Solution temporaire
echo "<div class='section warning'>";
echo "<h3>💡 Solution temporaire</h3>";
echo "<p>En attendant de résoudre le routage, modifiez vos liens dans projet.scol.php comme ça :</p>";
echo "<pre style='background:white; padding:10px; border:1px solid #ccc;'>";
echo htmlspecialchars('<a href="/storage/Projets/Projet2/index.html" target="_blank">Projet ALF</a>
<a href="/storage/Projets/Projet_Tech/index.html" target="_blank">Projet TechSolution</a>
<a href="/storage/Projets/Hades/index.html" target="_blank">Projet Hades</a>
<a href="/storage/Projets/08-Leviator/index.html" target="_blank">Projet Léviator</a>
<a href="/storage/Projets/14-Disney/index.html" target="_blank">Projet Disney</a>');
echo "</pre>";
echo "</div>";

echo "</body></html>";
?>