<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande approuvée - Eat&Drink</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Félicitations !</h1>
        <h2>Votre demande a été approuvée</h2>
    </div>
    
    <div class="content">
        <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
        
        <p>Nous avons le plaisir de vous informer que votre demande de stand pour <strong>{{ $user->nom_entreprise }}</strong> a été approuvée par notre équipe d'administration.</p>
        
        <h3>🎯 Prochaines étapes :</h3>
        <ol>
            <li><strong>Connectez-vous</strong> à votre compte sur la plateforme Eat&Drink</li>
            <li><strong>Accédez à votre tableau de bord</strong> entrepreneur</li>
            <li><strong>Gérez vos produits</strong> en ajoutant, modifiant ou supprimant des articles</li>
            <li><strong>Personnalisez votre stand</strong> avec une description et des informations</li>
        </ol>
        
        <div style="text-align: center;">
            <a href="{{ url('/login') }}" class="button">Se connecter maintenant</a>
        </div>
        
        <h3>📋 Informations importantes :</h3>
        <ul>
            <li>Votre stand a été automatiquement créé avec le nom de votre entreprise</li>
            <li>Vous pouvez maintenant ajouter vos produits et les gérer</li>
            <li>Les visiteurs pourront voir votre stand et vos produits sur la vitrine publique</li>
            <li>Vous recevrez des notifications pour les commandes passées</li>
        </ul>
        
        <p>Si vous avez des questions ou besoin d'aide, n'hésitez pas à nous contacter.</p>
        
        <p>Cordialement,<br>
        <strong>L'équipe Eat&Drink</strong></p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
        <p>© 2024 Eat&Drink - Tous droits réservés</p>
    </div>
</body>
</html> 