<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $email = htmlspecialchars($_POST['email']);
    $specialite = htmlspecialchars($_POST['specialite']);
    $photo = $_FILES['photo'];

    // Générer un mot de passe par défaut et le hasher
    $default_password = password_hash("Default123", PASSWORD_BCRYPT);

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=equipe_db;charset=utf8", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        
        // Insérer le membre dans la table "member"
        $stmt = $pdo->prepare("INSERT INTO member (firstnamemb, lastnamemb, descriptionmb, email, idspe, photo) 
                               VALUES (:firstnamemb, :lastnamemb, :descriptionmb, :email, :idspe, :photo)");
        $stmt->execute([
            ':firstnamemb' => $prenom,
            ':lastnamemb' => $nom,
            ':descriptionmb' => $description,
            ':email' => $email,
            ':idspe' => $specialite,
            ':photo' => $photo['name']
        ]);
        $stmt = $pdo->prepare("INSERT INTO user (emailuser, password, idspe) VALUES (:emailuser, :password, :idspe)");
        $stmt->execute([
            ':emailuser' => $email,
            ':password' => password_hash("Default123", PASSWORD_BCRYPT),
            ':idspe' => $specialite
        ]);
        // Insérer l'email et le password par défaut dans "users"
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE emailuser = ?");
        $stmt->execute([$email]);
        $emailExists = $stmt->fetchColumn();
if ($emailExists) {
    die("Erreur : Cet email est déjà enregistré !");
}
        echo "Profil membre créé avec succès ! Identifiants générés : Email = $email, Password = Default123.";
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
    $pdo->beginTransaction();

try {
    // Insérer le membre
    $stmt_insert_member = $pdo->prepare("INSERT INTO member (firstnamefb, lastnamefb, email, descriptionfb, idspe) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert_member->execute([$firstname, $lastname, $email, $description, $idspe]);

    // Récupérer l'ID du membre ajouté
    $member_id = $pdo->lastInsertId();

    // Générer un mot de passe automatique sécurisé
    $password = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);

    // Insérer le user correspondant
    $stmt_insert_user = $pdo->prepare("INSERT INTO user (iduser, emailuser, password, idspe, role) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert_user->execute([$member_id, $email, $password, $idspe, 'user']);

    $pdo->commit();
    echo "Le membre et son profil utilisateur ont été créés avec succès.";

} catch (Exception $e) {
    $pdo->rollBack();
    die("Erreur : " . $e->getMessage());
}
function generatePassword($length = 8) {
    return bin2hex(random_bytes($length / 2)); // Convertit en caractères hexadécimaux
}

$generated_password = generatePassword(); // Mot de passe aléatoire
$hashed_password = hash('sha256', $generated_password);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Profil</title>
</head>
<body>
<div class="formulaire">
    <h1>Créer un Profil</h1>
    
    <form action="process_form.php" method="POST" enctype="multipart/form-data">
        <label for="firstnamemb">Prénom :</label>
        <input type="text" id="firstnamemb" name="firstnamemb" required><br><br>

        <label for="lastnamemb">Nom :</label>
        <input type="text" id="lastnamemb" name="lastnamemb" required><br><br>

        <label for="descriptionmb">Description :</label>
        <textarea id="descriptionmb" name="descriptionmb"></textarea><br><br>
        
        <label for="descriptionmb">Email :</label>
        <input type="email" name="email" placeholder="Email du membre" required>
        <label for="profile_picture">Photo de profil :</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required><br><br>

        <label for="idspe">Spécialité :</label>
        <select id="idspe" name="idspe" required>
        <option value="">Sélectionnez une spécialité</option>
        <option value="3">Communication</option>
        <option value="4">Comptabilité</option>
        <option value="5">Informatique</option>
        </select><br><br>
        <button type="submit">Créer le Profil</button>
        </div>
    </form>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .formulaire {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>