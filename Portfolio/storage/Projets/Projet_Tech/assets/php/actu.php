<?php
$title = 'actualité';
include 'elements/header.php';

?>
<h1>Nos actualités</h1>
<?php
$dsn = 'mysql:dbname=sio;host=127.0.0.1';
$user = 'root';
$password = '';

$conn = new PDO($dsn, $user, $password);

$sql = "SELECT titre, contenu, date_creation FROM articles WHERE id = 1";
$stmnt = $conn->query($sql);
$stmnt->execute();
$result = $stmnt->fetchAll();
foreach ($result as $articles) {
    echo "$articles[title]";
    echo "<p>" . $articles['body'] . "</p>";
}
?>
    <p> ipsum dolor sit amet consectetur adipisicing elit. Officia at dicta repellat quam repellendus, atque officiis consequuntur excepturi qui? Pariatur quod beatae cupiditate necessitatibus quae velit, quo mollitia ratione voluptates.</p>

<?php
include 'elements/footer.php';
?>