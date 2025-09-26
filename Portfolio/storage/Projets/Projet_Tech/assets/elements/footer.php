</div>
</main>
<hr>
<div class="justify-content-end d-flex me-4">
    <ul class="list-group list-group-horizontal">
        <?php if (is_connected()) { ?>
            <?= nav_li('/connexion.php?stop=1', 'Se déconnecter', 'list-group-item list-group-item-danger'); ?>
        <?php } else { ?>
            <?= nav_li('/connexion.php', 'Se connecter', 'list-group-item list-group-item-secondary'); ?>
        <?php }?>
    </ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
