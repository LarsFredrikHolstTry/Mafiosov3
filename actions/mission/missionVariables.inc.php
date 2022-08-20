<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$missions = 1;

$difficultyCats[0] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-green-lt">Enkel</span>';
$difficultyCats[1] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-yellow-lt">Middels</span>';
$difficultyCats[2] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-red-lt">Vanskelig</span>';
$difficultyCats[3] = '<span class="text-muted mr-05">Vanskelighetsgrad:</span> <span class="badge bg-purple-lt">Ekspert</span>';

$difficultyMission[0] = 0;
$difficultyMission[1] = 0;

$isDoneIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <circle cx="12" cy="12" r="9"></circle>
    <path d="M9 12l2 2l4 -4"></path>
</svg>';

$isNotDoneIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<circle cx="12" cy="12" r="9"></circle>
</svg>';
