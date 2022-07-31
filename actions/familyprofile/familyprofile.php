<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$familyId = $_GET['id'];

$famRow = DB::run("SELECT * FROM family WHERE FA_id = ?", [$familyId])->fetch();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Familieprofil: <?= $famRow['FA_name'] ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7 center-image-flex">
                    <img style="max-width: 300px; max-height: 300px;" src="<?= $famRow['FA_avatar'] ?>" />
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-4">
                            <p class="h3">Familienavn:</p>
                            <address>
                                I Krig:<br>
                                Medlemmer:<br>
                            </address>
                        </div>
                        <div class="col-8 text-end">
                            <p class="h3"><?= $famRow['FA_name'] ?></p>
                            <address>
                                <?= $famRow['FA_war'] > 0 ? '<span class="text-warning">I krig med ' . $famRow['FA_war'] . '</span>' : '<span class="text-success">Ikke i aktiv krig</span>' ?><br>
                                {members}/{max_members}<br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var value = value;
            $("#feedback-container").load("components/feedback.php");
        })
    })
</script>