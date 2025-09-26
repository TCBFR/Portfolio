<?php
// Vérifier si l'ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun ID fourni.");
}

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=equipe_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = (int)$_GET['id'];

    // Supprimer le profil si confirmé
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("DELETE FROM member WHERE id = :id");
        $stmt->execute([':id' => $id]);
        header("Location: admin.edit.php");
        exit;
    }

    // Récupérer les informations pour confirmation
    $stmt = $pdo->prepare("SELECT * FROM member WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$member) {
        die("Erreur : Profil introuvable.");
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un Profil</title>
</head>
<body>
    <h1>Confirmer la suppression</h1>
    <p>Voulez-vous vraiment supprimer le profil de <strong><?= htmlspecialchars($member['firstnamemb'] . ' ' . $member['lastnamemb']); ?></strong> ?</p>
    <form action="delete.php?id=<?= $id; ?>" method="POST">
        <button type="submit">Confirmer</button>
        <a href="edit