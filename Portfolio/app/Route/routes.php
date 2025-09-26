<?php
// app/Route/routes.php

return [
    '/' => 'index.php',
    '/security' => 'security.php',
    '/anim-projet' => 'anim.projet.php',
    '/cv' => 'cv.html',
    '/presentation' => 'presentation.php',
    '/projet-perso' => 'projet.perso.php',
    '/projets' => 'projet.php',
    '/projet-pro' => 'projet.pro.php',
    '/projet-scol' => 'projet.scol.php',
    '/stage' => 'stage.php',
    '/veille' => 'veille.php',
];
$projectRoutes = [
    '/projet/alf' => 'storage/Projets/Projet2', // suppose index.php
    '/projet/techsolution' => 'storage/Projets/Projet_Tech', // suppose index.php
    '/projet/hades' => 'storage/Projets/Hades', // affiche ades.html
    '/projet/leviator' => 'storage/Projets/leviator', // affiche leviator.html
    '/projet/disney' => 'storage/Projets/disney', // affiche Disney.html
];

if (array_key_exists($uri, $routes)) {
    $file = __DIR__ . '/../app/controller/' . $routes[$uri];
    if (file_exists($file)) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
            readfile($file);
        } else {
            require_once $file;
        }
        exit;
    }
}

// Vérifier les routes de projets
if (array_key_exists($uri, $projectRoutes)) {
    $projectPath = __DIR__ . '/../' . $projectRoutes[$uri];
    
// Attribution des fichiers principaux spécifiques
$customEntryFiles = [
    '/projet/hades' => 'ades.html',
    '/projet/leviator' => 'leviator.html',
    '/projet/disney' => 'Disney.html',
];

if (isset($customEntryFiles[$uri])) {
    $fullPath = $projectPath . '/' . $customEntryFiles[$uri];
    if (file_exists($fullPath)) {
        if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'html') {
            readfile($fullPath);
        } else {
            require_once $fullPath;
        }
        exit;
    }
}

// Fichiers d'entrée par défaut
$possibleFiles = ['index.php', 'index.html', 'main.html', 'home.html'];
foreach ($possibleFiles as $filename) {
    $fullPath = $projectPath . '/' . $filename;
    if (file_exists($fullPath)) {
        if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'html') {
            readfile($fullPath);
        } else {
            require_once $fullPath;
        }
        exit;
    }
}

    
    foreach ($possibleFiles as $filename) {
        $fullPath = $projectPath . '/' . $filename;
        if (file_exists($fullPath)) {
            if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'html') {
                readfile($fullPath);
            } else {
                require_once $fullPath;
            }
            exit;
        }
    }
    
    // Si aucun fichier d'entrée trouvé, lister le contenu du dossier
    if (is_dir($projectPath)) {
        echo "<h1>Projet trouvé mais pas de fichier d'entrée</h1>";
        echo "<p>Contenu du dossier :</p><ul>";
        foreach (scandir($projectPath) as $file) {
            if ($file != '.' && $file != '..') {
                echo "<li><a href='$uri/$file'>$file</a></li>";
            }
        }
        echo "</ul>";
        exit;
    }
}

// 404 si aucune route ne correspond
header("HTTP/1.0 404 Not Found");
echo "Page non trouvée pour : " . $uri;
exit;
