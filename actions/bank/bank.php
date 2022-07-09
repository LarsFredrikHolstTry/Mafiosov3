<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$AS_bankmoney =     DB::run("SELECT AS_bankmoney FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$AS_money =         DB::run("SELECT AS_money FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$AS_points =        DB::run("SELECT AS_points FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();

?>

<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-capitalize"><?= $useLang->action->bank; ?></h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" src="actions/bank/img/bank.png" />
            </div>
        </div>
        <div class="card-body" style="border-top: none;">
            <div class="row row-cards">
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-azure text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-euro" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17.2 7a6 7 0 1 0 0 10"></path>
                                        <path d="M13 10h-8m0 4h8"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    <?= $useLang->finance->balance; ?>
                                </div>
                                <div class="font-weight-medium">
                                    <div hx-get="actions/bank/fetch_balance.php" id="bankMoney" hx-trigger="moneyUpdated">
                                        <?= str_replace('{value}', number($AS_bankmoney), $useLang->index->money); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-yellow text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-infographic" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="7" cy="7" r="4"></circle>
                                        <path d="M7 3v4h4"></path>
                                        <line x1="9" y1="17" x2="9" y2="21"></line>
                                        <line x1="17" y1="14" x2="17" y2="21"></line>
                                        <line x1="13" y1="13" x2="13" y2="21"></line>
                                        <line x1="21" y1="12" x2="21" y2="21"></line>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    <?= $useLang->finance->interestByMidnight; ?>
                                </div>
                                <div class="font-weight-medium">
                                    <?= number($AS_bankmoney / 10) ?> <span class="text-muted">(10%)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-pink text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-asana" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="7" r="3"></circle>
                                        <circle cx="17" cy="16" r="3"></circle>
                                        <circle cx="7" cy="16" r="3"></circle>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    <?= $useLang->finance->gems; ?>
                                </div>
                                <div class="font-weight-medium">
                                    <?= number($AS_points); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cards mt-1">
                <div class="col-lg-6">
                    <div class="card card-sm">
                        <h2><?= $useLang->finance->deposit; ?> / <?= $useLang->finance->withdraw; ?></h2>
                        <h4><?= $useLang->finance->amount; ?> </h4>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <input class="form-check-input m-0" id="all" type="checkbox">
                                <span style="margin-left: 10px;"><?= $useLang->finance->all; ?></span>
                            </span>
                            <input type="text" placeholder="Beløp" class="form-control" id="number" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <div class="btn btn-success cursor-pointer" id="deposit-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <?= $useLang->finance->deposit; ?>
                            </div>
                            <div class="btn btn-warning cursor-pointer" id="withdraw-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <?= $useLang->finance->withdraw; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-sm">
                        <h2><?= $useLang->finance->wireMoney; ?></h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label"><?= $useLang->finance->username; ?></label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <input type="text" id="username" class="form-control" placeholder="<?= $useLang->finance->username; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label"><?= $useLang->finance->amount; ?></label>
                                <input type="text" id="money" class="form-control" name="example-password-input" id="numberWire" placeholder="<?= $useLang->finance->amount; ?>">
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label class="form-label"><?= $useLang->finance->message; ?></label>
                                <textarea class="form-control" id="message" name="example-textarea" placeholder="<?= $useLang->finance->messageText; ?>"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <i class="text-muted">10% overføringsgebyr</i>
                                    <div class="btn btn-bitbucket btn-md ms-auto" id="transfer-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                            <line x1="15" y1="16" x2="19" y2="12" />
                                            <line x1="15" y1="8" x2="19" y2="12" />
                                        </svg>
                                        <?= $useLang->finance->wireMoney; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row align-items-center">
            <div class="hr-text">
                <span><?= $useLang->finance->lastTransfers; ?></span>
            </div>
            <div hx-get="actions/bank/transfers.inc.php" id="transferMoney" hx-trigger="load, transferUpdate"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    number_space("#number");
    number_space("#numberWire");

    $(document).ready(function() {
        $('#deposit-btn').click(function() {
            if ($('#all').is(':checked')) {
                var value = <?= $AS_money ?>;
            } else {
                var value = $("#number").val();
            }

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/bank/money_in.inc.php',
                method: 'post',
                data: {
                    value: value,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#bankMoney", "moneyUpdated");
                    htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#withdraw-btn').click(function() {
            if ($('#all').is(':checked')) {
                var value = <?= $AS_bankmoney ?>;
            } else {
                var value = $("#number").val();
            }

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/bank/money_out.inc.php',
                method: 'post',
                data: {
                    value: value,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#bankMoney", "moneyUpdated");
                    htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#transfer-btn').click(function() {
            var username = $("#username").val();
            var money = $("#money").val();
            var message = $("#message").val();
            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/bank/transfer_money.inc.php',
                method: 'post',
                data: {
                    username: username,
                    money: money,
                    message: message
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#bankMoney", "moneyUpdated");
                    htmx.trigger("#transferMoney", "transferUpdate");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>