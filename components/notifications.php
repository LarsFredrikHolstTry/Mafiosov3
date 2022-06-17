<?php


$notifications = DB::run("SELECT COUNT(NO_text) FROM notification WHERE NO_acc_id = ? AND NO_unread = ?", [$session_id, 0])->fetchColumn();

$unread_string = $notifications > 1 ? 'uleste varsler' : 'ulest varsel';

?>
<div class="nav-item dropdown d-none d-md-flex me-3">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
        </svg>
        <?php

        if ($notifications > 0) {
        ?>
            <span class="badge badge-pill bg-blue"><?= $notifications ?></span>
        <?php } ?>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card" style="min-width: 350px;">
        <div class="card">
            <div class="card-header">
                <div class="col text-truncate">
                    <div class="text-body d-block">
                        <h3 class="card-title lh-sm">Varsler</h3>
                    </div>
                    <div class="d-block text-muted text-truncate mt-n1">
                        <?= $notifications > 0 ? $notifications . ' ' . $unread_string : 'Ingen varsler' ?>
                    </div>
                </div>
            </div>
            <?php


            $stmt = DB::run("SELECT NO_text, NO_date FROM notification WHERE NO_acc_id=?", [$session_id]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

            ?>
                <div class="list-group list-group-flush list-group-hoverable">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                            <div class="col text-truncate">
                                <div class="text-body d-block"><?= $row['NO_text'] ?></div>
                                <div class="d-block text-muted text-truncate mt-n1">
                                    <?= $row['NO_date'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>