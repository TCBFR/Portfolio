<?php
session_start();
session_destroy();
header("Location: /asset/PHP/view/login.php");
exit();
?>