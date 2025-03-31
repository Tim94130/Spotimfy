<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorite $favorite
 * @var \Cake\Collection\CollectionInterface|string[] $albums
 * @var \Cake\Collection\CollectionInterface|string[] $artists
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Favorites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="favorites form content">
            <?= $this->Form->create($favorite) ?>
            <fieldset>
                <legend>Ajouter aux favoris</legend>

                <?= $this->Form->control('type', [
                    'type' => 'select',
                    'options' => ['album' => 'Album', 'artist' => 'Artiste'],
                    'label' => 'Type de contenu',
                    'empty' => '-- Choisir --',
                    'id' => 'type-select'
                ]) ?>

                <div id="album-select" style="display: none;">
                    <?= $this->Form->control('album_id', [
                        'options' => $albums,
                        'label' => 'Album à ajouter',
                        'empty' => '-- Sélectionner un album --'
                    ]) ?>
                </div>

                <div id="artist-select" style="display: none;">
                    <?= $this->Form->control('artist_id', [
                        'options' => $artists,
                        'label' => 'Artiste à ajouter',
                        'empty' => '-- Sélectionner un artiste --'
                    ]) ?>
                </div>

            </fieldset>

            <?= $this->Form->button('Ajouter aux favoris') ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    const typeSelect = document.getElementById('type-select');
    const albumSelect = document.getElementById('album-select');
    const artistSelect = document.getElementById('artist-select');

    function toggleFields() {
        if (typeSelect.value === 'album') {
            albumSelect.style.display = 'block';
            artistSelect.style.display = 'none';
        } else if (typeSelect.value === 'artist') {
            artistSelect.style.display = 'block';
            albumSelect.style.display = 'none';
        } else {
            albumSelect.style.display = 'none';
            artistSelect.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', toggleFields);
    typeSelect.addEventListener('change', toggleFields);
</script>
