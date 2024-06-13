<?php
use App\Helper;

?>

<div class="main-container-lightblue not-align-container">
    <h1><?= $title; ?></h1>
    <?= empty($kahoots) ? '<h1>Vous n\'avez généré aucun Kahoot !</h1>' : ''; ?>
    <div class="kahoot-card-container">
        <?php foreach ($kahoots as $kahoot) { ?>
            <div class="kahoot-card">
                <div class="kahoot-card-line">
                    <h2 class="kahoot-card-title"><?= Helper::escape($kahoot->getTitle()); ?></h2>
                    <a href="/kahoot/<?= Helper::escape($kahoot->getId()); ?>/delete/" class="button-red"
                        title="Supprimer"><img src="/img/utils/trash.svg" alt="Supprimer"></a>
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