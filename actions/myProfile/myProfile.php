<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';
include '../../functions/roles.php';
include '../../functions/money_ranks.php';
include '../../functions/bbcodes.php';
include '../../actions/family/familyvariables.inc.php';

if (!isset($_GET['id'])) {
    $id = $session_id;
} else {
    $id = $_GET['id'];
}

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = ?", [$id])->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = ?", [$id])->fetch();
$PR_row =   DB::run("SELECT PR_id, PR_content FROM profiles WHERE PR_acc_id = ?", [$id])->fetch();
$family_id =   DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$id])->fetchColumn();

$usename =          $ACC_row['ACC_username'];
$registered =       $ACC_row['ACC_register'];
$last_active =      $ACC_row['ACC_last_active'];
$exp =              $AS_row['AS_EXP'];
$money =            $AS_row['AS_money'] + $AS_row['AS_bankmoney'];
$profile_text =     $PR_row['PR_content'] ?? '';
$role_name =        $role[$ACC_row['ACC_role']];
$rank =             $AS_row['AS_rank'];
$avatar =           $AS_row['AS_avatar'];
$family =           $family_id ?
    $familyRoles[DB::run("SELECT FM_role FROM family_member WHERE FM_acc_id = ?", [$id])->fetchColumn()] . ' i ' .
    '<span hx-get="actions/familyprofile/familyprofile.php?id=' . $family_id . '" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer" id="htmxForm">' .
    DB::run("SELECT FA_name FROM family WHERE FA_id = ?", [$family_id])->fetchColumn()
    . '</span>'
    :
    'Ingen';

?>

<div class="col-12" id="container">
    <div class="card">
        <div class="card-header center-text-card-top">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">
                    <?= str_replace('{name}', $usename, $useLang->profile->title); ?>
                    <?php if ($ACC_row['ACC_status'] == 1) { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                    <?php } ?>
                </h3>
            </h3>
            <div class="ms-auto">
                <?php if ($id != $session_id) { ?>
                    <!-- <div class="btn bg-green btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: baseline" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 11h6m-3 -3v6"></path>
                        </svg>
                    </div> -->
                    <div class="btn bg-green btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path>
                            <path d="M3 6l9 6l9 -6"></path>
                            <path d="M15 18h6"></path>
                            <path d="M18 15l3 3l-3 3"></path>
                        </svg>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6 center-image-flex">
                    <img style="max-width: 300px; max-height: 300px;" src="<?= $avatar ?>" />
                </div>
                <div class="col-6">
                    <div class="d-flex">
                        <span class="h3"><?= $useLang->profile->username ?>:</span>
                        <span class="ms-auto h3"><?= $usename ?>
                            <?php if ($ACC_row['ACC_status'] == 1) { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                                    <path d="M9 12l2 2l4 -4"></path>
                                </svg>
                            <?php } ?>
                        </span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->role ?>:</span>
                        <span class="ms-auto"><?= $role_name ?></span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->rank ?>:</span>
                        <span class="ms-auto"><?= $rank_arr[$rank] ?></span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->moneyRank ?>:</span>
                        <span class="ms-auto"><?= money_rank($money, $money_amount_from, $money_amount_to, $money_rank) ?></span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->kills ?>:</span>
                        <span class="ms-auto">0 drap</span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->lastActive ?>:</span>
                        <span class="ms-auto"><?= date_to_text($last_active) ?></span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->registered ?>:</span>
                        <span class="ms-auto"><?= date_to_text($registered) ?></span>
                    </div>
                    <div class="d-flex">
                        <span><?= $useLang->profile->family ?>:</span>
                        <span class="ms-auto"><?= $family ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="hr-text">
                <span><?= $useLang->profile->profileBio ?></span>
            </div>
            <div class="card-body" style="padding-top: 0; border-top: none;">
                <?= showBBcodes($profile_text) ?>
            </div>
        </div>
    </div>