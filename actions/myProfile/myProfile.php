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

$usename =      $ACC_row['ACC_usernme'];
$created =      $ACC_row['ACC_register'];
$last_active =  $ACC_row['ACC_last_active'];
$exp =          $AS_row['AS_EXP'];
$money =        $AS_row['AS_money'] + $AS_row['AS_bankmoney'];

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
                <!-- <img class="center-image" style="width: auto;" src="actions/#/img/#" /> -->
            </div>
        </div>
    </div>
</div>