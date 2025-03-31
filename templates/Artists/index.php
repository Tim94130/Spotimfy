<h1>🎤 Artistes & Albums</h1>

<?php foreach ($artists as $artist): ?>
    <div style="margin-bottom: 30px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background: #fff;">
        <h2>
            <?= h($artist->name) ?>
            <?= $this->Html->link(
                '⭐',
                ['controller' => 'Favorites', 'action' => 'toggle', 'artist', $artist->id],
                ['style' => 'margin-left: 10px;', 'title' => 'Ajouter ou retirer des favoris']
            ) ?>
        </h2>
        <p><?= h($artist->bio) ?></p>

        <?php if (!empty($artist->player)): ?>
            <iframe
                style="border-radius:12px; margin-top: 10px; margin-bottom: 15px"
                src="<?= h($artist->player) ?>"
                width="300"
                height="80"
                frameborder="0"
                allowtransparency="true"
                allow="encrypted-media">
            </iframe>
        <?php endif; ?>

        <?php if (!empty($artist->albums)): ?>
            <ul style="list-style: none; padding-left: 0;">
                <?php foreach ($artist->albums as $album): ?>
                    <li style="margin-bottom: 15px;">
                        <strong><?= h($album->title) ?> (<?= h($album->date_release?->format('Y') ?? '-') ?>)</strong>

                        <?= $this->Html->link(
                            '⭐',
                            ['controller' => 'Favorites', 'action' => 'toggle', 'album', $album->id],
                            ['style' => 'margin-left: 8px;', 'title' => 'Ajouter/retirer aux favoris']
                        ) ?>

                        <?php if (!empty($album->player)): ?>
                            <div style="margin-top: 5px;">
                                <iframe
                                    style="border-radius:12px"
                                    src="<?= h($album->player) ?>"
                                    width="300"
                                    height="80"
                                    frameborder="0"
                                    allowtransparency="true"
                                    allow="encrypted-media">
                                </iframe>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><em>Aucun album enregistré pour cet artiste.</em></p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
