<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 * @var string[]|\Cake\Collection\CollectionInterface $artists
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $album->id],
                ['confirm' => __('Es-tu sûr de vouloir supprimer l’album #{0} ?', $album->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Liste des Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums form content">
            <?= $this->Form->create($album) ?>
            <fieldset>
                <legend><?= __('Modifier l\'album') ?></legend>
                <?php
                    echo $this->Form->control('title', ['label' => 'Titre de l’album']);
                    echo $this->Form->control('date_release', [
                        'label' => 'Date de sortie',
                        'type' => 'date',
                        'empty' => true
                    ]);
                    echo $this->Form->control('player', ['label' => 'Lien Spotify (iframe ou embed)']);
                    echo $this->Form->control('artist_id', [
                        'label' => 'Artiste associé',
                        'options' => $artists,
                        'empty' => 'Sélectionner un artiste...'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
