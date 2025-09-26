<?php

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=equipe_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : Impossible de se connecter à la base de données. " . $e->getMessage());
}

// Récupération des profils existants
$stmt = $pdo->query("SELECT * FROM member");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Profils</title>
    <style>
        .team-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }
        .team-member {
            display: flex;
            gap: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-image {
            flex-shrink: 0;
            max-width: 150px;
            text-align: center;
        }
        .profile-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .profile-info {
            flex-grow: 1;
        }
        .profile-info h3 {
            margin: 0 0 10px;
        }
        .profile-info p {
            margin: 5px 0;
        }
        .action-buttons {
            margin-top: 10px;
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
        .action-buttons a {
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            color: white;
            text-align: center;
            font-size: 14px;
        }
        .action-buttons a.update {
            background-color: #28a745;
        }
        .action-buttons a.delete {
            background-color: #dc3545;
        }
        .action-buttons a:hover {
            opacity: 0.9;
        }
        .admin-options {
            margin-bottom: 20px;
            display: flex;
        justify-content: space-between;
        align-items: center;
        }
        .admin-options a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #007BFF;
            margin-right: 10px;
        }
   h1{
    font-family: 'hades';
    text-align: center;
    margin-bottom: 100px;
   }
    </style>
</head>
<body>
<h1>Bienvenu sur le compte admin</h1>
    <div class="admin-options">
        <a href="/asset/controller/cat/create.php">Ajouter un profil</a>
        <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
    </div>
        <?php if (!empty($members)): ?>
            <?php foreach ($members as $member): ?>
                <div class="team-member">
                    <!-- Image à gauche -->
                    <div class="profile-image">
                            <?php if (!empty($member['picturemb'])): ?>
                        <img src="<?= htmlspecialchars($member['picturemb']); ?>" alt="Photo de <?= htmlspecialchars($member['firstnamemb']); ?>">
                    <?php else: ?>
                        <p>Aucune photo disponible</p>
                    <?php endif; ?>

                        <!-- Boutons sous l'image -->
                        <div class="action-buttons">
                        <a href="/asset/controller/cat/update.php?id=<?= urlencode($member['id']); ?>" class="update">Mettre à jour</a>
                        <a href="/asset/controller/cat/delete.php?id=<?= urlencode($member['id']); ?>" class="delete">Supprimer</a>
                        </div>
                    </div>

                    <!-- Informations du profil à droite -->
                    <div class="profile-info">
                        <h3><?= htmlspecialchars($member['firstnamemb'] . ' ' . $member['lastnamemb']); ?></h3>
                        <p><strong>Description :</strong> <?= htmlspecialchars($member['descriptionmb']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun profil trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
     