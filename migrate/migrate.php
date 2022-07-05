<?php

include '../env.php';

$button_disabled = false;

// TODO: Make this actually work ^^
// $whitelist = array('127.0.0.1', "::1", "5.83.227.250");

// if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
//     $button_disabled = true;
// }

function migrate_success_feedback(string $text, string $sql)
{
    echo '                              
    <div>
    <div class="row">
    <div class="col-auto">
        <span class="bg-green text-white avatar">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
      </span>
        </div>
        <div class="col">
            <div class="text-truncate">
                ' . $text . '
            </div>
            <kbd class="text-muted">' . $sql . '</kbd>
        </div>
    </div>
</div>';
}

function migrate_failed_feedback(string $text, string $sql)
{
    echo '                              
    <div>
    <div class="row">
    <div class="col-auto">
        <span class="bg-red text-white avatar">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-alert" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
            <line x1="12" y1="11" x2="12" y2="14"></line>
        </svg>
      </span>
        </div>
        <div class="col">
            <div class="text-truncate">
                ' . $text . '
            </div>
            <kbd class="text-muted">' . $sql . '</kbd>
        </div>
    </div>
</div>';
}

$table[0] = 'account';
$columns[0] = '
`ACC_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`ACC_username` varchar(25) NOT NULL,
`ACC_password` varchar(255) NOT NULL,
`ACC_mail` varchar(255) NOT NULL,
`ACC_verified` int(1) NOT NULL,
`ACC_register` int(10) NOT NULL,
`ACC_last_active` int(10) NOT NULL,
`ACC_role` int(2) NOT NULL,
`ACC_status` int(2) NOT NULL';

$table[1] = 'account_stat';
$columns[1] = '
`AS_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`AS_money` bigint(20) NOT NULL,
`AS_bankmoney` bigint(20) NOT NULL,
`AS_EXP` int(10) NOT NULL,
`AS_rank` int(2) NOT NULL,
`AS_points` int(10) NOT NULL,
`AS_city` int(1) NOT NULL,
`AS_avatar` varchar(255) NOT NULL default "img/avatars/standard_avatar.png"';

$table[2] = 'garage';
$columns[2] = '
`GA_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`GA_acc_id` int(15) NOT NULL,
`GA_city` int(2) NOT NULL,
`GA_car` int(2) NOT NULL';

$table[3] = 'profiles';
$columns[3] = '
`PR_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`PR_acc_id` int(15) NOT NULL,
`PR_content` text NOT NULL';

$table[4] = 'roles';
$columns[4] = '
`RO_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`RO_alias` varchar(50) NOT NULL,
`RO_name` varchar(50) NOT NULL,
`RO_access` int(2) NOT NULL DEFAULT 0';

$table[5] = 'business';
$columns[5] = '
`BU_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`BU_acc_id` int(2) NOT NULL,
`BU_type` int(2) NOT NULL,
`BU_city` int(2) NOT NULL';

$table[6] = 'notification';
$columns[6] = '
`NO_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`NO_acc_id` int(2) NOT NULL,
`NO_text` text NOT NULL,
`NO_unread` boolean default true,
`NO_date` int(15) NOT NULL';

$table[7] = 'jail';
$columns[7] = '
`JA_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`JA_acc_id` int(2) NOT NULL,
`JA_reason` text NOT NULL,
`JA_date` int(15) NOT NULL';

$table[8] = 'friends';
$columns[8] = '
`FRI_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`FRI_acc_id` int(2) NOT NULL,
`FRI_friend` int(2) NOT NULL';

$table[9] = 'friendRequests';
$columns[9] = '
`FR_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`FR_acc_id` int(2) NOT NULL,
`FR_from` int(2) NOT NULL,
`FR_date` int(15) NOT NULL';

$table[10] = 'cooldown';
$columns[10] = '
`CD_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`CD_acc_id` int(2) NOT NULL,
`CD_fc_training` int(15) NOT NULL,
`CD_fc_fight` int(15) NOT NULL,
`CD_crime` int(15) NOT NULL,
`CD_carTheft` int(15) NOT NULL,
`CD_theft` int(15) NOT NULL,
`CD_steal` int(15) NOT NULL,
`CD_travel` int(15) NOT NULL';

$table[11] = 'storage';
$columns[11] = '
`ST_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`ST_acc_id` int(2) NOT NULL,
`ST_type` int(15) NOT NULL';

$table[12] = 'user_settings';
$columns[12] = '
`US_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`US_acc_id` int(2) NOT NULL,
`US_max_cars` int(15) NOT NULL,
`US_max_things` int(15) NOT NULL,
`US_toprank_amt` int(2) NOT NULL';

$table[13] = 'bank_transfer';
$columns[13] = '
`BT_id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`BT_from` int(2) NOT NULL,
`BT_to` int(2) NOT NULL,
`BT_money` bigint(20) NOT NULL,
`BT_message` TEXT NOT NULL,
`BT_date` int(15) NOT NULL';

$dummy_data[0] = "INSERT INTO roles 
(RO_alias, RO_name, RO_access) 
VALUES 
('beta', 'Beta Tester', 1),
('forum_moderator', 'Forum Moderator', 2),
('moderator', 'Moderator', 3),
('admin', 'Administrator', 4),
('ass_admin', 'Assisterende Administrator', 5),
('dev', 'Utvikler', 6)";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mafioso v3</title>

    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@1.3.3"></script>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Flat Icon interface icons -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>

    <!-- Tabler css and JS -->
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/css/tabler-flags.min.css">

    <!-- Local styling -->
    <link rel='stylesheet' href='styling/styling.css' />
    <script src="js/number.js"></script>
    <script src="js/feedback.js"></script>
    <link rel="icon" type="image/x-icon" href="img/logo/favicon.ico">

    <noscript>Javascript is required to run Mafioso.</noscript>
</head>

<body class='theme-dark'>
    <div class="page">
        <div class="page-wrapper">
            <div class="container" style="max-width: 900px;">
                <div class="page-header d-print-none mb-3">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Mafioso - <a href="../index.php">Back to homepage</a>

                            </div>
                            <h2 class="page-title">
                                Migrate
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <button type="button" class="btn 
                                <?php if ($button_disabled) {
                                    echo 'disabled';
                                } ?> " data-bs-toggle="modal" data-bs-target="#modal-danger">
                                    Migrate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card" style="max-height: 80vh">
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            <div class="divide-y">
                                <?php

                                if (isset($_POST['migrate'])) {
                                    if ($button_disabled) {
                                        echo 'Not able to migrate in production';
                                    } else {

                                        /* Attempt MySQL server connection. Assuming you are running MySQL
                                        server with default setting (user 'root' with no password) */
                                        $con = mysqli_connect($db_host, $db_user, $db_password);

                                        // Check connection
                                        if ($con === false) {
                                            die("ERROR: Could not connect. " . mysqli_connect_error());
                                        }

                                        $sql = "DROP DATABASE IF EXISTS $db_name";
                                        if (mysqli_query($con, $sql)) {
                                            migrate_success_feedback("Deleted $db_name", $sql);
                                        } else {
                                            migrate_failed_feedback("Could not execute $sql. " . mysqli_error($con), "closing connection");
                                            mysqli_close($con);
                                        }

                                        // Attempt create database query execution
                                        $sql = "CREATE DATABASE $db_name";
                                        if (mysqli_query($con, $sql)) {
                                            migrate_success_feedback("Database $db_name created", $sql);
                                        } else {
                                            migrate_failed_feedback("Could not execute $sql. " . mysqli_error($con), "closing connection");
                                            mysqli_close($con);
                                        }

                                        // Close connection
                                        mysqli_close($con);

                                        $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);

                                        // Check connection
                                        if ($con === false) {
                                            die("ERROR: Could not connect. " . mysqli_connect_error() . "<br>");
                                        }

                                        // Create tables
                                        for ($i = 0; $i < count($table); $i++) {
                                            $sql = "CREATE TABLE `$table[$i]`(
                                            $columns[$i]
                                            )";
                                            if (mysqli_query($con, $sql)) {
                                                migrate_success_feedback("$table[$i] table created", $sql);
                                            } else {
                                                migrate_failed_feedback("Could not execute $sql. " . mysqli_error($con), "closing connection");
                                                mysqli_close($con);
                                            }
                                        }

                                        // Insert dummy data
                                        for ($j = 0; $j < count($dummy_data); $j++) {
                                            $sql = $dummy_data[$j];
                                            if (mysqli_query($con, $sql)) {
                                                migrate_success_feedback("Dummy data inserted", $sql);
                                            } else {
                                                migrate_failed_feedback("Could not execute $sql. " . mysqli_error($con), "closing connection");
                                                mysqli_close($con);
                                            }
                                        }

                                        migrate_success_feedback("Migration done without any errors", "You can now enter homepage");

                                        // Close connection
                                        mysqli_close($con);
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v2m0 4v.01"></path>
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">
                        This will delete database '<?= $db_name ?>' and all its data.
                        <br>
                        Be sure to take a copy of the data in '<?= $db_name ?>' before migrate
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a></div>
                            <div class="col">
                                <form method="post">
                                    <button type="submit" name="migrate" class="btn btn-danger w-100 
                                    <?php if ($button_disabled) {
                                        echo 'disabled';
                                    } ?> ">
                                        Migrate
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>