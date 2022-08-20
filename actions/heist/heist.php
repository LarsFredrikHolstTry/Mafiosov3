<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Heist</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="empty">
                <div class="empty-img"><img src="img/noResult.svg" height="128" alt="">
                </div>
                <p class="empty-title">Funksjonen er under utvikling</p>
                <p class="empty-subtitle text-muted">
                    Denne funksjonen er for tiden under utvikling og vil lanseres fortløpende
                    <br><a class="mt-2 btn btn-facebook" target="_blank" href="https://discord.gg/CsZht4W4Cb">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-discord" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>
                            <path d="M7.5 7.5c3.5 -1 5.5 -1 9 0"></path>
                            <path d="M7 16.5c3.5 1 6.5 1 10 0"></path>
                            <path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-1 2.5"></path>
                            <path d="M8.5 17c0 1 -1.356 3 -1.832 3c-1.429 0 -2.698 -1.667 -3.333 -3c-.635 -1.667 -.476 -5.833 1.428 -11.5c1.388 -1.015 2.782 -1.34 4.237 -1.5l1 2.5"></path>
                        </svg>
                        Bli med i vår discord for oppdateringer!</a>
                </p>
            </div>
        </div>
    </div>
</div>