<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(__('🗑️ Supprimer'), ['action' => 'delete', $album->id], [
                'confirm' => __('Es-tu sûr de vouloir supprimer l’album #{0} ?', $album->id),
                'class' => 'side-nav-item'
            ]) ?>
            <?= $this->Html->link(__('📁 Liste des albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="albums view content">
            <h3><?= h($album->title) ?></h3>

            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($album->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date de sortie') ?></th>
                    <td><?= $album->date_release ? $album->date_release->format('d/m/Y') : '-' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lecteur Spotify') ?></th>
                    <td><?= $album->player ? $album->player : '-' ?></td>
                </tr>
                <tr>
                    <th><?= __('Artiste') ?></th>
                    <td>
                        <?= $album->artist ? $this->Html->link(
                            $album->artist->name,
                            ['controller' => 'Artists', 'action' => 'view', $album->artist->id]
                        ) : '-' ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($album->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td><?= h($album->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié le') ?></th>
                    <td><?= h($album->modified) ?></td>
                </tr>
            </table>

            <?php if (!empty($album->player)): ?>
                <div style="margin-top: 20px;">
                    <h4><?= __('Écouter sur Spotify') ?></h4>
                    <div><?= $album->player ?></div>
                </div>
            <?php endif; ?>

            <div class="related" style="margin-top: 30px;">
                <h4><?= __('Favoris associés') ?></h4>
                <?php if (!empty($album->favorites)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Utilisateur') ?></th>
                                <th><?= __('Date') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($album->favorites as $favorite) : ?>
                                <tr>
                                    <td><?= h($favorite->id) ?></td>
                                    <td><?= h($favorite->user_id) ?></td>
                                    <td><?= h($favorite->created) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('Voir'), ['controller' => 'Favorites', 'action' => 'view', $favorite->id]) ?>
                                        <?= $this->Html->link(__('Modifier'), ['controller' => 'Favorites', 'action' => 'edit', $favorite->id]) ?>
                                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Favorites', 'action' => 'delete', $favorite->id], [
                                            'confirm' => __('Supprimer le favori #{0} ?', $favorite->id)
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Aucun favori associé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
