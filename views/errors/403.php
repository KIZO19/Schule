<?php
// Accès refusé (403 Forbidden)
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Accès refusé</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 40px; background:#f4f6f8; color:#333; }
        .container { max-width: 700px; margin: 0 auto; text-align: center; }
        h1 { font-size: 4rem; margin: 0; }
        p { font-size: 1.1rem; color: #555; }
        a { color: #0069d9; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p>Vous n’êtes pas autorisé à accéder à cette page.</p>
        <p>Si vous pensez que c’est une erreur, reconnectez-vous ou contactez l’administrateur.</p>
        <p><a href="<?= BASE_URL ?>">Retour à l’accueil</a></p>
    </div>
</body>
</html>
