<?php if ($user->getErrors()): ?>
    <div class="alert alert-danger" style="padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;">
        <strong>Oups !</strong> Veuillez corriger les erreurs suivantes :
        <ul>
            <?php foreach ($user->getErrors() as $field => $errors): ?>
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?= $this->Form->create($user) ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
    <?= $this->Form->button('S’inscrire') ?>
<?= $this->Form->end() ?>
