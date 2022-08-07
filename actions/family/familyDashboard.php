<?php

include '../../functions/cities.php';

$familyMemberRow =  DB::run("SELECT FM_family_id, FM_role FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetch();
$familyId =         $familyMemberRow['FM_family_id'];
$familyRow =        DB::run("SELECT * FROM family WHERE FA_id = ?", [$familyMemberRow['FM_family_id']])->fetch();
$membersInFamily =  DB::run("SELECT COUNT(*) FROM family_member WHERE FM_family_id = ?", [$familyMemberRow['FM_family_id']])->fetchColumn();

$territoriumArr = [];

$stmt = DB::run("SELECT * FROM territorium WHERE TE_family_id = $familyId");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    array_push($territoriumArr, $row['TE_city']);
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    include 'pages/' . $page . '.php';
} else {

    $leaveString = $familyMemberRow['FM_role'] == 2 ? 'Legg ned familie' : 'Gå ut av familie';

?>
    <div class="row row-cards">
        <div class="col-4">
            <div class="card card-sm fake-link cursor-pointer" hx-get="actions/family/family.php?page=familyBank" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Familiebank
                        </div>
                        <div class="text-muted">
                            <?= number($familyRow['FA_money']) ?> kr
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm fake-link cursor-pointer" hx-get="actions/family/family.php?page=familyBullets" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Familiekuler
                        </div>
                        <div class="text-muted">
                            <?= number($familyRow['FA_bullets']) ?> stk
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm fake-link cursor-pointer" hx-get="actions/family/family.php?page=territorium" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Territorium
                        </div>
                        <div class="text-muted">
                            <?php

                            if (count($territoriumArr) > 0) {
                                for ($i = 0; $i < count($territoriumArr); $i++) {
                                    echo $city[$territoriumArr[$i]];
                                    if (count($territoriumArr) > 1 && $i != count($territoriumArr) - 1) {
                                        echo ' og ';
                                    }
                                }
                            } else {
                                echo 'Ingen';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm fake-link cursor-pointer" hx-get="actions/family/family.php?page=familyWar" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Familiekrig
                        </div>
                        <div class="text-muted">
                            <?= $familyRow['FA_war'] > 0 ?
                                '<span class="text-warning">I krig mot ' . DB::run("SELECT FA_name FROM family WHERE FA_id = ?", [$familyRow['FA_war']])->fetchColumn()
                                . '</span>'
                                :
                                'Ikke i aktiv krig' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm fake-link cursor-pointer" hx-get="actions/family/family.php?page=familyMembers&id=<?= $familyRow['FA_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Medlemmer
                        </div>
                        <div class="text-muted">
                            <?= number($membersInFamily) . ' / ' . number($familyRow['FA_member']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Rediger profil
                        </div>
                        <div class="text-muted">
                            Rediger familieprofilen
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-sm">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Forlat familie
                        </div>
                        <div class="text-muted">
                            <?= $leaveString ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>