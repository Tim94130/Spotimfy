<h1>Ajouter un artiste</h1>

<?= $this->Form->create($artist) ?>

    <?= $this->Form->control('name', ['label' => 'Nom de l’artiste']) ?>
    <?= $this->Form->control('bio', ['label' => 'Biographie']) ?>
    <?= $this->Form->control('player', ['label' => 'Lien Spotify (embed)']) ?>
    <?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>
