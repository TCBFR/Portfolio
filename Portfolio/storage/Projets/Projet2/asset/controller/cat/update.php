<?php
// Vérifiez si un ID de membre est passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun ID de membre fourni.");
}

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=equipe_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer le membre correspondant à l'ID
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM member WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$member) {
        die("Erreur : Profil introuvable.");
    }

    // Mettre à jour le profil
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = trim($_POST['firstnamemb']);
        $nom = trim($_POST['lastnamemb']);
        $description = trim($_POST['descriptionmb']);
        $specialty = $_POST['specialty'] ?? '';
        $specialty = $member['specialty'] ?? '';
        $idspe = $member['idspe'] ?? '';
        $errors = [];

        // Validation des champs obligatoires
        if (empty($prenom)) $errors[] = "Le prénom est obligatoire.";
        if (empty($nom)) $errors[] = "Le nom est obligatoire.";
        if (empty($idspe)) $errors[] = "La spécialité est obligatoire.";

        // Si aucune erreur, exécuter la mise à jour
        if (empty($errors)) {
            $stmt = $pdo->prepare("
                UPDATE member
                SET firstnamemb = :prenom, lastnamemb = :nom, descriptionmb = :description, idspe = :idspe
                WHERE id = :id
            ");
            $stmt->execute([
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':description' => $description,
                ':idspe' => $idspe,
                ':id' => $id
            ]);

            // Rediriger vers la page d'administration après la mise à jour
            header("Location: admin.edit.php");
            exit;
        }
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier le Profil</h1>

        <!-- Affichage des erreurs -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="update.php?id=<?= $id; ?>" method="POST">
            <label for="firstnamemb">Prénom :</label>
            <input type="text" id="firstnamemb" name="firstnamemb" value="<?= htmlspecialchars($member['firstnamemb']); ?>" required>

            <label for="lastnamemb">Nom :</label>
            <input type="text" id="lastnamemb" name="lastnamemb" value="<?= htmlspecialchars($member['lastnamemb']); ?>" required>

            <label for="specialty">Spécialité :</label>
            <select id="specialty" name="specialty" required>
                <option value="3" <?= $member['idspe'] == '3' ? 'selected' : ''; ?>>Communication</option>
                <option value="4" <?= $member['idspe'] == '4' ? 'selected' : ''; ?>>Comptabilité</option>
                <option value="5" <?= $member['idspe'] == '5' ? 'selected' : ''; ?>>Informatique</option>
            </select>

            <label for="descriptionmb">Description :</label>
            <textarea id="descriptionmb" name="descriptionmb" rows="5"><?= htmlspecialchars($member['descriptionmb']); ?></textarea>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>