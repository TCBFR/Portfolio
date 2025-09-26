<?php
// Connexion à la base de données en PDO
$dsn = "mysql:host=localhost;dbname=equipe_db;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification et récupération de l'ID du membre depuis l'URL
$member_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$member_email = "";

if ($member_id > 0) {
    // Préparation et exécution de la requête sécurisée
    $stmt = $pdo->prepare("SELECT email FROM member WHERE id = ?");
    $stmt->execute([$member_id]);
    $row = $stmt->fetch();

    if ($row) {
        $member_email = htmlspecialchars($row["email"]);
    } else {
        echo "Aucun email trouvé pour ce membre.";
    }
}
?>
<!DOCTYPE html>
<body>
    <div class="container">
        <h1>Contactez un membre</h1>
        <form id="contactForm" method="post" action="/asset/controller/cat/process.contact.php">

        <label for="member_email">Email du Membre :</label>
            <input type="email" id="member_email" name="member_email" value="<?= $member_email ?>" readonly>
            
            <label for="email">Votre Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Votre Message :</label>
            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
            <textarea name="message" required></textarea>
            
            <!-- <textarea id="message" name="message" required></textarea> -->

            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>

<style>
    h1{
    text-align: center;
    font-family: 'hades', sans-serif;
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
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px gray;
    width: 350px;
}
input, textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}
button {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
}
button:hover {
    background: #0056b3;
}
.error {
    color: red;
    font-weight: bold;
}
</style>
