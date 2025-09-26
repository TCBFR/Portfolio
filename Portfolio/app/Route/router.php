<?php
// router.php - Version simplifiée qui s'intègre dans votre système existant

// Fonction pour servir les fichiers de projets
function serveProject($projectName) {
    // Configuration des projets
    $projectConfig = [
        'alf' => [
            'path' => __DIR__ . '/storage/Projets/Projet2',
            'files' => ['index.html', 'index.php', 'main.html', 'home.html', 'alf.html']
        ],
        'techsolution' => [
            'path' => __DIR__ . '/storage/Projets/Projet_Tech',
            'files' => ['index.html', 'index.php', 'main.html', 'home.html', 'techsolution.html']
        ],
        'hades' => [
            'path' => __DIR__ . '/storage/Projets/Hades',
            'files' => ['index.html', 'index.html', 'main.html', 'home.html', 'hades.html']
        ],
        'leviator' => [
            'path' => __DIR__ . '/storage/Projets/08-Leviator',
            'files' => ['index.html', 'index.html', 'main.html', 'home.html', 'leviator.html']
        ],
        'disney' => [
            'path' => __DIR__ . '/storage/Projets/14-Disney',
            'files' => ['index.html', 'index.html', 'main.html', 'home.html', 'disney.html', 'bip-bip.html']
        ]
    ];
    
    if (!isset($projectConfig[$projectName])) {
        return false;
    }
    
    $config = $projectConfig[$projectName];
    $projectPath = $config['path'];
    
    if (!is_dir($projectPath)) {
        return false;
    }
    
    // Chercher le fichier d'entrée
    foreach ($config['files'] as $filename) {
        $fullPath = $projectPath . '/' . $filename;
        if (file_exists($fullPath)) {
            // Servir le fichier
            if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'php') {
                // Pour les fichiers PHP, les inclure
                $oldDir = getcwd();
                chdir($projectPath);
                include $fullPath;
                chdir($oldDir);
            } else {
                // Pour les fichiers HTML, les afficher directement
                readfile($fullPath);
            }
            return true;
        }
    }
    
    return false;
}

// Cette fonction sera appelée depuis votre index.php
function handleProjectRoute() {
    $uri = $_SERVER['REQUEST_URI'];
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = rtrim($uri, '/');
    
    // Vérifier si c'est une route de projet
    if (preg_match('/^\/projet\/([a-zA-Z0-9-_]+)$/', $uri, $matches)) {
        $projectName = $matches[1];
        
        if (serveProject($projectName)) {
            exit; // Arrêter l'exécution si le projet a été trouvé et servi
        } else {
            // Projet non trouvé, afficher une page d'erreur
            http_response_code(404);
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Projet non trouvé</title>
                <style>
                    body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; text-align: center; }
                    .error { background: #ffebee; color: #c62828; padding: 20px; border-radius: 5px; }
                    .btn { display: inline-block; margin: 20px; padding: 10px 20px; background: #2196F3; color: white; text-decoration: none; border-radius: 5px; }
                </style>
            </head>
            <body>
                <div class='error'>
                    <h1>❌ Projet non trouvé</h1>
                    <p>Le projet <strong>$projectName</strong> n'existe pas ou n'est pas accessible.</p>
                </div>
                <a href='/projet-scol' class='btn'>← Retour aux projets scolaires</a>
                <a href='/projets' class='btn'>← Retour aux projets</a>
            </body>
            </html>";
            exit;
        }
    }
    
    return false; // Ce n'est pas une route de projet
}

// Si ce fichier est appelé directement (ne devrait pas arriver avec le .htaccess propre)
if (basename($_SERVER['SCRIPT_NAME']) === 'router.php') {
    echo "Accès direct au router non autorisé. Toutes les requêtes doivent passer par index.php";
    exit;
}
?>