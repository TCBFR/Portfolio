<?php

include __DIR__ . '/partials/header.php';
?>

    <style>
h1{
    font-family: 'hades', sans-serif;
}
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0px;
            background-image: url('/image/catdon.jpg');
            background-size: cover;
        }
        .donation-form {
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .donation-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .donation-form button {
            background-color:black;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .donation-form button:hover {
            background-color:lightgray;
        }
    </style>
</head>
<body>
    <h1>DONATE</h1>
    <p>Your generosity supports our mission to help cats in distress. Thank you!</p>

    <form class="donation-form" action="/asset/PHP/view/paiement.php" method="POST">
        <label for="name">Firsname :</label>
        <input type="text" id="name" name="name" placeholder="Votre nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>

        <label for="amount">Donation amount (€) :</label>
        <input type="number" id="amount" name="amount" placeholder="10" required min="0">

        <button type="submit">DONATE</button>
    </form>
</body>
</html>