<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorite $favorite
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('✏️ Modifier'), ['action' => 'edit', $favorite->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('🗑️ Supprimer'), ['action' => 'delete', $favorite->id], [
                'confirm' => __('Supprimer le favori #{0} ?', $favorite->id),
                'class' => 'side-nav-item'
            ]) ?>
            <?= $this->Html->link(__('📋 Tous les favoris'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('➕ Nouveau favori'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="favorites view content">
            <h3>🎯 Favori #<?= h($favorite->id) ?></h3>

            <table>
                <tr>
                    <th><?= __('Utilisateur') ?></th>
                    <td>
                        <?= $favorite->user ? $this->Html->link(
                            h($favorite->user->username),
                            ['controller' => 'Users', 'action' => 'view', $favorite->user->id]
                        ) : '-' ?>
                    </td>
                </tr>

                <?php if ($favorite->album): ?>
                <tr>
                    <th><?= __('Album') ?></th>
                    <td>
                        <?= $this->Html->link(
                            h($favorite->album->title),
                            ['controller' => 'Albums', 'action' => 'view', $favorite->album->id]
                        ) ?>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if ($favorite->artist): ?>
                <tr>
                    <th><?= __('Artiste') ?></th>
                    <td>
                        <?= $this->Html->link(
                            h($favorite->artist->name),
                            ['controller' => 'Artists', 'action' => 'view', $favorite->artist->id]
                        ) ?>
                    </td>
                </tr>
                <?php endif; ?>

                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td><?= h($favorite->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié le') ?></th>
                    <td><?= h($favorite->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
