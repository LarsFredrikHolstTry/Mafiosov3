<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include '../../functions/ranks.php';

if (!isset($_GET['id'])) {
    $id = $session_id;
} else {
    $id = $_GET['id'];
}

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = ?", [$id])->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = ?", [$id])->fetch();
$PR_row =   DB::run("SELECT PR_id, PR_content FROM profiles WHERE PR_acc_id = ?", [$id])->fetch();
$role =     DB::run("SELECT RO_name FROM roles WHERE RO_access = ?", [$ACC_row['ACC_role']])->fetch();

$usename =          $ACC_row['ACC_username'];
$registered =       $ACC_row['ACC_register'];
$last_active =      $ACC_row['ACC_last_active'];
$exp =              $AS_row['AS_EXP'];
$money =            $AS_row['AS_money'] + $AS_row['AS_bankmoney'];
$profile_text =     $PR_row['PR_content'] ?? '';
$role_name =        $role ? $role['RO_name'] : 'Bruker';
$rank =             $AS_row['AS_rank'];
$avatar =           $AS_row['AS_avatar'];

?>

<div class="col-12" id="container">
    <div class="card">
        <div class="card-header center-text-card-top">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= str_replace('{name}', $usename, $useLang->profile->title); ?></h3>
            </h3>
            <div class="ms-auto">
                <?php if ($id != $session_id) { ?>
                    <div class="btn bg-green-lt btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: baseline" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 11h6m-3 -3v6"></path>
                        </svg>
                    </div>
                    <div class="btn bg-green-lt btn-icon" aria-label="Button">
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
                <div class="col-7 center-image-flex">
                    <img style="max-width: 300px; max-height: 300px;" src="<?= $avatar ?>" />
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-4">
                            <p class="h3"><?= $useLang->profile->username ?>:</p>
                            <address>
                                <?= $useLang->profile->role ?>:<br>
                                <?= $useLang->profile->rank ?>:<br>
                                <?= $useLang->profile->kills ?>:<br>
                                <?= $useLang->profile->lastActive ?>:<br>
                                <?= $useLang->profile->registered ?>:
                            </address>
                        </div>
                        <div class="col-8 text-end">
                            <p class="h3"><?= $usename ?></p>
                            <address>
                                <?= $role_name ?><br>
                                <?= $rank_arr[$rank] ?><br>
                                Lorem ipsum<br>
                                <?= date_to_text($last_active) ?><br>
                                <?= date_to_text($registered) ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="hr-text">
                <span><?= $useLang->profile->profileBio ?></span>
            </div>
            <div class="card-body" style="padding-top: 0; border-top: none;">
                <?= $profile_text ?>
            </div>
        </div>
    </div>