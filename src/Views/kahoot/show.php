<?php
use App\Helper;

?>

<div class="main-container not-align-container" id="kahoot-id" data-kahoot-id="<?= $kahoot->getId(); ?>">
    <h1><?= $data["title"] ?></h1>
    <div class="kahoot-infos">
        <h2>Titre : <?= $kahoot->getTitle(); ?></h2>
        <h2>Difficulté : <?= $kahoot->getDifficulty(); ?></h2>
    </div>
    <div class="question-container">
        <?php foreach ($kahoot->getQuestions() as $i => $question) { ?>
            <div class="question-block" id="<?= $question->getId(); ?>">
                <article class="question-block-info">
                    <h2 class="question-block-title">Question <?= $i + 1; ?></h2>
                    <div id="<?= $question->getId(); ?>-question">
                        <div class="question-block-actions">
                            <details class="select">
                                <summary id="time-<?= $question->getId(); ?>">
                                    <?php foreach ($times as $time) { ?>
                                        <input type="radio" name="<?= $question->getId(); ?>-time"
                                            data-id-time="<?= $time->getId() ?>"
                                            id="<?= $question->getId(); ?>-time-<?= $time->getId() ?>"
                                            title="<?= Helper::escape($time->getSeconds()) ?>s" <?php if (Helper::escape($time->getSeconds()) == 30) {
                                                  echo "checked";
                                              } ?>>
                                    <?php } ?>
                                </summary>
                                <ul>
                                    <?php foreach ($times as $time) { ?>
                                        <li>
                                            <label
                                                for="<?= $question->getId(); ?>-time-<?= Helper::escape($time->getId()) ?>"><?= Helper::escape($time->getSeconds()) ?>s</label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </details>
                            <a href="/kahoot/<?= $kahoot->getId(); ?>/deleteQuestion/<?= Helper::escape($question->getId()); ?>"
                                class="button-red" title="Supprimer"><img src="/img/utils/trash.svg" alt="Supprimer"></a>
                        </div>
                    </div>
                </article>
                <div class="question">
                    <p class="question-title" id="title-<?= $question->getId(); ?>" contenteditable="plaintext-only"><?= Helper::escape($question->getQuestion()); ?></p>
                    <div class="responses-wrapper">
                        <?php foreach ($question->getAnswers() as $answer) { ?>
                            <div class="response">
                                <div class="response--checkbox">
                                    <input type="checkbox"
                                        class="checkbox-<?= $answer->getId(); ?> checkbox-<?= $question->getId(); ?>"
                                        name=" <?= $answer->getId(); ?>-answer" id="answer<?= $answer->getId(); ?>"
                                        <?= $answer->getCorrect() ? "checked" : ""; ?>>
                                    <label for="answer<?= $answer->getId(); ?>">
                                        <img src="/img/utils/check.svg" alt="Checked">
                                    </label>
                                </div>
                                <p class="response--text text-<?= $question->getId(); ?>" contenteditable="plaintext-only"
                                    id="<?= $answer->getId(); ?>-answer"><?= Helper::escape($answer->getLibelle());
                                      ?></p>
                                <button class="response--cross">
                                    <img src="/img/utils/cross.svg" alt="Cross">
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="download-block">
        <a class="button-orange" href="/kahoot/<?= $kahoot->getId() ?>/download">Telecharger votre
            Kahoot !</a>
        <button class="button-purple" id="save">Sauvegarder vos modifications !</button>
    </div>
</div>
<script type="module" src="/js/saveKahoot.js"></script>
<script type="module" src="/js/components/select.js"></script>