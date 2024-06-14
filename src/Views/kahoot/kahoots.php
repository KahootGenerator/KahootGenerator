<?php
use App\Helper;

?>

<?php if (empty($kahoots)) { ?>
    <div class="main-container align-container">
        <h1><?= $title; ?></h1>
        <p>Vous n'avez généré aucun Kahoot !</p>
        <a href="/kahoot/generate/" class="button-orange button-l">Générez votre premier Kahoot</a>
    </div>
<?php } else { ?>
    <div class="main-container-lightblue not-align-container">
        <h1><?= $title; ?></h1>
        <div class="kahoot-card-container">
            <?php foreach ($kahoots as $kahoot) { ?>
                <div class="kahoot-card" data-idkahoot="<?= Helper::escape($kahoot->getId()); ?>">
                    <div class="kahoot-card-line">
                        <h2 class="kahoot-card-title"><?= Helper::escape($kahoot->getTitle()); ?></h2>
                        <button data-idkahoot="<?= Helper::escape($kahoot->getId()); ?>" class="button-red buttonsDelete"
                            title="Supprimer"><img src="/img/utils/trash.svg" alt="Supprimer"></button>
                    </div>
                    <div class="kahoot-card-line-left">
                        <p class="kahoot-card-theme">Thème</p>
                        <p><?= $kahoot->getTheme(); ?></p>
                    </div>
                    <div class="kahoot-card-line">
                        <p><?= $kahoot->getDate(); ?></p>
                        <a href="/kahoot/<?= $kahoot->getId(); ?>" class="button-lightblue button-xl">Modifier</a>
                        <a href="/kahoot/<?= $kahoot->getId(); ?>/download" class="button-purple button-xl">Télécharger</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<script type="module" src="/js/ajax/deleteKahoot.js"></script>