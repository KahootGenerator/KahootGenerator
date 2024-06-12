<?php
use App\Helper;

?>

<form class="form" action="/account/register/attempt/" method="post" enctype="multipart/form-data">
    <h1><?= $data["title"] ?></h1>
    <div class="form-field--75">
        <label for="username">Nom d'utilisateur :</label>
        <input class="field<?= Helper::error("username") ? "-error" : "" ?>" type="text" name="username" id="username"
            value="<?= Helper::old("username"); ?>">
        <span class="error">
            <?= Helper::error("username"); ?>
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
    <button class="button-orange" type="submit">S'inscrire</button>

    <div>
        <p>Vous avez deja un compte ?</p>
        <a href="/account/login/">Connectez-vous !</a>
    </div>
</form>