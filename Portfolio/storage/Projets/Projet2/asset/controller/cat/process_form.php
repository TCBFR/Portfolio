<?php

$uploadDir = "/asset/uploads/"; // Répertoire de destination pour les images
try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=equipe_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : Impossible de se connecter à la base de données. " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['firstnamemb'] ?? null;
    $nom = $_POST['lastnamemb'] ?? null;
    $description = $_POST['descriptionmb'] ?? '';
    $idspe = $_POST['idspe'] ?? null;

    // Valider les données
    if (!$prenom || !$nom || !$idspe) {
        die("Erreur : Veuillez remplir tous les champs obligatoires.");
    }
    // Vérifier si la spécialité existe
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM specialty WHERE idspe = :idspe");
    $stmtCheck->execute([':idspe' => $idspe]);
    $specialtyExists = $stmtCheck->fetchColumn();

    if (!$specialtyExists) {
        die("Erreur : La spécialité sélectionnée n'existe pas dans la base de données.");
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        die("Erreur : L'email ne peut pas être vide.");
    }
        $fileName = uniqid() . '-' . basename($_FILES['profile_picture']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
        //     die("Erreur : Échec du téléchargement de l'image.");
    //     }
        if (isset($_POST['picturemb']) && !empty($_POST['picturemb'])) {
            $picturemb = $_POST['picturemb'];
        } else {
            $picturemb = "default.jpg"; // Valeur par défaut si aucune image n'est envoyée
        }
        $photoPath = $targetFilePath;
    } else {
        die("Erreur : Aucune image valide n'a été envoyée.");
    }

    // Insérer les données dans la table `member`
    try {
           $query = $pdo->prepare("INSERT INTO member (firstnamemb, lastnamemb, descriptionmb, email, idspe, picturemb, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
$query->execute([
    $_POST['firstnamemb'],
    $_POST['lastnamemb'],
    $_POST['descriptionmb'],
    $email,  // Assure-toi que cette variable est bien remplie
    $_POST['idspe'],
    $picturemb
]);
        echo "Profil créé avec succès.";
    } catch (PDOException $e) {
        die("Erreur : Impossible d'insérer les données. " . $e->getMessage());
    }
    $password = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);

// Insertion dans la table user
$queryUser = $pdo->prepare("INSERT INTO user (email, password, idspe, password_reset) VALUES (?, ?, ?, ?, ?)");
// $queryUser->execute([
    // $_POST['email'],
    // $password,
    // $_POST['idspe'], // Assure-toi que cet ID est bien récupéré
    // 'membre', // Définis un rôle par défaut
    // NULL // Pas de reset de mot de passe pour le moment
// ]);
