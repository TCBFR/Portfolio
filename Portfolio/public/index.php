<?php
// public/index.php

session_start();

// Charger les routes
$routes = require_once __DIR__ . '/../app/Route/routes.php';

// Récupération du chemin demandé dans l'URL (par exemple "/projet" ou "/stage")
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Gerer la racine
if ($uri === '' || $uri === '/') {
    require_once __DIR__ . '/../app/controller/' . $routes['/'];
    exit;
}

// Chercher la route correspondante
if (array_key_exists($uri, $routes)) {
    $file = __DIR__ . '/../app/controller/' . $routes[$uri];
    if (file_exists($file)) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
            readfile($file);
        } else {
            require_once $file;
        }
        exit;
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Page non trouvée";
        exit;
    }
}

// Route non trouvée = 404
header("HTTP/1.0 404 Not Found");
echo "Page non trouvée";
exit;
