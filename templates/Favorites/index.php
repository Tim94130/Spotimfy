<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Favorite> $favorites
 */
?>

<div class="favorites index content">
    <?= $this->Html->link('➕ Nouveau favori', ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>⭐ Mes favoris</h3>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Utilisateur</th>
                    <th>Album</th>
                    <th>Artiste</th>
                    <th>Ajouté le</th>
                    <th>Modifié le</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($favorites as $favorite): ?>
                    <tr>
                        <td><?= $this->Number->format($favorite->id) ?></td>

                        <td>
                            <?= $favorite->user
                                ? $this->Html->link(h($favorite->user->username), ['controller' => 'Users', 'action' => 'view', $favorite->user->id])
                                : '-' ?>
                        </td>

                        <td>
                            <?= $favorite->album
                                ? $this->Html->link(h($favorite->album->title), ['controller' => 'Albums', 'action' => 'view', $favorite->album->id])
                                : '-' ?>
                        </td>

                        <td>
                            <?= $favorite->artist
                                ? $this->Html->link(h($favorite->artist->name), ['controller' => 'Artists', 'action' => 'view', $favorite->artist->id])
                                : '-' ?>
                        </td>

                        <td><?= h($favorite->created) ?></td>
                        <td><?= h($favorite->modified) ?></td>

                        <td class="actions">
                            <?= $this->Html->link('👁️ Voir', ['action' => 'view', $favorite->id]) ?>
                            <?= $this->Html->link('✏️ Modifier', ['action' => 'edit', $favorite->id]) ?>
                            <?= $this->Form->postLink(
                                '🗑️ Supprimer',
                                ['action' => 'delete', $favorite->id],
                                ['confirm' => __('Supprimer le favori #{0} ?', $favorite->id)]
                            ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, affichage de {{current}} élément(s) sur {{count}} total')) ?></p>
    </div>
</div>
