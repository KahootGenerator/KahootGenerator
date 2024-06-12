<?php
use App\Helper;

?>

<form class="form" action="/account/login/attempt/" method="post" enctype="multipart/form-data">
    <h1><?= $data["title"] ?></h1>
    <div class="form-field--75">
        <label for="username">Nom d'utilisateur :</label>
        <input class="field<?= Helper::error("username") ? "-error" : "" ?>" type="text" name="username" id="username"
            value="<?= Helper::old("username"); ?>">
        <span class="error">
            <?= Helper::error("username"); ?>
            <?= Helper::error("message"); ?>
        </span>
    </div>
    <div class="form-field--75">
        <label for="password">Mot de passe :</label>
        <input class="field<?= Helper::error("password") ? "-error" : "" ?>" type="password" name="password"
            id="password" value="<?= Helper::old("password"); ?>">
        <span class="error">
            <?= Helper::error("password"); ?>
        </span>
    </div>
    <button class="button-orange" type="submit">Connexion</button>

    <div>
        <p>Vous n'avez pas de compte ?</p>
        <a href="/account/register/">Créer un compte</a>
    </div>
</form>