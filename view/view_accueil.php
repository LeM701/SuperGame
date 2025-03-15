<main>

    <section>
    <h2>Enregistrer un nouveau joueur</h2>
    <form action="index.php" method="post">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required><br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>
        <label for="score">Score :</label>
        <input type="number" id="score" name="score" required><br>
        <input type="submit" name="submit" value="Enregistrer">
    </form>
    </section>
<section>
    <h2>Liste des joueurs</h2>
    <table>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Score</th>
        </tr>
        <?php
        require_once 'model/model_joueurs.php';
        $model = new ModelJoueurs();
        $joueurs = $model->getJoueurs();
        
        foreach ($joueurs as $joueur) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($joueur['pseudo']) . "</td>";
            echo "<td>" . htmlspecialchars($joueur['email']) . "</td>";
            echo "<td>" . htmlspecialchars($joueur['score']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </section>
</main>
