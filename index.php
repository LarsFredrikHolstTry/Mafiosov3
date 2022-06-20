<?php

ob_start();
include 'db.php';
include 'env.php';

if (isset($_SESSION['ID'])) {
    $session_id = $_SESSION['ID'];
} else {
    header("Location: login.php");
}

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
    <script src="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/js/tabler.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/css/tabler-flags.min.css">

    <!-- Local styling -->
    <link rel='stylesheet' href='styling/styling.css' />
    <script src="js/table.js"></script>
    <script src="js/number.js"></script>
    <script src="js/feedback.js"></script>
    <link rel="icon" type="image/x-icon" href="img/logo/favicon.ico">

    <!-- Dropzone -->
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <noscript>Javascript is required to run Mafioso.</noscript>

</head>

<body class='theme-dark'>

    <div class="page">
        <div id="navbar">
            <div hx-target="#navbar" hx-swap="outerHTML" hx-get="components/menus/navbar.php" hx-trigger="load, every 2s"></div>
        </div>

        <div class="page-body">
            <div class="container-xxxl">

                <div class="row row-deck row-cards">

                    <div class="card col-3" id="left_menu">
                        <div hx-target="#left_menu" hx-swap="outerHTML" hx-get="components/menus/left.menu.php" hx-trigger="load"></div>
                    </div>

                    <div class="col-6">
                        <div class="row row-cards">
                            <div id="top_menu">
                                <div hx-target="#top_menu" hx-swap="outerHTML" hx-get="components/menus/top_action_menu.php" hx-trigger="load"></div>
                            </div>
                            <div id="container">
                                <div hx-target="#container" hx-swap="outerHTML" hx-get="actions/headquarters/headquarters.php" hx-trigger="load"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card col-3" id="right_menu">
                        <div hx-target="#right_menu" hx-swap="outerHTML" hx-get="components/menus/right.menu.php" hx-trigger="load"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>