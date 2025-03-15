<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperGame</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>SuperGame - Classement</h1>
        <?php if (!empty($message)): ?>
            <!-- Display success or error message -->
            <div class="alert <?= strpos($message, 'Erreur') !== false ? 'alert-error' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>