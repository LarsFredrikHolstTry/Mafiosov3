<?php

include '../../global-variables.php';
require_once '../../db/PDODB.php';

$profile_text =  DB::run("SELECT PR_content FROM profiles WHERE PR_acc_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->editProfile; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="align-items-center">
                <?php include '../../components/markdown_top.php'; ?>
                <textarea id="txtarea" class="form-control" name="textarea-input" rows="25"><?= $profile_text; ?></textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col"><?= $useLang->editProfile->style; ?> <a href="#"><?= $useLang->editProfile->bbCodes; ?></a></div>
                <div class="col-auto">
                    <button id="save-btn" class="btn btn-bitbucket">
                        <?= $useLang->editProfile->save; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#save-btn').click(function() {
            var value = $("#profile_text").val();

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/editProfile/editProfile.inc.php',
                method: 'post',
                data: {
                    value: value,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>