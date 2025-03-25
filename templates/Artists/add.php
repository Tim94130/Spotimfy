<h1>Ajouter un artiste</h1>

<?= $this->Form->create($artist) ?>
<fieldset>
    <legend><?= __('Veuillez renseigner les informations de l\'artiste') ?></legend>
    <?php
        echo $this->Form->control('name', ['label' => 'Nom de l\'artiste']);
        echo $this->Form->control('bio', ['label' => 'Biographie', 'type' => 'textarea']);
        echo $this->Form->control('player', ['label' => 'Lien du player Spotify']);
    ?>
</fieldset>
<?= $this->Form->button(__('Enregistrer')) ?>
<?= $this->Form->end() ?>

<?= $this->Html->link('Retour à la liste', ['action' => 'index'], ['class' => 'button']) ?>
