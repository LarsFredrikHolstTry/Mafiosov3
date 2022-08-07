<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'familyvariables.inc.php';

$familyId =         DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = " . $session_id)->fetchColumn();
$anyFamilies =      DB::run("SELECT count(*) FROM family WHERE FA_war = 0 AND NOT FA_id = " . $familyId)->fetchColumn();
$familyRow =        DB::run("SELECT FA_name, FA_war FROM family WHERE FA_id = " . $familyId)->fetch();

if ($familyRow['FA_war'] != 0) {
    $familyWarRow =        DB::run("SELECT * FROM family_war WHERE FW_family1 = $familyId OR FW_family2 = $familyId")->fetch();

    $contestant =           $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family2'] : $familyWarRow['FW_family1'];
    $contestantScore =      $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family2Score'] : $familyWarRow['FW_family1Score'];
    $myScore =              $familyWarRow['FW_family1'] == $familyId ? $familyWarRow['FW_family1Score'] : $familyWarRow['FW_family2Score'];

    $contestantFamilyRow = DB::run("SELECT * FROM family WHERE FA_id = $contestant")->fetch();

    $warId = $familyWarRow['FW_warId'];

?>
    <h3 style="text-align: center;">I aktiv krig mot <?= $contestantFamilyRow['FA_name'] ?></h3>
    <h6 style="text-align: center;" class="text-muted">Krig Id: <?= $warId ?></h6>

    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th style="width: 40%;"><?= $contestantFamilyRow['FA_name'] ?></th>
                    <th style="width: 20%; text-align: center;">Vs.</th>
                    <th style="width: 40%; text-align: right;"><?= $familyRow['FA_name'] ?></th>
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

    <h3 class="mt-4" style="text-align: center;">Siste handlinger</h3>

    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>Familie</th>
                    <th>Handling</th>
                    <th>Dato</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = DB::run("SELECT * FROM family_war_activity WHERE FWA_warId = '" . $warId . "'");
                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                    $username =     DB::run("SELECT ACC_username FROM account WHERE ACC_id = " . $row['FWA_account_id'])->fetchColumn();
                    $familyName =   DB::run("SELECT FA_name FROM family WHERE FA_id = " . $row['FWA_family'])->fetchColumn();

                ?>
                    <tr>
                        <td><?= $familyName ?></td>
                        <td><?= $username . ' ' . $row['FWA_action'] ?></td>
                        <td><?= date_to_text($row['FWA_date']) ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php


} elseif ($anyFamilies > 0) { ?>
    <label class="form-label">Velg familie</label>
    <select id="family" class="form-select">
        <?php

        $stmt = DB::run("SELECT FA_id, FA_name from family WHERE FA_war = ? AND NOT FA_id = ?", [0, $familyId]);
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

        ?>
            <option value=<?= $row['FA_id'] ?>><?= $row['FA_name'] ?></option>
        <?php } ?>
    </select>
    <div class="d-flex mt-2">
        <div class="ml-025 btn btn-warning btn-square btn-md buy_bullets" id="attack">
            Angrip familie
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <h4 class="alert-title">Ingen familier&hellip;</h4>
        <div class="text-muted">Det finnes ingen familier som kan kriges mot. Enten er alle familiene i krig allerede, eller så finnes det ingen andre familier.</div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        $('#attack').click(function() {
            var family = $("#family").find(':selected').val();

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/declare_war.inc.php',
                method: 'post',
                data: {
                    family: family,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#familyWarUpdate", "familyWarUpdate");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>