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
        <img class="logo" src="/img/logo.png" alt="">
        <nav>
            <a href="/">Accueil</a>
            <a href="/kahoot/generate">Créer un kahoot</a>
        </nav>
        <button class="login">Créer un compte</button>
    </header>
    <main
        style="background-image: url(/img/bg/<?= isset($data["backgroundName"]) ? $data["backgroundName"] : "kahoot" ?>.svg)">
        <?= $content ?>
    </main>
</body>

</html>