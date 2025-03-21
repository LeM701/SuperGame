<?php
declare(strict_types=1);

// Sanitize the data
function sanitize(string $data): string {
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $data;
}

function validatePseudo(string $pseudo): bool {
    // Check if the username is between 3 and 20 characters long
    return preg_match('/^\w{3,20}$/', $pseudo) === 1;
}

function validateScore(int $score): bool {
    // Check if the score is between 0 and 10000
    return $score >= 0 && $score <= 10000;
}
?>