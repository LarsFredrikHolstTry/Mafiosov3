<?php

include '../../global-variables.php';
include '../../db/PDODB.php';
include 'fightClubVariables.inc.php';


?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->fightClub; ?></h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image mb-2" src="actions/fightClub/img/fightClub.png" />
                <div class="col-12 df jcc aic mb-2">
                    <div hx-get="actions/fightClub/fightScore.inc.php" id="updateScore" hx-trigger="updateScore, load"></div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h3>Trening</h3>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Styrke</th>
                                        <th>Ventetid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($category); $i++) { ?>
                                        <tr class="cursor-pointer train" id="<?= $i; ?>">
                                            <td>Tren <?= $category[$i] ?></td>
                                            <td>+<?= $addon[$i] ?></td>
                                            <td class="text-muted"><?= $cooldown[$i] ?>s</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <h3>Slåsskamp</h3>
                        <div class="fight btn btn-secondary cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-karate" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="18" cy="4" r="1"></circle>
                                <path d="M3 9l4.5 1l3 2.5"></path>
                                <path d="M13 21v-8l3 -5.5"></path>
                                <path d="M8 4.5l4 2l4 1l4 3.5l-2 3.5"></path>
                            </svg>
                            Finn slåsskamp
                        </div>
                        <h3 class="mt-2">Siste kamper</h3>
                        <div hx-get="actions/fightClub/lastFights.inc.php" id="lastFights" hx-trigger="lastFights, load"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.train').click(function() {
            var alt = $(this).closest(".train").attr("id");

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/fightClub/train.inc.php',
                method: 'post',
                data: {
                    alt: alt,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];
                    var cooldown = feedback[2];

                    if (feedbackType == 'success') {
                        if (feedbackType == 'success') {
                            htmx.trigger("#rankbar", "rankbarUpdated");
                            htmx.trigger("#updateScore", "updateScore");
                            $("#cooldown_fightClub").removeClass("text-success");
                            $("#cooldown_fightClub").addClass("text-danger");
                            $("#cooldown_fightClub").text(cooldown);
                            countdown(cooldown, "cooldown_fightClub");
                        }
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });

    $(document).ready(function() {
        $('.fight').click(function() {

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/fightClub/fight.inc.php',
                method: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];
                    var cooldown = feedback[2];

                    if (feedbackType == 'success') {
                        if (feedbackType == 'success') {
                            htmx.trigger("#updateScore", "updateScore");
                            htmx.trigger("#lastFights", "lastFights");
                        }
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>