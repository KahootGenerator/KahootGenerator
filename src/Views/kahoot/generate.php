<?php
use App\Helper;

?>

<form action="/kahoot/generate/attempt" method="POST" class="form">
    <h1><?= $data["title"] ?></h1>

    <div class="form-field--full">
        <label for="theme">Thème :</label>
        <input class="field" type="text" id="theme" name="theme">
    </div>
    <div class="form-field--double">
        <div>
            <label for="quantity">Nombre de question :</label>
            <input class="field" type="number" id="quantity" name="quantity" min="1" max="20" value="1">
        </div>

        <div>

            <label for="lang">Langue du questionnaire :</label>

            <details class="select" id="lang">
                <summary>
                    <input type="radio" name="lang" title="Choisir une langue" checked>
                    <?php foreach ($languages as $language) { ?>
                        <input type="radio" name="lang" id="lang_<?= Helper::escape($language->getId()) ?>"
                            title="<?= Helper::escape($language->getLibelle()) ?>" value="<?= $language->getId();?>">
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
        </div>

    </div>
    <div class="form-field--double">
        <div>
            <label for="diff">Difficulté :</label>

            <details class="select" id="diff">
                <summary>
                    <input type="radio" name="diff" title="Choisir une difficulté" checked>
                    <?php foreach ($difficulties as $difficulty) { ?>
                        <input type="radio" name="diff" id="diff_<?= Helper::escape($difficulty->getId()) ?>"
                            title="<?= Helper::escape($difficulty->getLibelle()) ?>" value="<?= $difficulty->getId();?>">
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
        </div>

    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox1" class="checkbox" name="includeBools" value="">
            <label for="checkbox1"><img src="/img/utils/check.svg"></label>
            <label for="checkbox1">Inclure des vrais ou faux</label>
        </div>
    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox2" class="checkbox" name="multiCorrect" value="">
            <label for="checkbox2"><img src="/img/utils/check.svg"></label>
            <label for="checkbox2"> Plusieurs réponse correctes pour une question</label>
        </div>
    </div>

    <div>
        <input type="submit" value="Valider" class="button-orange">
    </div>

</form>
<script type="module" src="/js/components/select.js"></script>