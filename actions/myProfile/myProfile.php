<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

if (!isset($_GET['id'])) {
    $id = $session_id;
} else {
    $id = $_GET['id'];
}

$ACC_row =  DB::run("SELECT * FROM account WHERE ACC_id = ?", [$id])->fetch();
$AS_row =   DB::run("SELECT * FROM account_stat WHERE AS_id = ?", [$id])->fetch();
$PR_row =   DB::run("SELECT PR_id, PR_content FROM profiles WHERE PR_acc_id = ?", [$id])->fetch();

$usename =      $ACC_row['ACC_username'];
$created =      $ACC_row['ACC_register'];
$last_active =  $ACC_row['ACC_last_active'];
$exp =          $AS_row['AS_EXP'];
$money =        $AS_row['AS_money'] + $AS_row['AS_bankmoney'];
$profile_text = $PR_row['PR_content'] ?? '';

?>

<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= str_replace('{name}', $usename, $useLang->profile->title); ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7 center-image-flex">
                    <img style="max-width: 300px; max-height: 300px;" src="img/avatars/avatar1632680298-aJUICdM.png" />
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">Brukernavn</p>
                            <address>
                                Rolle<br>
                                Rank<br>
                                Drap<br>
                                Sist aktiv<br>
                                Registrert
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">Skitzo</p>
                            <address>
                                Administrator<br>
                                Mafioso<br>
                                100<br>
                                I dag 15:00<br>
                                I går
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" style="border-top: none;">
            <div class="row align-items-center">
                <div class="hr-text">
                    <span>Profil</span>
                </div>
                <?= $profile_text ?>
            </div>
        </div>
    </div>
</div>