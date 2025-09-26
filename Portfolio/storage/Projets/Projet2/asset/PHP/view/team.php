<?php

include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/nav.php';
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=equipe_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : Impossible de se connecter à la base de données. " . $e->getMessage());
}

// Récupérer les profils existants
$stmt = $pdo->query("SELECT * FROM member");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
    <style>
        .team-member img {
            max-width: 100%;
            border-radius: 50%;
        }
        .contact-button {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .contact-button:hover {
            background-color: #0056b3;
        }
        h1{
            font-family: 'hades';
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Notre Équipe</h1>

    <?php if (!empty($members)): ?>
        <div class="team-container">
            <?php foreach ($members as $member): ?>
                <div class="team-member">
                    <h2><?= htmlspecialchars($member['firstnamemb'] . ' ' . $member['lastnamemb']); ?></h2>
                    <p><strong>Description :</strong> <?= htmlspecialchars($member['descriptionmb']); ?></p>
                    <div class="profile-image">
                            <?php if (!empty($member['picturemb'])): ?>
                        <img src="http://localhost:8000/image/<?= htmlspecialchars($member['picturemb']); ?>" alt="Photo de <?= htmlspecialchars($member['firstnamemb']); ?>">
                    <?php else: ?>
                        <p>Aucune photo disponible</p>
                    <?php endif; ?>
                    <!-- Bouton contact -->
                    <a href="contact.php?id=<?= $member['id']; ?>" class="contact-button">Contact</a>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun profil trouvé.</p>
    <?php endif; ?>
    <?php
        include __DIR__ . '/partials/foot.php';
?>
</body>
</html>