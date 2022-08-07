<?php


include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/cities.php';
include 'familyvariables.inc.php';

$familyId = DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();

$territoriumOwned = [];
$bulletRequirement = 1000;

$stmt = DB::run("SELECT * FROM territorium WHERE TE_family_id = $familyId");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    array_push($territoriumOwned, $row['TE_city']);
}

?>

<?php if (count($territoriumOwned) > 0) { ?>
    <h3 class="card-title text-capitalize mt-4">Oversikt over territorium</h3>
    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>By</th>
                    <th>Penger i territoriumet</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = DB::run("SELECT TE_city, TE_money from territorium WHERE TE_family_id = ?", [$familyId]);
                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

                ?>
                    <tr>
                        <td><span class="flag flag-country-<?= $flag[$row['TE_city']] ?> me-1"></span> <?= $city[$row['TE_city']] ?></td>
                        <td class="text-muted"><?= number($row['TE_money']) ?> kr</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>