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

    if(!empty($_POST)){
        $sql = "UPDATE news SET title=:title, body=:body WHERE knews=:knews";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $_POST['title'] ?? null,
            'body' => $_POST['body'] ?? null,
            'knews' => $knews,
        ]);
    }

    $sql = "SELECT * FROM news WHERE knews=$knews";
    $stmt = $pdo->query($sql);
    // var_dump($stmt->fetch());
    // die();
    $news = $stmt->fetch();

}catch(PDOException $e){
    $error =  'ERREUR : '. $e->getMessage();
}

/**
 * VIEW
 */
include '../elements/header.php';
?>
<?= alert($error, "danger") ?>

<h1>Edition</h1>
<a href="/admin/" class="btn btn-secondary mb-4">Retour à l'index</a>
<form action="" method="POST">
    <div class="mb-4">
        <label for="title">Titre de la news</label>
        <input type="text" id="title" name="title" class="form-control" value="<?=$news->title?>">
    </div>
    <div class="mb-4">
        <label for="body">Texte de la news</label>
        <textarea id="body" name="body" class="form-control"><?=$news->body?></textarea>
    </div>
    <input type="submit" value="Modifier la news" class="btn btn-primary">
</form>
<?php include '../elements/footer.php'; ?>