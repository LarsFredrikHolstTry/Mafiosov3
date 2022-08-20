<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

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

        DB::run("UPDATE account_stat SET AS_avatar = '" . $target_file . "' WHERE AS_id = $session_id");

        echo 'Profilbilde ble lastet opp!' . '<|>' . 'success';
    } else {
        echo 'Ugyldig filtype' . '<|>' . 'warning';
    }
}
