<?= $this->Form->create($request) ?>

<?= $this->Form->control('type', [
    'options' => ['artist' => 'Artiste', 'album' => 'Album'],
    'label' => 'Type de demande',
    'id' => 'type-select'
]) ?>

<!-- Champs partagés -->
<?= $this->Form->control('content_name', ['label' => 'Nom']) ?>
<?= $this->Form->control('player', ['label' => 'Lien Spotify']) ?>

<!-- Champs pour artiste -->
<div id="artist-fields" style="display: none;">
    <?= $this->Form->control('bio', ['label' => 'Biographie']) ?>
</div>

<!-- Champs pour album -->
<div id="album-fields" style="display: none;">
    <?= $this->Form->control('date_release', [
        'label' => 'Date de sortie',
        'type' => 'date',
        'empty' => true, // permet de ne pas forcer la sélection
    ]) ?>


    <?= $this->Form->control('artist_id', [
        'label' => 'Artiste existant',
        'options' => $artistsList,
        'empty' => '-- Sélectionner un artiste --'
    ]) ?>

    <?= $this->Form->control('artist_name', [
        'label' => 'Nom de l’artiste (copié)',
        'readonly' => true
    ]) ?>
</div>

<?= $this->Form->button('Envoyer la demande') ?>
<?= $this->Form->end() ?>

<script>
    const typeSelect = document.getElementById('type-select');
    const artistFields = document.getElementById('artist-fields');
    const albumFields = document.getElementById('album-fields');
    const artistId = document.getElementById('artist-id');
    const artistName = document.getElementById('artist-name');

    function updateFormFields() {
        const isArtist = typeSelect.value === 'artist';
        artistFields.style.display = isArtist ? 'block' : 'none';
        albumFields.style.display = !isArtist ? 'block' : 'none';
    }

    function syncArtistName() {
        const selectedOption = artistId.options[artistId.selectedIndex];
        artistName.value = selectedOption.text;
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateFormFields();
        syncArtistName();
    });

    typeSelect.addEventListener('change', updateFormFields);
    artistId.addEventListener('change', syncArtistName);
</script>