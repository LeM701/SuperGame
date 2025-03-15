<?php
class ModelJoueurs {
    private int $id;
    private string $pseudo;
    private string $email;
    private int $score;
    private PDO $bdd;

        public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=supergame', 'root', '');
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getId(): int {
        return $this->id;
    }
    public function getPseudo(): string {
        return $this->pseudo;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getScore(): int {
        return $this->score;
    }
    public function setPseudo(string $pseudo) {
        $this->pseudo = $pseudo;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }
    public function setScore(int $score) {
        $this->score = $score;
    }

    public function addJoueur(string $pseudo, string $email, int $score): string {
        try {
            $stmt = $this->bdd->prepare("SELECT * FROM joueurs WHERE pseudo = :pseudo OR email = :email");
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return "Erreur : un joueur avec le même pseudo ou email existe déjà.";
            }

            $stmt = $this->bdd->prepare("INSERT INTO joueurs (pseudo, email, score) VALUES (:pseudo, :email, :score)");
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':score', $score);
            $stmt->execute();
    
            return "Joueur ajouté avec succès";
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout du joueur : " . $e->getMessage();
        }
    }
    public function getJoueurs(): array {
        $stmt = $this->bdd->query("SELECT pseudo, email, score FROM joueurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getJoueurByPseudo(string $pseudo): array {
        $stmt = $this->bdd->prepare("SELECT * FROM joueurs WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>