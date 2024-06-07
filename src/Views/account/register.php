<?php
use App\Helper;

?>

<form class="form" action="/account/register/attempt/" method="post" enctype="multipart/form-data">
    <h1><?= $data["title"] ?></h1>
    <div class="form-field--75">
        <label for="username">Nom d'utilisateur :</label>
        <input class="field" type="text" name="username" id="username" value="<?= Helper::old("username"); ?>">
        <span for="username" class="error">
            <?= Helper::error("username"); ?>
        </span>
    </div>
    <div class="form-field--75">
        <label for="password">Mot de passe :</label>
        <input class="field" type="password" name="password" id="password" value="<?= Helper::old("password"); ?>">
        <span for="password" class="error">
            <?= Helper::error("password"); ?>
        </span>
    </div>
    <button class="button-orange" type="submit">S'inscrire</button>

    <p>Vous avez deja un compte ?</p>
    <a href="/account/register/">Connectez-vous !</a>
</form>