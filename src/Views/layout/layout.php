<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style/main.css">
    <title><?= "- ".$data['pageTitle'] ?? "MVC Project" ?></title>
</head>
<body>
    <header>
        <img class="logo" src="/img/logo.png" alt="">
        <nav>
            <a href="">lien 1</a>
            <a href="">lien 2</a>
        </nav>
        <a href="">login/logout</a>
    </header>
    <main>
        <?= $content ?>
    </main>
</body>
</html>