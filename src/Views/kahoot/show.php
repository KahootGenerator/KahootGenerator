<?php
use App\Helper;

?>

<div class="main-container">
    <h1><?= $data["title"] ?></h1>

    <div class="question-container">

        <div class="question-block">
            <article class="question-block-info">

                <h2 class="question-block-title">Question 1</h2>
                <div id="question1">
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
            </article>
            <div class="question">
                <p class="question-title" contenteditable="true">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit.
                    Minus suscipit inventore
                    aut corporis veritatis fuga voluptate esse iste quae accusantium quisquam, vero ut, tempore numquam
                    officiis incidunt. Vero, illo aperiam?</p>
                <div class="responses-wrapper">
                    <div class="response">
                        <div class="response--checkbox">
                            <input type="checkbox" name="answer,1,1" id="answer,1,1">
                            <label for="answer,1,1">
                                <img src="/img/utils/check.svg" alt="Checked">
                            </label>
                        </div>
                        <p type="text" class="response--text" contenteditable="true">QSDfdsfsdfsdfsdhdfh</p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </div>
                    <div class="response">
                        <div class="response--checkbox">
                            <input type="checkbox" name="answer,1,2" id="answer,1,2">
                            <label for="answer,1,2">
                                <img src="/img/utils/check.svg" alt="Checked">
                            </label>
                        </div>
                        <p type="text" class="response--text" contenteditable="true">QSDfdsfsdfsdfsdhdfh</p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </div>
                    <div class="response">
                        <div class="response--checkbox">
                            <input type="checkbox" name="answer,1,3" id="answer,1,3">
                            <label for="answer,1,3">
                                <img src="/img/utils/check.svg" alt="Checked">
                            </label>
                        </div>
                        <p class="response--text" contenteditable="true">QSDfdsfsdfsdfsdhdfh</p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </div>
                    <div class="response">
                        <div class="response--checkbox">
                            <input type="checkbox" name="answer,1,4" id="answer,1,4">
                            <label for="answer,1,4">
                                <img src="/img/utils/check.svg" alt="Checked">
                            </label>
                        </div>
                        <p class="response--text" contenteditable="true">QSDfdsfsdfsdfsdhdfh</p>
                        <button class="response--cross">
                            <img src="/img/utils/cross.svg" alt="Cross">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>