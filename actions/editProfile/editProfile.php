<?php

include '../../global-variables.php';
include '../../components/markdown_top.php';

?>
<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->editProfile; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <?php echo markdown(true); ?>
            </div>
        </div>
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col"><?= $useLang->editProfile->style; ?> <a href="#"><?= $useLang->editProfile->bbCodes; ?></a></div>
                <div class="col-auto">
                    <a href="#" class="btn btn-primary">
                        <?= $useLang->editProfile->save; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>