<h1>Liste des Artistes</h1>

<?php if (!empty($artists)): ?>
    <ul>
        <?php foreach ($artists as $artist): ?>
            <li>
                <h2><?= h($artist->name) ?></h2>
                <p><?= h($artist->bio) ?></p>
                <!-- Vous pouvez également afficher le player Spotify si présent -->
                <?php if (!empty($artist->player)): ?>
                    <iframe src="<?= h($artist->player) ?>" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?= $this->Html->link('Ajouter un artiste', ['action' => 'add'], ['class' => 'button']) ?>
<?php else: ?>
    <p>Aucun artiste trouvé.</p>
<?php endif; ?>
