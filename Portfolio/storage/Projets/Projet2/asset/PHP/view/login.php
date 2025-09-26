<?php

include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/nav.php';
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 75px;
            margin-left: 500px;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

        }


        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            width: 45%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }

        .btn-admin {
            background-color: #007bff;
        }

        .btn-user {
            background-color: #28a745;
        }

        .btn:hover {
            opacity: 0.8;
        }
    h1{
        font-family: 'hades';
    }
    </style>
</head>
<body>
    <div class="container">
    <h1>Connexion</h1>
        <p>Choisissez votre type de connexion :</p>
        <div class="btn-container">
            <a href="/asset/controller/cat/admin.login.php" class="btn btn-admin">Admin</a>
            <a href="/asset/controller/cat/user.connexion.php" class="btn btn-user">User</a>
        </div>
    </div>

</body>
</html>