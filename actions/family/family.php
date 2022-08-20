<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'familyvariables.inc.php';

$isMember = DB::run("SELECT FM_family_id FROM family_member WHERE FM_acc_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->family; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <?php

                if ($isMember) {
                    include 'familyDashboard.php';
                } elseif (isset($_GET['application'])) {
                    $family = $_GET['application'];

                    $familyRow = DB::run("SELECT * FROM family WHERE FA_id = ?", [$family])->fetch();

                ?>
                    <div class="col-12">
                        <h3>Send søknad til <?= $familyRow['FA_name'] ?></h3>
                        <textarea class="form-control btn-square" name="example-textarea-input" id="applicationText" rows="6" placeholder="Skriv en søknad om hvorfor <?= $familyRow['FA_name'] ?> skal akseptere deg som consigliere"></textarea>
                        <div class="mt-2 btn btn-square btn-success" id="sendApplication">
                            Send søknad
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#sendApplication').click(function() {
                                var applicationText = $("#applicationText").val();

                                $("#feedback-container").load("components/feedback.php");

                                $.ajax({
                                    url: 'actions/family/sendApplication.inc.php',
                                    method: 'post',
                                    data: {
                                        familyId: <?= $family ?>,
                                        applicationText: applicationText,
                                    },
                                    success: function(response) {
                                        var feedback = response;
                                        feedback = feedback.split("<|>");

                                        var feedbackText = feedback[0];
                                        var feedbackType = feedback[1];

                                        feedbackReturn(feedbackText, feedbackType);
                                    }
                                });
                            })
                        })
                    </script>

                <?php } else { ?>
                    <div class="col-4">
                        <h3>Stift ny familie</h3>
                        <p class="text-muted">Med familie kommer det ansvar. Du må passe på dine medlemmer, men også straffe dem om de ikke
                            gjør som familiens underboss eller boss sier</p>
                        <div class="mb-3">
                            <label class="form-label">Familienavn<span class="ml-05 text-muted">(Pris: 1 000 000 kr)</span></label>
                            <input type="text" id="family_name" class="mb-2 btn-square form-control" name="example-text-input" placeholder="Familienavn...">
                            <div id="create_family" class="btn btn-square btn-bitbucket">Stift familie</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h3>Oversikt over familier</h3>
                        <div class="table-responsive">
                            <div hx-get="actions/family/family_list.inc.php" hx-trigger="load"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#create_family').click(function() {
            var family_name = $("#family_name").val();

            $.ajax({
                url: 'actions/family/create_family.inc.php',
                method: 'post',
                data: {
                    name: family_name,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    }

                    htmx.ajax('GET', 'actions/family/family.php', {
                        target: '#container',
                        swap: 'outerHTML'
                    })

                }
            });
        })
    })
</script>