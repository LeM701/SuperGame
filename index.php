<?php
declare(strict_types=1);
session_start();

require_once 'model/model_joueurs.php';
require_once 'utils/utils.php';

// Initialization of variables
$message = '';
$joueurs = [];

// CSRF handling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        die('Erreur CSRF');
    }

    // Form processing
    $pseudo = sanitize($_POST['pseudo'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $score = (int)($_POST['score'] ?? 0);

    // Validation
    $errors = [];
    if (empty($pseudo) || !preg_match('/^\w{3,20}$/', $pseudo)) {
        $errors[] = 'Pseudo invalide';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email invalide';
    }
    if ($score < 0 || $score > 10000) {
        $errors[] = 'Score invalide (0-10000)';
    }

    if (empty($errors)) {
        try {
            $model = new ModelPlayers();
            $model->addPlayer($pseudo, $email, $score);
            $_SESSION['flash'] = 'Joueur ajouté avec succès';
        } catch (Exception $e) {
            $_SESSION['flash'] = $e->getMessage();
        }
    } else {
        $_SESSION['flash'] = implode('<br>', $errors);
    }

    header('Location: index.php');
    exit;
}

// CSRF token generation
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Data retrieval
try {
    $model = new ModelPlayers();
    $joueurs = $model->getPlayer();
} catch (Exception $e) {
    $message = 'Erreur de base de données: ';
    error_log($e->getMessage());
}

// Flash messages
$message = $_SESSION['flash'] ?? $message;
unset($_SESSION['flash']);

include 'view/header.php';
include 'view/view_accueil.php';
include 'view/footer.php';
?>