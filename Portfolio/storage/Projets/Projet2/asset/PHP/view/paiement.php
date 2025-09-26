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
            padding: 20px;
        }
        .donation-box {
            background-color: #fff;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        button {
            background-color:black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color:lightgray;
        }
    </style>
</head>
<body>
    <h1>CHOISSISSEZ VOTRE MODE DE PAIEMENT</h1>
    <p>Votre générosité nous aide à poursuivre notre mission.</p>

    <div class="donation-box">
        <form action="https://www.paypal.com/donate" method="post" target="_blank">
            <!-- Informations nécessaires pour PayPal -->
            <input type="hidden" name="hosted_button_id" value="VOTRE_BOUTON_PAYPAL">
            <button type="submit">Faire un Don via PayPal</button>
        </form>
        <br>
        <form action="/asset//PHP/view/paiementcb.php" method="post">
            <!-- Remplacez par l'intégration de Stripe -->
            <input type="hidden" name="amount" value="10">
            <button type="submit">Faire un Don par Carte Bancaire</button>
        </form>
    </div>
</body>
</html>