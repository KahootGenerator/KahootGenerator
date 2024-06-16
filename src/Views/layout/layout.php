<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Kahoot generator">
    <!-- <meta name="keywords" content="Keywords relevant to your project"> -->
    <!-- <meta name="author" content="Your name or the name of your organization"> -->
    <link rel="stylesheet" href="/style/main.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <title><?= isset($data['title']) ? "Kahoot Generator - " . $data['title'] : "Kahoot Generator" ?></title>
</head>

<body
    style="background-image: url(/img/bg/<?= isset($data["backgroundName"]) ? $data["backgroundName"] : "kahoot" ?>.svg)">
    <header>
        <nav>
            <a class="logo" href="/">
                <img src="/img/logo.webp" alt="Logo">
            </a>
            <div>
                <ul>
                    <li>
                        <a href="/" class="link">Accueil</a>
                    </li>
                    <li>
                        <a href="/kahoot/generate/" class="link">Créer un Kahoot</a>
                    </li>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li>
                            <a href="/kahoot/" class="link">Mes Kahoot</a>
                        </li>
                    <?php } ?>
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
    <main>
        <?= $content ?>
    </main>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);