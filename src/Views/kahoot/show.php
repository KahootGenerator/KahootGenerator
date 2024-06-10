<?php
use App\Helper;

?>

<div class="main-container">
    <h1><?= $data["title"] ?></h1>
    <div class="question-block">
        <div class="question-block-info">

            <p class="question-block-title">Question 1</p>
            <div class="question-block" id="question1">
                <div class="question-block-actions">
                    <details class="select">
                        <summary>
                            <?php foreach ($times as $time) { ?>
                                <input type="radio" name="time-question"
                                    id="time-question_<?= Helper::escape($time->getId()) ?>"
                                    title="<?= Helper::escape($time->getSeconds()) ?>s" <?php if (Helper::escape($time->getSeconds()) == 30) {
                                          echo "checked";
                                      } ?>>
                            <?php } ?>
                        </summary>
                        <ul>
                            <?php foreach ($times as $time) { ?>
                                <li>
                                    <label
                                        for="time-question_<?= Helper::escape($time->getId()) ?>"><?= Helper::escape($time->getSeconds()) ?>s</label>
                                </li>
                            <?php } ?>
                        </ul>
                    </details>
                    <button class="button-red"><img src="/img/utils/trash.svg"></button>
                </div>
            </div>
        </div>
        <div class="question">
            <p class="question-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus suscipit inventore
                aut corporis veritatis fuga voluptate esse iste quae accusantium quisquam, vero ut, tempore numquam
                officiis incidunt. Vero, illo aperiam?</p>
            <div class="responses-wrapper">
                <div class="response-container">
                    <input type="checkbox" name="" id="answer,1,1">
                    <label class="response" for="answer,1,1">
                        <div class="response--checkbox">
                            <img src="/img/utils/check.svg" alt="Checked">
                        </div>
                        <p class="response--p">
                            MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
                        </p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </label>
                </div>
                <div class="response-container">
                    <input type="checkbox" name="" id="answer,1,2">
                    <label class="response" for="answer,1,2">
                        <div class="response--checkbox">
                            <img src="/img/utils/check.svg" alt="Checked">
                        </div>
                        <p class="response--p">
                            MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
                        </p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </label>
                </div>
                <div class="response-container">
                    <input type="checkbox" name="" id="answer,1,3">
                    <label class="response" for="answer,1,3">
                        <div class="response--checkbox">
                            <img src="/img/utils/check.svg" alt="Checked">
                        </div>
                        <p class="response--p">
                            MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
                        </p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </label>
                </div>
                <div class="response-container">
                    <input type="checkbox" name="" id="answer,1,4">
                    <label class="response" for="answer,1,4">
                        <div class="response--checkbox">
                            <img src="/img/utils/check.svg" alt="Checked">
                        </div>
                        <p class="response--p">
                            MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
                        </p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>