<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <title><?= isset($data['title']) ? "Kahoot Generator - " . $data['title'] : "Kahoot Generator" ?></title>
</head>

<body>
    <header>
        <nav>
            <img class="logo" src="/img/logo.png" alt="Logo">
            <div>
                <ul>
                    <li>
                        <a href="/" class="link">Accueil</a>
                    </li>
                    <li>
                        <a href="/kahoot/generate/" class="link">Créer un kahoot</a>
                    </li>
                </ul>
                <ul>
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li>
                            <a href="/account/login/" class="button-purple">Se connecter</a>
                        </li>
                        <li>
                            <a href="/account/register/" class="button-orange">Créer un compte</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="/account/logout/" class="button-purple">Déconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <main
        style="background-image: url(/img/bg/<?= isset($data["backgroundName"]) ? $data["backgroundName"] : "kahoot" ?>.svg)">
        <?= $content ?>
    </main>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);