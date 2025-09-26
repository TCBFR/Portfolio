<?php
// Activation des erreurs PHP pour débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion sécurisée à la base de données en PDO
$dsn = "mysql:host=localhost;dbname=equipe_db;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}

// Vérification des données envoyées par le formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['member_id'], $_POST['name'], $_POST['email'], $_POST['message']) &&
        !empty($_POST['member_id']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

        $member_id = intval($_POST['member_id']); // Sécurisation de l'ID
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = htmlspecialchars(trim($_POST['message']));

        // Vérifier que l'ID du membre existe
        $stmt = $pdo->prepare("SELECT * FROM member WHERE id = ?");
        $stmt->execute([$member_id]);
        $row = $stmt->fetch();

        if (!$row) {
            die("Erreur : Le membre avec cet ID n'existe pas.");
        }

        // Insertion du message dans la table `member`
        $stmt_insert = $pdo->prepare("UPDATE user SET  email_utilisateur = ?, message = ? WHERE iduser = ?");
        if ($stmt_insert->execute([$email, $message, $member_id])) {
            echo "Le formulaire a été correctement enregistré.";
        } else {
            echo "Erreur lors de l'enregistrement des données.";
        }

    } else {
        echo "Erreur : Tous les champs sont obligatoires.";
    }
} else {
    echo "Accès interdit.";
}
?>