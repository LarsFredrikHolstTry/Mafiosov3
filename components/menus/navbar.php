<?php

include '../../global-variables.php';

?>
<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <img style="height: 32px; width: auto;" src="img/logo/Logo-hvit.png" />
        </h1>
        <div class=" navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/bell</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card" style="min-width: 350px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title lh-sm">Varsler
                                </h3>

                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <div href="#" class="text-body d-block">Du har blitt ranet!</div>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Skitzo ranet deg for 2 259 kr!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <div href="#" class="text-body d-block">Du har blitt ranet!</div>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Skitzo ranet deg for 2 259 kr!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            <a href="#" class="d-block text-muted text-truncate mt-n1">
                                                Åpne i ny side
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(img/avatars/avatar1632680298-aJUICdM.png)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Skitzo</div>
                        <div class="mt-1 small text-muted">Consigliere</div>
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

                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><?= $userMenuOther->logout; ?></a>
                </div>
            </div>
        </div>
    </div>
</header>