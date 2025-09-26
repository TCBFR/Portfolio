<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f4f4f4; }
        .login-container { width: 350px; margin: auto; background: white; padding: 20px; border-radius: 10px; 
                           box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .btn { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;
               cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Administrateur</h2>
        <?php if (isset($_GET['error'])) { echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>"; } ?>
        <form action="admin.login.php" method="POST">
            <input type="text" name="admin_id" placeholder="Admin ID" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
// Vérification des identifiants
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $admin_id_correct = 'admin123';
    $password_correct = 'password123';

    if ($admin_id === $admin_id_correct && $password === $password_correct) {
        $_SESSION['admin_logged_in'] = true; // L'utilisateur est connecté
        header('Location: /asset/controller/cat/admin.edit.php'); // Redirection vers le tableau de bord
        exit;
    } else {
        $error = "Incorrect username or password.";
    }
}
 if (isset($error)): ?>
    <p style="color: red;"><?= $error; ?></p>
<?php endif; ?> 