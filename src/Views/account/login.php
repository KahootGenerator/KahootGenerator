<?php
use App\Helper;

?>

<form class="form" action="/account/login/attempt/" method="post" enctype="multipart/form-data">
    <h1><?= $data["title"] ?></h1>
    <div class="form-field--75">
        <label for="username">Nom d'utilisateur :</label>
        <input class="field" type="text" name="username" id="username" placeholder="Username"
            value="<?= Helper::old("username"); ?>">
        <span class="error">
            <?= Helper::error("username"); ?>
        </span>
    </div>
    <div class="form-field--75">
        <label for="password">Mot de passe :</label>
        <input class="field" type="password" name="password" id="password" placeholder="Password"
            value="<?= Helper::old("password"); ?>">
        <span class="error">
            <?= Helper::error("password"); ?>
        </span>
    </div>
    <button class="button-orange" type="submit">Connexion</button>
    <label for="username" class="error">
        <?= Helper::error("message"); ?>
    </label>

    <p>Vous n'avez pas de compte ?</p>
    <a href="/account/register/">Créer un compte</a>
</form>