<?php
session_start();
$dsn = "mysql:host=localhost;dbname=equipe_db;charset=utf8";
$username = "root";
$password = "";

// Connexion sécurisée à la base
try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user"])) {
    die("Vous devez être connecté pour voir votre profil.");
}

$email = $_SESSION["user"]["emailuser"];

// Récupérer les informations du membre
$stmt = $pdo->prepare("SELECT * FROM member WHERE email = ?");
$stmt->execute([$email]);
$profil = $stmt->fetch();

if (!$profil) {
    die("Erreur : Aucun profil trouvé pour cet utilisateur.");
}
?>

<!DOCTYPE html>
<body>
    <div class="container">
        <h1>Mon Profil</h1>
        <div class="profile-card">
            <div class="profile-header">
                <img src="default.jpg" alt="Photo de profil">
                <h3><?= htmlspecialchars($profil['lastnamemb'] . " " . $profil['firstnamemb']) ?></h3>
                <p>Email : <?= htmlspecialchars($profil['email']) ?></p>
            </div>
            <div class="profile-body">
                <form action="update.php" method="POST">
                    <label>Nom :</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($profil['lastnamemb']) ?>" required>
                    <label>Prénom :</label>
                    <input type="text" name="prenom" value="<?= htmlspecialchars($profil['firstnamemb']) ?>" required>
                 
                    <button type="submit" class="btn-update">Mettre à jour</button>
                </form>
            </div>
            <div class="profile-footer">
                <a href="logout.php" class="logout-btn">Déconnexion</a>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    h1{
        text-align: center;
        font-family: 'hades';
    }
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 400px;
}

.profile-card {
    background: white;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

.profile-header img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

.profile-body {
    margin-top: 15px;
    text-align: left;
}

label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
}

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-update {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-update:hover {
    background-color: #0056b3;
}

.profile-footer {
    margin-top: 20px;
}

.logout-btn {
    text-decoration: none;
    color: red;
    font-weight: bold;
}
</style>