<?php
require_once 'functions.php';
$title = 'Connexion';
$message = null;
$classe = null;
var_dump($_POST);
$nom = $_POST['nom'] ?? null;
$mdp = $_POST['password'] ?? null;
if (isset($_GET['stop'])) {
    unset($_SESSION['connexion']);
} elseif (is_connected()) {
    header('Location: /admin');
} else {
    $bd = [
        'username' => 'admin',
        'password' => 'pwd',
    ];
    if (! empty($nom) && ! empty($mdp)) {
        if ($nom === $bd['username'] && $mdp === $bd['password']) {
            $_SESSION['connexion'] = 1;
            header('Location: /admin');
            exit();
        } else {
            $message = "Erreur d'authentification";
            $classe = 'danger';
        }
    }
}
include 'elements/header.php';
?>
<?= alert($message, $classe) ?>
<form action="" method="POST">
    <fieldset>
        <legend>Connexion</legend>
        <div>
            <p>Entrez votre Identifiant :</p>
            <input type="text" id="nom" name="nom" placeholder="Identifiant" required><br><br>
            <p>Entrez votre Mot de passe :</p>
            <input type="password" id="motdepasse" name="password" placeholder="Mot de passe" /> 
        </div>
    </fieldset>
    <input type="submit" class="btn btn-primary mt-3" value="Connexion">
</form>
<?php include 'elements/footer.php'; ?>