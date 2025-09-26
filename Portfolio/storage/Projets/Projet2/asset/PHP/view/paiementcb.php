<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h1{

        font-family: 'hades', sans-serif;
        }
        .CB {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            padding: 10px;
            font-size: 18px;
            background-color:black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color:lightgrey;
        }
    </style>
</head>
<body>
    <div class="CB">
        <h1>Paiement par Carte Bleue</h1>
        <form action="/process_payment" method="POST">
            <label for="cardName">Nom sur la carte :</label>
            <input type="text" id="cardName" name="cardName" placeholder="Exemple : Jean Dupont" required>

            <label for="cardNumber">Numéro de carte :</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>

            <label for="expiry">Date d'expiration :</label>
            <input type="text" id="expiry" name="expiry" placeholder="MM/AA" required>

            <label for="cvv">Code de sécurité (CVV) :</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>

            <button type="submit" class="btn">Valider le paiement</button>
        </form>
    </div>