<?php
include_once '../functions.php';
$error = null;
$message = null;
if (! is_connected()) {
    header('Location: ../connexion.php');
}
try{
    $pdo = new PDO('mysql:dbname=sio;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    if(!empty($_POST)){
        $sql = "INSERT INTO news (title, body) VALUES (:title, :body)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title'=>$_POST['title'],
            'body'=>$_POST['body'],
        ]);

        $message = "Votre news a bient été enregistrée...";
    }

    if(isset($_GET['id'])){
        $sql="DELETE FROM news WHERE knews = {$_GET['id']}";
        $pdo->exec($sql);

        $message = "Votre news a bient été supprimée...";
    }

    $sql = "SELECT * FROM news";
    $stmt = $pdo->query($sql);
    
    $news = $stmt->fetchAll();
}catch(PDOException $e){
    $error =  'ERREUR : '. $e->getMessage();
}

include '../elements/header.php';
?>
<?= alert($error, "danger") ?>
<?= alert($message, "success") ?>

<h1>Administration</h1>
    <?php foreach($news as $uneNews):?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="/admin/show.php?id=<?=$uneNews->knews?>">
                        <?= $uneNews->title?>
                    </a>
                </h5>
                <p class="card-text"><?= cut($uneNews->body, 100)?></p>

                <a href="/admin/edit.php?id=<?=$uneNews->knews?>" class="btn btn-primary">Editer la news</a>
                <a href="?id=<?=$uneNews->knews?>" class="btn btn-danger">Supprimer la news</a>
            </div>
        </div>
    <?php endforeach ?>

    <hr>

    <form action="" method="POST">
        <div class="mb-4">
            <label for="title">Titre de la news</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>
        <div class="mb-4">
            <label for="body">Texte de la news</label>
            <textarea id="body" name="body" class="form-control"></textarea>
        </div>
        <input type="submit" value="Modifier la news" class="btn btn-primary">
    </form>
<?php include '../elements/footer.php'; ?>