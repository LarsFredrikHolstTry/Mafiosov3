<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$AS_bankmoney =     DB::run("SELECT AS_bankmoney FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();
$AS_points =        DB::run("SELECT AS_points FROM account_stat WHERE AS_id=?", [$session_id])->fetchColumn();

?>

<div class="card col-6" id="container">

    <?php include '../../components/feedback.php'; ?>

    <div class="card">
        <?php include 'alerts.inc.php'; ?>
        <div class="card-header">
            <h3 class="card-title text-capitalize"><?= $useLang->action->bank; ?></h3>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue text-white avatar">
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
                                <span class="bg-green text-white avatar">
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
                                    <?= str_replace('{value}', $interest, $useLang->index->money); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-purple text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="4"></circle>
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
                                <input class="form-check-input m-0" type="checkbox">
                                <span style="margin-left: 10px;"><?= $useLang->finance->all; ?></span>
                            </span>
                            <input type="text" class="form-control" id="number" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <button type="button" id="deposit-btn" class="btn btn-success btn-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <?= $useLang->finance->deposit; ?>
                            </button>
                            <button type="button" id="withdraw-btn" class="btn btn-warning btn-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <?= $useLang->finance->withdraw; ?>
                            </button>
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
                                    <input type="text" value="" class="form-control" placeholder="<?= $useLang->finance->username; ?>">
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <label class="form-label"><?= $useLang->finance->amount; ?></label>
                                <input type="text" class="form-control" name="example-password-input" id="numberWire" placeholder="<?= $useLang->finance->amount; ?>">
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label class="form-label"><?= $useLang->finance->message; ?></label>
                                <textarea class="form-control" name="example-textarea" placeholder="<?= $useLang->finance->messageText; ?>"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary btn-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <line x1="15" y1="16" x2="19" y2="12" />
                                        <line x1="15" y1="8" x2="19" y2="12" />
                                    </svg>
                                    <?= $useLang->finance->wireMoney; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <?php include 'alerts.inc.php'; ?>
        <div class="card-header">
            <h3 class="card-title text-capitalize"><?= $useLang->finance->lastTransfers; ?></h3>
        </div>
        <div class="card-body">
        </div>
    </div>
</div>
<script type="text/javascript">
    number_space("#number");
    number_space("#numberWire");

    $(document).ready(function() {
        $('#deposit-btn').click(function() {
            var value = $("#number").val();

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
            var value = $("#number").val();

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
</script>