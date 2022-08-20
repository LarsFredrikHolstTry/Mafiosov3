<?php

include '../../global-variables.php';
include '../../db/PDODB.php';


$fightPoints = DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

?>

<span class="status status-blue"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barbell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M2 12h1"></path>
        <path d="M6 8h-2a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h2"></path>
        <path d="M6 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z"></path>
        <path d="M9 12h6"></path>
        <path d="M15 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1 -1v-10a1 1 0 0 0 -1 -1h-1a1 1 0 0 0 -1 1z"></path>
        <path d="M18 8h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2"></path>
        <path d="M22 12h-1"></path>
    </svg>Slåsspoeng: <span id="strength"><?= number($fightPoints) ?></span></span>