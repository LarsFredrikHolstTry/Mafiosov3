<div class="nav-item dropdown d-none d-md-flex me-3">
    <div class="nav-link px-0 cursor-pointer" data-bs-toggle="dropdown" id="read_all" tabindex="-1" aria-label="Show notifications">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
        </svg>
        <div hx-get="components/notification/unread_amount.inc.php" id="notificationAmount" hx-trigger="load, notificationAmountUpdate, every 10s"></div>
    </div>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card" style="min-width: 350px;">
        <div hx-get="components/notification/notificationList.inc.php" id="notificationList" hx-trigger="load, notificationListUpdate"></div>
    </div>
</div>

<script>
    $('#read_all').click(function() {
        $.ajax({
            url: 'components/readAllNotifications/readAllNotifications.php',
            method: 'post',
        });
        htmx.trigger("#notificationAmount", "notificationAmountUpdate");
        $(this).delay(5000).queue(function() {
            htmx.trigger("#notificationList", "notificationListUpdate");
        });
    });
</script>