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
            <input class="field" type="number" id="quantity" name="quantity" min="1" max="20" value="1">
            <span class="error">
                <?= Helper::error("quantity"); ?>
            </span>
        </div>

        <div>

            <label for="lang">Langue du questionnaire :</label>

            <details class="select" id="lang">
                <summary>
                    <input type="radio" name="lang" title="Choisir une langue" checked>
                    <?php foreach ($languages as $language) { ?>
                        <input type="radio" name="lang" id="lang_<?= Helper::escape($language->getId()) ?>" title="<?= Helper::escape($language->getLibelle()) ?>" value="<?= $language->getId(); ?>">
                    <?php } ?>
                </summary>
                <ul>
                    <?php foreach ($languages as $language) { ?>
                        <li>
                            <label for="lang_<?= Helper::escape($language->getId()) ?>"><?= Helper::escape($language->getLibelle()) ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </details>
            <span class="error">
                <?= Helper::error("language"); ?>
            </span>
        </div>

    </div>
    <div class="form-field--double">
        <div>
            <label for="diff">Difficulté :</label>

            <details class="select" id="diff">
                <summary>
                    <input type="radio" name="diff" title="Choisir une difficulté" checked>

                    <?php foreach ($difficulties as $difficulty) { ?>
                        <input type="radio" name="diff" id="diff_<?= Helper::escape($difficulty->getId()) ?>" title="<?= Helper::escape($difficulty->getLibelle()) ?>" value="<?= $difficulty->getId(); ?>">
                    <?php } ?>
                </summary>
                <ul>
                    <?php foreach ($difficulties as $difficulty) { ?>
                        <li>
                            <label for="diff_<?= Helper::escape($difficulty->getId()) ?>"><?= Helper::escape($difficulty->getLibelle()) ?></label>
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
        <input type="submit" value="Valider" class="button-orange button-l">
    </div>

</form>
<div class="main-container" id="waitingContainer">
    <h1>Génération du Kahoot</h1>
    <div class="spinner-container">
        <!-- <svg class="ip" viewBox="0 0 256 128" width="256px" height="128px" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#5ebd3e" />
                    <stop offset="33%" stop-color="#ffb900" />
                    <stop offset="67%" stop-color="#f78200" />
                    <stop offset="100%" stop-color="#e23838" />
                </linearGradient>
                <linearGradient id="grad2" x1="1" y1="0" x2="0" y2="0">
                    <stop offset="0%" stop-color="#e23838" />
                    <stop offset="33%" stop-color="#973999" />
                    <stop offset="67%" stop-color="#009cdf" />
                    <stop offset="100%" stop-color="#5ebd3e" />
                </linearGradient>
            </defs>
            <g fill="none" stroke-linecap="round" stroke-width="16">
                <g class="ip__track" stroke="#ddd">
                    <path d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56" />
                    <path d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64" />
                </g>
                <g stroke-dasharray="180 656">
                    <path class="ip__worm1" stroke="url(#grad1)" stroke-dashoffset="0" d="M8,64s0-56,60-56,60,112,120,112,60-56,60-56" />
                    <path class="ip__worm2" stroke="url(#grad2)" stroke-dashoffset="358" d="M248,64s0-56-60-56-60,112-120,112S8,64,8,64" />
                </g>
            </g>
        </svg>
        <div class="pl1">
            <div class="pl1__a"></div>
            <div class="pl1__b"></div>
            <div class="pl1__c"></div>
        </div> -->
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
</div>
<script type="module" src="/js/components/select.js"></script>
<script type="module" src="/js/apiWaiting.js"></script>