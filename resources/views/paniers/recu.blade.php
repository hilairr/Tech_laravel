<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de commande #{{ $commande->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Reçu de commande</h2>
    <div class="info">
        <p><strong>Numéro de commande :</strong> #{{ $commande->id }}</p>
        <p><strong>Montant total :</strong> {{ number_format($commande->total, 2) }} F CFA</p>
        <p><strong>Statut :</strong> {{ ucfirst($commande->status) }}</p>
        <p><strong>Téléphone :</strong> +226 {{ $commande->phone_number }}</p>
        <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="footer">
        Merci pour votre confiance !  
        <br>Votre commande a bien été enregistrée et payée.
    </div>
</body>
</html>
