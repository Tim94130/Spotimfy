<h1>🎵 Tous les albums</h1>

<?php /*
<?= $this->Html->link(
    '➕ Ajouter un album',
    ['action' => 'add'],
    ['class' => 'button', 'style' => 'margin-bottom: 20px; display: inline-block; padding: 10px; background-color: #1DB954; color: white; border-radius: 5px; text-decoration: none;']
) ?>
*/ ?>


<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php foreach ($albums as $album): ?>
        <div style="border: 1px solid #ccc; border-radius: 8px; padding: 10px; width: 300px; background: #f9f9f9;">
            <h3>
                <?= h($album->title) ?>
                <?php if ($album->date_release): ?>
                    (<?= h($album->date_release->format('Y')) ?>)
                <?php endif; ?>
            </h3>

            <p><strong>Artiste :</strong> <?= h($album->artist->name ?? '-') ?></p>


            <?php if (!empty($album->player)): ?>
                <iframe
                    style="border-radius:12px; margin-top: 5px"
                    src="<?= h($album->player) ?>"
                    width="100%"
                    height="80"
                    frameborder="0"
                    allowtransparency="true"
                    allow="encrypted-media">
                </iframe>
            <?php else: ?>
                <p style="color: red; font-size: 0.9em;"><em>⚠️ Aucun lien Spotify pour cet album</em></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
