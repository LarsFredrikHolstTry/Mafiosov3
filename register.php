<?php

ob_start();
include_once 'env.php';
require_once 'db/PDODB.php';

if (!session_id()) {
    session_start();
}

$useLang = json_decode(file_get_contents('lang/' . $language . '/register-' . $language . '.json'));

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $terms = $_POST['terms'] ?? 'off';

    $user_exist =   DB::run("SELECT ACC_username FROM account WHERE ACC_username = ?", [$username])->fetchColumn();
    $email_exist =  DB::run("SELECT ACC_mail FROM account WHERE ACC_mail = ?", [$username])->fetchColumn();
    $password_safe = strlen($password) > 7;

    if ($terms == 'off') {
        header("Location: register.php?terms=false");
        echo 'Du må akseptere vilkårene for å opprette bruker på Mafioso.no';
    } elseif ($user_exist) {
        header("Location: register.php?userExist=true");
    } elseif (strlen($username) < 3 || strlen($username) > 15) {
        header("Location: register.php?userUnable=true");
    } elseif ($email_exist) {
        header("Location: register.php?mailExist=true");
    } elseif (!$password_safe) {
        header("Location: register.php?weakPassword=true");
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        DB::prepare("INSERT INTO 
        account 
        (ACC_username, ACC_password, ACC_mail, ACC_register, ACC_last_active) 
        VALUES (?,?,?,?,?)")->execute([$username, $hashed_password, $email, time(), time()]);
        $last_id = DB::lastInsertId();
        DB::prepare("INSERT INTO account_stat (AS_id, AS_city) VALUES (?,?)")->execute([$last_id, mt_rand(0, 5)]);

        $_SESSION['ID'] = $last_id;
        header("Location: index.php");
    }
}

if (isset($_GET['terms'])) {
    echo 'Du må akseptere vilkårene for å opprette bruker på Mafioso.no';
}

if (isset($_GET['userExist'])) {
    echo 'Brukernavnet er allerede i bruk';
}

if (isset($_GET['mailExist'])) {
    echo 'Emailen er allerede i bruk';
}

if (isset($_GET['weakPassword'])) {
    echo 'Passordet er for svakt. Minst 10 tegn';
}

if (isset($_GET['userUnable'])) {
    echo 'Brukernavnet må være lengre enn 3 tegn og mindre enn 15 tegn';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mafioso v3 - <?= $useLang->register->title; ?></title>

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
    <link rel="icon" type="image/x-icon" href="img/logo/favicon.ico">
    <noscript>Javascript is required to run Mafioso.</noscript>
</head>

<body class="border-top-wide border-primary d-flex flex-column theme-dark" cz-shortcut-listen="true">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="img/logo/Logo-hvit.png" height="36" alt=""></a>
            </div>
            <form class="card card-md" method="post">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4"><?= $useLang->register->createNewUser; ?></h2>
                    <div class="mb-3">
                        <label class="form-label"><?= $useLang->register->username; ?></label>
                        <input type="text" name="username" class="form-control" placeholder="<?= $useLang->register->username; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $useLang->register->email; ?></label>
                        <input type="email" name="email" class="form-control" placeholder="<?= $useLang->register->email; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $useLang->register->password; ?></label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" id="password" placeholder="<?= $useLang->register->password; ?>" autocomplete="off">

                            <span class="input-group-text">
                                <div class="cursor-pointer link-secondary" onClick="togglePassword()" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="2"></circle>
                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                    </svg>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" name="terms" class="form-check-input">
                            <span class="form-check-label"><?= $useLang->register->agree; ?> <a href="./terms-of-service.html" tabindex="-1"><?= $useLang->register->termsAndConditions; ?></a>.</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" name="register" class="btn btn-bitbucket w-100"><?= $useLang->register->createNewUser; ?></button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                <?= $useLang->register->alreadyUser; ?> <a href="login.php" tabindex="-1"><?= $useLang->register->login; ?></a>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>