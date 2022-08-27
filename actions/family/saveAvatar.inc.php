<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$myFamilyId = DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = '" . $session_id . "'")->fetchColumn() ?? false;

if (0 < $_FILES['file']['error']) {
    echo 'Ugyldig filtype' . '<|>' . 'warning';
} else {

    $name = $_FILES['file']['name'];
    $target_dir = "././img/avatars/mafiosoAvatar";
    $target_dir_really = "../../img/avatars/mafiosoAvatar";
    $target_file = $target_dir . time() . "-" .  basename($_FILES["file"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {

        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            $target_dir_really . time() . "-" . $name
        );

        DB::run("UPDATE family SET FA_avatar = '" . $target_file . "' WHERE FA_id = $myFamilyId");

        echo 'Profilbilde ble lastet opp!' . '<|>' . 'success';
    } else {
        echo 'Ugyldig filtype' . '<|>' . 'warning';
    }
}
