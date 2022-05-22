<?php

ob_start();
include 'db.php';

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

    <!-- Local styling -->
    <link rel='stylesheet' href='styling/styling.css' />
</head>

<body class='theme-dark'>

    <div class="page-body">
        <div class="container-xxxl">
            <div class="row row-deck row-cards">

                <?php include 'components/left.menu.php'; ?>

                <div class="card col-6" id="container">
                    <?php include 'actions/hovedkvarter/hovedkvarter.php'; ?>
                </div>

                <?php include 'components/right.menu.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>