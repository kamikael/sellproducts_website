<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rejet de votre demande</title>
</head>
<body>
    <p>Bonjour {{ $user->name }},</p>

    <p>Nous vous informons que votre demande d'inscription a été rejetée. Vous pouvez nous contacter si vous pensez qu'il s'agit d'une erreur.</p>
    <p><strong>Motif :</strong> {{ $motif }}</p>

    <p>Merci de votre compréhension.</p>
</body>
</html>
