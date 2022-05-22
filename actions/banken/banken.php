<?php

include '../../lang/lang.php';
include '../../global_variables.php';

?>
<div class="card col-6" id="container">
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
                                    <?= str_replace('{value}', $total, $useLang->index->money); ?>
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
                                    <?= str_replace('{value}', $total, $useLang->index->money); ?>
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
                                    <?= $total; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <button id="butsave" class="btn btn-primary btn-sm" type="button">Sett inn 100 000 kr</button> -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#butsave').on('click', function() {
            $.ajax({
                url: 'actions/banken/money_in.inc.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    test: 'hello world'
                },
                success: function(data) {
                    $("#money_in").show().delay(3000).fadeOut();
                }
            })
        });
    });
</script>