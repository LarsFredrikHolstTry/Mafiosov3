<div id="friends-body">
    <div class="list-group list-group-flush list-group-hoverable">
        <a class="dropdown-item" hx-post="components/friends/friends-request.php" hx-trigger="click" hx-target="#friends-body" hx-swap="outerHTML" href="#">
            Venneforespørsler
            <span class="badge bg-primary ms-auto">3</span>
        </a>
    </div>
    <div class="list-group list-group-flush list-group-hoverable">
        <?php //TODO: Loop through friends 
        ?>
        <div class="list-group-item">
            <div class="row g-3 align-items-center">
                <a href="#" class="col-auto">
                    <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)">
                        <span class="badge bg-red"></span></span>
                </a>
                <div class="col text-truncate">
                    <a href="#" class="text-reset d-block text-truncate">Lorem Ipsum</a>
                    <div class="text-muted text-truncate mt-n1">Last Active Lorem Ipsum</div>
                </div>
            </div>
        </div>
        <?php ?>
    </div>
</div>