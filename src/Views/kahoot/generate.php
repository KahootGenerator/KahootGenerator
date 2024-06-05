<h1><?= $data["title"] ?></h1>

<form action="/kahoot/generate/attempt" method="POST">

    <div>
        <label for="theme">Thème :</label>
        <input type="text" id="theme" name="theme">
    </div>
    <div>
        <label for="quantity">Nombre de question :</label>
        <input type="number" id="quantity" name="quantity">


        <label for="lang">Langue du questionnaire</label>
        <select name="lang" id="lang">
            <option value="fr">Français</option>
            <option value="en">Anglais</option>
        </select>
    </div>
    <div>
        <label for="difficulty">Difficulté du questionnaire</label>
        <select name="difficulty" id="difficulty">
            <option value="easy">Facile</option>
            <option value="medium">Moyen</option>
        </select>
    </div>
    <div>
        <input type="checkbox" id="checkbox1">
        <label for="checkbox1">Inclure des vrais ou faux</label>
    </div>
    <div>
        <input type="checkbox" id="checkbox2">
        <label for="checkbox2">Plusieurs réponse correctes pour une question</label>
    </div>

    <div>
        <input type="submit" value="Valider">
    </div>

</form>