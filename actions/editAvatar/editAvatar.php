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
                <h3 class="card-title text-capitalize"><?= $useLang->action->editAvatar; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <input id="sortpicture" type="file" name="sortpicture" />
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

<script type="text/javascript">
    $(document).ready(function() {
        // $('#save-btn').click(function() {
        //     console.log($('#sortpicture').prop('files')[0]);
        //     var file_data = $('#sortpicture').prop('files')[0];
        //     var form_data = new FormData();
        //     form_data.append('file', file_data);

        //     $("#feedback-container").load("components/feedback.php");

        //     $.ajax({
        //         url: 'actions/editAvatar/editAvatar.inc.php',
        //         data: form_data,
        //         type: 'post',
        // success: function(response) {
        //     var feedback = response;
        //     feedback = feedback.split("<|>");

        //     var feedbackText = feedback[0];
        //     var feedbackType = feedback[1];

        //     if (feedbackType == 'success') {
        //         htmx.trigger("#avatar", "avatarUpdate");
        //     }

        //     feedbackReturn(feedbackText, feedbackType);
        // }
        //     });
        // });



        $('#save-btn').on('click', function() {
            var file_data = $('#sortpicture').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/editAvatar/editAvatar.inc.php',
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#avatar", "avatarUpdate");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });



    });
</script>