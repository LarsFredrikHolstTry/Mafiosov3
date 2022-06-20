<?php

include '../../global-variables.php';
include '../../components/markdown_top.php';
require_once '../../db/PDODB.php';

$profile_text =  DB::run("SELECT PR_content FROM profiles WHERE PR_acc_id = ?", [$session_id])->fetchColumn();

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->editAvatar; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <form class="dropzone dz-clickable" id="dropzone-default" action=".">

                <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button></div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col-auto">
                    <button id="save-btn" class="btn btn-bitbucket">
                        <?= $useLang->editProfile->save; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        new Dropzone("#dropzone-default")
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#save-btn').click(function() {
            var value = $("#avatar").val();

            $.ajax({
                url: 'actions/editAvatar/editAvatar.inc.php',
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