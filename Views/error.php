<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body class="red lighten-4">
    <div class="container">
        <h3 class="red-text">Une erreur est survenue</h3>
        <p><?= htmlspecialchars($message) ?></p>
        <a href="index.php" class="btn red">Retour à l'accueil</a>
    </div>
</body>
</html>
