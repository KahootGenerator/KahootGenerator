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
                    <input type="radio" name="lang" id="lang1" title="France" value="fr">
                    <input type="radio" name="lang" id="lang2" title="Anglais" value="en">
                    <input type="radio" name="lang" id="lang3" title="Espagnol" value="es">
                </summary>
                <ul>
                    <li>
                        <label for="lang1">France</label>
                    </li>
                    <li>
                        <label for="lang2">Anglais</label>
                    </li>
                    <li>
                        <label for="lang3">Espagnol</label>
                    </li>
                </ul>
            </details>
        </div>

    </div>
    <div class="form-field--double">
        <div>
            <label for="lang">Difficulté :</label>

            <details class="select" id="diff">
                <summary>
                    <input type="radio" name="diff" title="Choisir une difficulté" checked>
                    <input type="radio" name="diff" id="diff1" title="Facile" value="fr">
                    <input type="radio" name="diff" id="diff2" title="Moyen" value="en">
                    <input type="radio" name="diff" id="diff3" title="Difficile" value="es">
                </summary>
                <ul>
                    <li>
                        <label for="diff1">Facile</label>
                    </li>
                    <li>
                        <label for="diff2">Moyen</label>
                    </li>
                    <li>
                        <label for="diff3">Difficile</label>
                    </li>
                </ul>
            </details>
        </div>

    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox1" class="checkbox">
            <label for="checkbox1"><img src="/img/utils/check.svg"></label>
            <label for="checkbox1">Inclure des vrais ou faux</label>
        </div>
    </div>
    <div class="form-field--full">
        <div class="form-field--checkbox">
            <input type="checkbox" id="checkbox2" class="checkbox">
            <label for="checkbox2"><img src="/img/utils/check.svg"></label>
            <label for="checkbox2"> Plusieurs réponse correctes pour une question</label>
        </div>
    </div>

    <div>
        <input type="submit" value="Valider" class="button-orange">
    </div>

</form>
<script type="module" src="/js/components/select.js"></script>