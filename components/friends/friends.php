<div class="nav-item dropdown d-none d-md-flex me-1">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" data-bs-auto-close="outside">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
        </svg>
        <span class="badge badge-pill bg-blue">3</span>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card" style="min-width: 350px;" data-bs-popper="static">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title lh-sm">Venner
                </h3>
            </div>
            <div id="friends-body">
                <div hx-target="#friends-body" hx-swap="outerHTML" hx-get="components/friends/friends-overview.php" hx-trigger="load"></div>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                <a class="dropdown-item" href="#">
                    Åpne i ny side
                </a>
            </div>
        </div>
    </div>
</div>