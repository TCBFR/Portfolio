<?php
/**
 * Ceci n'a rien à faire là,
 * mais pour le moment on va s'en contenter...
 */
if (is_file(dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php')) {
    require dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';
}

/**
 * Début réel du fichier de confit 'app.php'
 */
define('PATH', dirname(__DIR__));
