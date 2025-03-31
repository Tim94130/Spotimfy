<h2>Ajouter un album</h2>

<?= $this->Form->create($album) ?>

<?= $this->Form->control('title', ['label' => 'Titre de l’album']) ?>

<?= $this->Form->control('date_release', [
    'label' => 'Date de sortie',
    'type' => 'date',
    'empty' => true
]) ?>

<?= $this->Form->control('player', ['label' => 'Lien Spotify (iframe ou embed)']) ?>

<?= $this->Form->control('artist_id', [
    'label' => 'Artiste associé',
    'options' => $artists,
    'empty' => 'Sélectionner un artiste...'
]) ?>

<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>
