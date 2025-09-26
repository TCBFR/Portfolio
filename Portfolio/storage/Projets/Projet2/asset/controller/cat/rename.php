<?php
session_start();
$dsn = "mysql:host=localhost;dbname=equipe_db;charset=utf8";
$username = "root";
$password = "";

// Connexion à la base de données
try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user"])) {
    die("Vous devez être connecté pour modifier votre mot de passe.");
}

$email = $_SESSION["user"]["emailuser"];
$message = "";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ancien_password = trim($_POST["ancien_password"]);
    $nouveau_password = trim($_POST["nouveau_password"]);

    // Vérifier si l'ancien mot de passe est correct
    $stmt = $pdo->prepare("SELECT password FROM user WHERE emailuser = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && hash_equals(trim($user['password']), hash('sha256', $ancien_password))) {
        // Mettre à jour le mot de passe
        $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE emailuser = ?");
        $stmt->execute([hash('sha256', $nouveau_password), $email]);

        $message = "Mot de passe mis à jour avec succès !";
    } else {
        $message = "Ancien mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier mon mot de passe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Modifier mon mot de passe</h2>
        <form action="user.edit.php" method="POST">
            <div class="input-group">
                <label>Ancien mot de passe :</label>
                <input type="password" name="ancien_password" required>
            </div>
            <div class="input-group">
                <label>Nouveau mot de passe :</label>
                <input type="password" name="nouveau_password" required>
            </div>
            <div class="input-group">
                <label>Confirmer le nouveau mot de passe :</label>
                <input type="password" name="confirmer_password" required>
            </div>
            <button type="submit" class="btn">Modifier</button>
        </form>
    </div>
</body>
</html>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 350px;
    border-radius: 8px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.input-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}
</style>