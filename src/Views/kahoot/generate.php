<?php

use App\Helper;

?>

<form action="/kahoot/generate/attempt" method="POST" class="form" id="formGen">
    <h1><?= $data["title"] ?></h1>

    <div class="form-field--full">
        <label for="theme">Thème :</label>
        <input class="field" type="text" id="theme" name="theme">
        <span class="error">
            <?= Helper::error("theme"); ?>
        </span>
    </div>
    <div class="form-field--double">
        <div>
            <label for="quantity">Nombre de question :</label>
            <input class="field" type="number" id="quantity" name="quantity" value="1">
            <span class="error">
                <?= Helper::error("quantity"); ?>
            </span>
        </div>

        <div>

            <label for="lang">Langue du questionnaire :</label>

            <details class="select" id="lang" data-selected="Français">
                <summary>
                    <?php foreach ($languages as $language) { ?>
                        <input type="radio" name="lang" id="lang_<?= Helper::escape($language->getId()) ?>"
                            title="<?= Helper::escape($language->getLibelle()) ?>" value="<?= $language->getId(); ?>"
                            <?= Helper::escape($language->getLibelle()) === "Français" ? "checked" : "" ?>>
                    <?php } ?>
                </summary>
                <ul>
                    <?php foreach ($languages as $language) { ?>
                        <li>
                            <label
                                for="lang_<?= Helper::escape($language->getId()) ?>"><?= Helper::escape($language->getLibelle()) ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </details>
            <span class="error">
                <?= Helper::error("lang"); ?>
            </span>
        </div>

    </div>
    <div class="form-field--double">
        <div>
            <label for="diff">Difficulté :</label>

            <details class="select" id="diff" data-selected="Aléatoire">
                <summary>
                    <?php foreach ($difficulties as $difficulty) { ?>
                        <input type="radio" name="diff" id="diff_<?= Helper::escape($difficulty->getId()) ?>"
                            title="<?= Helper::escape($difficulty->getLibelle()) ?>" value="<?= $difficulty->getId(); ?>"
                            <?= Helper::escape($difficulty->getLibelle()) === "Aléatoire" ? "checked" : "" ?>>
                    <?php } ?>
                </summary>
                <ul>
                    <?php foreach ($difficulties as $difficulty) { ?>
                        <li>
                            <label
                                for="diff_<?= Helper::escape($difficulty->getId()) ?>"><?= Helper::escape($difficulty->getLibelle()) ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </details>
            <span class="error">
                <?= Helper::error("diff"); ?>
            </span>
        </div>

    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox1" class="checkbox" name="includeBools" value="true">
            <label for="checkbox1"><img src="/img/utils/check.svg"></label>
            <label for="checkbox1">Inclure des vrais ou faux</label>
        </div>
    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox2" class="checkbox" name="multiCorrect" value="true">
            <label for="checkbox2"><img src="/img/utils/check.svg"></label>
            <label for="checkbox2"> Plusieurs réponse correctes pour une question</label>
        </div>
    </div>

    <div>
        <input type="submit" value="Valider" class="button-orange button-xl">
    </div>

</form>
<div class="main-container" id="waitingContainer">
    <h1>Génération du Kahoot</h1>
    <div class="spinner-container">
        <div class="pencil">
            <div class="pencil__ball-point"></div>
            <div class="pencil__cap"></div>
            <div class="pencil__cap-base"></div>
            <div class="pencil__middle"></div>
            <div class="pencil__eraser"></div>
        </div>
        <div class="line"></div>
    </div>
    <span id="generationText">Votre kahoot en en cours de génération. Merci de patienter</span>
</div>
<script type="module" src="/js/validator-form/generator.js"></script>
<script type="module" src="/js/components/select.js"></script>
<script type="module" src="/js/apiWaiting.js"></script>