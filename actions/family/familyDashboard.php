<?php

$familyMemberRow = DB::run("SELECT FM_family_id, FM_role FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetch();
$familyRow = DB::run("SELECT * FROM family WHERE FA_id = ?", [$familyMemberRow['FM_family_id']])->fetch();

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
            <div class="card card-sm">
                <div class="card-body bg-blue-lt">
                    <div class="row align-items-center">
                        <div class="font-weight-medium" style="color: white;">
                            Familiekuler
                        </div>
                        <div class="text-muted">
                            <?= $familyRow['FA_bullets'] ?> stk
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
                            Territorium
                        </div>
                        <div class="text-muted">
                            Ingen
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
                            Familiekrig
                        </div>
                        <div class="text-muted">
                            Ikke i aktiv krig
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
                            Medlemmer
                        </div>
                        <div class="text-muted">
                            * / *
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