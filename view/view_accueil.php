<section class="form-section">
    <h2>Ajouter un joueur</h2>
    <form method="post">
        <!-- CSRF token for security -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <!-- Username input with validation -->
            <input type="text" id="pseudo" name="pseudo" 
                   required
                   pattern="\w{3,20}"
                   placeholder="3-20 caractères">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <!-- Email input HTML validation -->
            <input type="email" id="email" name="email" 
                   placeholder="123456@exemple.com"
                   required>
        </div>

        <div class="form-group">
            <label for="score">Score:</label>
            <!-- Score input -->
            <input type="number" id="score" name="score" 
                   required
                   min="0" 
                   max="10000"
                   step="1"
                   placeholder="0-10000">
        </div>

        <!-- Submit button -->
        <button type="submit" name="submit">Enregistrer</button>
    </form>
</section>

<section>
    <h2>Classement Actuel</h2>
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($joueurs)): ?>
                <?php foreach ($joueurs as $joueur): ?>
                    <tr>
                        <!-- Sanitized player data -->
                        <td><?= htmlspecialchars($joueur['pseudo']) ?></td>
                        <td><?= htmlspecialchars($joueur['email']) ?></td>
                        <td><?= number_format($joueur['score'], 0, '', ' ') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message if no players are registered -->
                <tr>
                    <td colspan="3" class="no-data">Aucun joueur enregistré</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>