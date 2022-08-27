<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/bbcodes.php';

$familyId = $_GET['id'];

$famRow = DB::run("SELECT * FROM family WHERE FA_id = ?", [$familyId])->fetch();
$membersInFamily =  DB::run("SELECT COUNT(*) FROM family_member WHERE FM_family_id = ?", [$familyId])->fetchColumn();
$getBoss =  DB::run("SELECT FM_acc_id FROM family_member WHERE FM_family_id = $familyId AND FM_role = 2")->fetchColumn();

$getBossUsername = DB::run("SELECT ACC_username FROM account WHERE ACC_id = $getBoss")->fetchColumn();

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
                <div class="col-6 center-image-flex">
                    <img style="max-width: 300px; max-height: 300px;" src="<?= $famRow['FA_avatar'] ?>" />
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-5">
                            <p class="h3">Familienavn:</p>
                            <address>
                                Krig:<br>
                                Kriger vunnet:<br>
                                Medlemmer:<br>
                                Boss:<br>
                                Stiftet:<br>
                            </address>
                        </div>
                        <div class="col-7 text-end">
                            <p class="h3"><?= $famRow['FA_name'] ?></p>
                            <address>
                                <?= $famRow['FA_war'] > 0 ? '<span class="text-warning">I krig mot ' . DB::run("SELECT FA_name FROM family WHERE FA_id = ?", [$famRow['FA_war']])->fetchColumn() . '</span>' : '<span class="text-success">Ikke i aktiv krig</span>' ?><br>
                                <?= $famRow['FA_war_won'] ?><br>
                                <?= $membersInFamily . ' / ' . $famRow['FA_member'] ?><br>
                                <span hx-post="actions/myProfile/myProfile.php?id=<?= $getBoss ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $getBossUsername ?></span><br>
                                <?= date_to_text($famRow['FA_created']) ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($famRow['FA_war'] > 0) { ?>
            <div class="row align-items-center">
                <div class="hr-text">
                    <span>I aktiv krig mot <?= DB::run("SELECT FA_name FROM family WHERE FA_id = ?", [$famRow['FA_war']])->fetchColumn() ?></span>
                </div>
            </div>
            <?php
            $familyWarRow =        DB::run("SELECT * FROM family_war WHERE FW_family1 = ? OR FW_family2 = ?", [$familyId, $familyId])->fetch();

            $contestant =           $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family2'] : $familyWarRow['FW_family1'];
            $contestantScore =      $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family2Score'] : $familyWarRow['FW_family1Score'];
            $myScore =              $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family1Score'] : $familyWarRow['FW_family2Score'];

            $contestantFamilyRow = DB::run("SELECT * FROM family WHERE FA_id = ?", [$contestant])->fetch();

            ?>
            <div class="container-tight">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 40%;"><?= $contestantFamilyRow['FA_name'] ?></th>
                                <th style="width: 20%; text-align: center;">Vs.</th>
                                <th style="width: 40%; text-align: right;"><?= $famRow['FA_name'] ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $contestantScore ?> poeng</td>
                                <td style="text-align: center;">-</td>
                                <td style="text-align: right;"><?= $myScore ?> poeng</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        <div class="row align-items-center">
            <div class="hr-text">
                <span>Familieprofil</span>
            </div>
            <div class="card-body" style="padding-top: 0; border-top: none;">
                <?= showBBcodes($famRow['FA_profile']) ?>
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