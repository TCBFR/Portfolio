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

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT * FROM user WHERE emailuser = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    $plain_password = bin2hex(random_bytes(8)); // Génère un mot de passe sécurisé aléatoire
    $hashed_password = hash('sha256', $plain_password);
    
    // Insérer l’utilisateur avec le mot de passe hashé
    $stmt = $pdo->prepare("SELECT * FROM user WHERE emailuser = ? AND password = ?");
    $stmt->execute([$email, hash('sha256', $password)]);
    if ($user) {
        $hashed_password = hash('sha256', $password);

        // Comparaison sécurisée du mot de passe
        if ($user && hash_equals(trim($user['password']), hash('sha256', $password))) {
            $_SESSION["user"] = $user;
            header("Location: rename.php"); // Redirection après connexion réussie
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Email non trouvé.";
    }

}
?>

<!DOCTYPE html>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <label>Email :</label>
            <input type="email" name="email" required>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn-login">Se connecter</button>
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

.login-container {
    background: white;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
    width: 350px;
}

h2 {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

.btn-login {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-login:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    font-weight: bold;
}
</style>