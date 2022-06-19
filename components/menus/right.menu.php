<?php

include '../../global-variables.php';
include '../../functions/cities.php';
include '../../db/PDODB.php';

$AS_city =      DB::run("SELECT AS_city FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$money_hand =   DB::run("SELECT AS_money FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();

?>
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <h3>Brukerinfo</h3>
            <p class="lh-lg">
                <svg style="margin-right: .35rem;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#626976" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                </svg>
                <span hx-get="components/menus/fetch_money.inc.php" id="moneyInHand" hx-trigger="moneyHandUpdated">
                    <?= str_replace('{value}', number($money_hand), $useLang->index->money); ?>
                </span>

                <br>
                <svg style="margin-right: .35rem;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#626976" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="3" y1="21" x2="21" y2="21"></line>
                    <path d="M5 21v-14l8 -4v18"></path>
                    <path d="M19 21v-10l-6 -4"></path>
                    <line x1="9" y1="9" x2="9" y2="9.01"></line>
                    <line x1="9" y1="12" x2="9" y2="12.01"></line>
                    <line x1="9" y1="15" x2="9" y2="15.01"></line>
                    <line x1="9" y1="18" x2="9" y2="18.01"></line>
                </svg>
                <span hx-get="components/menus/fetch_city.inc.php" id="city" hx-trigger="cityUpdated">
                    <?= $city[$AS_city]; ?>
                </span>
                <br>
                <svg style="margin-right: .35rem;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#626976" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
                </svg> 1 000 520 974<br>
            </p>
        </div>
        <div class="card-body" style="border-top: none; padding-top: 0;">
            <div class="d-flex mb-2">
                <div>75%</div>
                <div class="ms-auto">
                    <span class="text-green d-inline-flex align-items-center lh-1">
                        75/100 EXP
                    </span>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                </div>
            </div>
        </div>
        <div class="card-body" style="border-top: none; padding-top: 0;">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-title">Happy hours!</h4>
                <div class="text-muted">Dobbel EXP og dobbel verdi på ting og biler</div>
            </div>
            <div class="hr-text">
                <span>Siste handlinger</span>
            </div>
        </div>
    </div>
</div>