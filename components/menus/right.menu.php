<?php

include '../../global-variables.php';
include '../../functions/cities.php';
include '../../db/PDODB.php';

$AS_user =      DB::run("SELECT AS_money, AS_city, AS_bullets FROM account_stat WHERE AS_id=?", [$session_id])->fetch();

?>
<div class="col-12">
    <div class="card-body">
        <h3>Brukerinfo</h3>
        <p class="lh-lg">
        <div class="df aic mb-2">
            <svg style="margin-right: .35rem;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#626976" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
            </svg>
            <span class="ml-025" hx-get="components/fetch_data/fetch_money.inc.php" id="moneyInHand" hx-trigger="moneyHandUpdated, every 10s">
                <?= str_replace('{value}', number($AS_user['AS_money']), $useLang->index->money); ?>
            </span>
        </div>
        <div class="df aic mb-2">
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
            <span class="ml-025" hx-get="components/fetch_data/fetch_city.inc.php" id="city" hx-trigger="cityUpdated">
                <?= $city[$AS_user['AS_city']]; ?>
            </span>
        </div>
        <div class="df aic">
            <svg style="margin-right: .35rem;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-pocket" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#626976" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h14a2 2 0 0 1 2 2v6a9 9 0 0 1 -18 0v-6a2 2 0 0 1 2 -2"></path>
                <polyline points="8 11 12 15 16 11"></polyline>
            </svg>
            <span class="ml-025" hx-get="components/fetch_data/fetch_bullets.inc.php" id="bulletsUser" hx-trigger="bulletsUpdated, every 10s">
                <?= number($AS_user['AS_bullets']); ?> kuler
            </span>
        </div>
        </p>
    </div>
    <div class="card-body" style="border-top: none; padding-top: 0;">
        <div hx-get="components/rankbar/rankbar.php" id="rankbar" hx-trigger="load, rankbarUpdated, every 60s"></div>
    </div>
    <div class="card-body" style="border-top: none; padding-top: 0;">
        <div hx-get="components/healthbar/healthbar.php" id="healthbar" hx-trigger="load, healthbarUpdated, every 60s"></div>
    </div>
    <div class="hr-text">
        <span>Annet</span>
    </div>
    <div class="row row-deck row-cards">
        <div class="col-6">
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <div hx-get="actions/playersOnline/playersOnline.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer text-muted">Spillere p??logget</div>
                    </li>
                    <li>
                        <div class="fake-link cursor-pointer text-muted">Personlig statistikk</div>
                    </li>
                    <li>
                        <div class="fake-link cursor-pointer text-muted">Statistikk</div>
                    </li>
                    <li>
                        <div class="fake-link cursor-pointer text-muted">Poenghandel</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <div hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer text-muted">FAQ</div>
                    </li>
                    <li>
                        <div class="fake-link cursor-pointer text-muted">Support</div>
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/LarsFredrikHolstTry/Mafiosov3" class="fake-link cursor-pointer text-muted">Github</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>