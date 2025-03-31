<?php

/**
 * Spotiflow : Plateforme de gestion musicale
 * @var \App\View\AppView $this
 */
$appName = 'Spotiflow';
$identity = $this->request->getAttribute('identity');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= h($appName) ?> : <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build(['controller' => 'Artists', 'action' => 'index']) ?>">
                <span>Spo</span><span>Timfy</span>
            </a>
        </div>

        <div class="top-nav-links">
            <?php if ($identity): ?>
                <span style="margin-right: 15px;">
                    🙋 Connecté en tant que <strong><?= h($identity->get('username')) ?></strong>
                </span>
                <?= $this->Html->link('🚪 Déconnexion', ['controller' => 'Users', 'action' => 'logout']) ?>

                <?php if ($identity->get('role') === 'user'): ?>
                    |
                    <?= $this->Html->link('📬 Mes demandes', ['controller' => 'Requests', 'action' => 'myRequests']) ?>
                    |
                    <?= $this->Html->link('➕ Ajouter une demande', ['controller' => 'Requests', 'action' => 'add']) ?>
                <?php endif; ?>

                <?php if ($identity->get('role') === 'admin'): ?>
                    |
                    <?= $this->Html->link('🛠️ Gérer les demandes', ['controller' => 'Requests', 'action' => 'index']) ?>
                <?php endif; ?>

                |
                <?= $this->Html->link('📈 Statistiques', ['controller' => 'Stats', 'action' => 'index']) ?>
            <?php else: ?>
                <?= $this->Html->link('🔐 Connexion', ['controller' => 'Users', 'action' => 'login']) ?>
                |
                <?= $this->Html->link('📝 Inscription', ['controller' => 'Users', 'action' => 'register']) ?>
            <?php endif; ?>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer></footer>
</body>

</html>