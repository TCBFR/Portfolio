<?php

$router->get('/', 'index.php');
$router->get('/about', 'about/php');
$router->get('/us', 'team.php');
$router->get('/contact', 'contact.php');


$router->get('/cat/create', 'cat/create.php');

$router->get('/cat/edit', 'cat/edit.php');
$router->put('/cat', 'cat/update.php');

$router->delete('/cat', 'cat/delete.php');
