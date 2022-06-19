<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$ACC_row = DB::run("SELECT ACC_role, ACC_username FROM account WHERE ACC_id = ?", [$session_id])->fetch();

?>
<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <img style="height: 32px; width: auto;" src="img/logo/Logo-hvit.png" />
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <?php include '../friends/friends.php'; ?>
                <?php include '../notification/notifications.php'; ?>

            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(img/avatars/avatar1632680298-aJUICdM.png)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= $ACC_row['ACC_username'] ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <?php

                    foreach ($userMenu as $key => $value) {

                    ?>
                        <a hx-post="actions/<?= $key ?>/<?= $key ?>.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="dropdown-item" href="#"><?= $value ?></a>
                    <?php

                    }

                    ?>

                    <?php
                    if ($ACC_row['ACC_role'] > 1) {
                    ?>
                        <a hx-post="actions/admin/admin.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="dropdown-item" href="#">Admin</a>
                    <?php
                    }
                    ?>

                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">
                        <span class="text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout mr-05" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                            </svg>
                            <?= $userMenuOther->logout; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>