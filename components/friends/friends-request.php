<div id="friends-body">
    <div class="list-group list-group-flush list-group-hoverable">
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col text-truncate">
                    <a hx-post="components/friends/friends-overview.php" hx-trigger="click" hx-target="#friends-body" hx-swap="outerHTML" class="d-block text-muted text-truncate mt-n1" href="#">
                        Tilbake
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group list-group-flush list-group-hoverable">
        <?php //TODO: Loop through friend requests
        ?>
        <div class="list-group-item">
            <div class="row g-3 align-items-center">
                <a href="#" class="col-auto">
                    <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)">
                        <span class="badge bg-red"></span></span>
                </a>
                <div class="col text-truncate">
                    <a href="#" class="text-reset d-block text-truncate">Aksepter meg!!!</a>
                    <div class="text-muted text-truncate mt-n1">asdadadads</div>
                </div>
            </div>
        </div>
        <?php ?>
    </div>
</div>