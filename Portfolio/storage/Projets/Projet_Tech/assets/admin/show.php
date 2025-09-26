<?php
/**
 * CONTROLER
 */
include_once '../functions.php';
$error = null;

if (! is_connected()) {
    header('Location: ../connexion.php');
}

try{
    $knews = $_GET['id'] ?? null;

    $pdo = new PDO('mysql:dbname=sio;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "DELETE FROM news WHERE knews=$knews";
    $stmt = $pdo->query($sql);

    $news = $stmt->fetch();

}catch(PDOException $e){
    $error =  'ERREUR : '. $e->getMessage();
}
include '../elements/header.php';
?>
<?= alert($error, "danger") ?>

<h1>Affichage d'une news</h1>
<a href="/admin/" class="btn btn-secondary mb-4">Retour à l'index</a>
<?php $sql = "SELECT titre, contenu, date_creation FROM articles WHERE id = 1";
 ?>
<h2><?=$articles->title?></h2>
 <p><?=$articles->body?></p>
<?php include '../elements/footer.php'; ?>