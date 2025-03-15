<?php
require_once 'model/model_joueurs.php';
require_once 'utils/utils.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $pseudo = sanitize($_POST['pseudo']);
    $email = sanitize($_POST['email']);
    $score = (int) sanitize($_POST['score']);

    $model = new ModelJoueurs();
    $message = $model->addJoueur($pseudo, $email, $score);
    echo "<p>$message</p>";
}

include 'view/view_accueil.php';
?>