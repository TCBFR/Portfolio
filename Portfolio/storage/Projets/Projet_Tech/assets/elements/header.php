<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'/functions.php'; ?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Société TS - <?= $title ?? null ?></title>

    <div>
        <img align="right" src="/TechSolution.jpg" alt="logo de l'entreprise">
</div>
<div class="Titre">
    <h1>Société TS</h1>
<style>
.Titre {
    background-color: beige;
            color: black; 
            padding: 20px; 
            text-align: center;
            font-size: 35px;
}
</style>
<div class="sous-titre">
    <a href="index.php">Accueil</a>
    <a href="actu.php">Nos Actualités</a>
    <a href="contact.php">Contactez-nous</a>
</div>
        </div>
    </section>
</head>

        <main class="container">
        <div class="bg-body-tertiary p-5 rounded">