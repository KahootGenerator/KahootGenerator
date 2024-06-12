<?php
use App\Helper;

?>

<div class="main-container not-align-container">
    <h1><?= $data["title"] ?></h1>
    <div class="question-container">
        <?php foreach ($kahoot->getQuestions() as $i => $question) { ?>
            <div class="question-block">
                <article class="question-block-info">

                    <h2 class="question-block-title">Question <?= $i + 1; ?></h2>
                    <div id="<?= $question->getId(); ?>-question">
                        <div class="question-block-actions">
                            <details class="select">
                                <summary>
                                    <?php foreach ($times as $time) { ?>
                                        <input type="radio" name="<?= $question->getId();?>-time"
                                            id="<?= $question->getId();?>-time-<?= $time->getId() ?>"
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
                            <a href="/kahoot/<?= Helper::escape($question->getId()); ?>/delete/" class="button-red"
                                title="Supprimer"><img src="/img/utils/trash.svg" alt="Supprimer"></a>
                        </div>
                    </div>
                </article>
                <div class="question">
                    <p class="question-title" id="<?= $question->getId(); ?>-title" contenteditable="plaintext-only"><?= Helper::escape($question->getQuestion()); ?></p>
                    <div class="responses-wrapper">
                        <?php foreach ($question->getAnswers() as $answer) { ?>
                            <div class="response">
                                <div class="response--checkbox">
                                    <input type="checkbox" name="<?= $answer->getId(); ?>-answer"
                                        id="answer<?= $answer->getId(); ?>" <?= $answer->getCorrect() ? "checked" : ""; ?>>
                                    <label for="answer<?= $answer->getId(); ?>">
                                        <img src="/img/utils/check.svg" alt="Checked">
                                    </label>
                                </div>
                                <p class="response--text" contenteditable="plaintext-only" id="<?= $answer->getId(); ?>-answer"><?= Helper::escape($answer->getLibelle()); ?></p>
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
    <div>
        <a class="button-orange button-download" href="/kahoot/<?= $kahoot->getId() ?>/download">Telecharger votre
            Kahoot !</a>
    </div>
</div>
<script type="module" src="/js/components/select.js"></script>