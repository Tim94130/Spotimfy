<h1>Connexion</h1>


<?= $this->Form->create() ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
    <?= $this->Form->button('Connexion') ?>
<?= $this->Form->end() ?>
