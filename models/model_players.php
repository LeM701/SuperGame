<?php
declare(strict_types=1);

class ModelPlayers {
    private PDO $bdd;

    // Connection to the database
    public function __construct() {
        require_once 'env.php';
        
        $this->bdd = new PDO(
            "mysql:host={$_ENV['DBhost']};dbname={$_ENV['DBname']};charset=utf8",
            $_ENV['login'],
            $_ENV['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    // Add a player to the database
    public function addPlayer(string $pseudo, string $email, int $score): void {
        $this->bdd->beginTransaction();
        try {
            // Duplicate check
            $stmt = $this->bdd->prepare("SELECT COUNT(id) FROM joueurs WHERE pseudo = ? OR email = ?");
            $stmt->execute([$pseudo, $email]);
            if ($stmt->fetchColumn() > 0) {
                throw new RuntimeException('Ce pseudo ou email est déjà utilisé.');
            }

            // Insertion
            $stmt = $this->bdd->prepare("INSERT INTO joueurs (pseudo, email, score) VALUES (?, ?, ?)");
            $stmt->execute([$pseudo, $email, $score]);
            
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            throw new RuntimeException('Erreur de base de données: ' . $e->getMessage());
        }
    }

    // Retrieve the list of players
    public function getPlayer(): array {
        $stmt = $this->bdd->query("SELECT pseudo, email, score FROM joueurs ORDER BY score DESC");
        return $stmt->fetchAll() ?: [];
    }
}
?>