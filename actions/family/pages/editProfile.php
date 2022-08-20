<?php

$family_id = $_GET['id'];

$profileText = DB::run("SELECT FA_profile FROM family WHERE FA_id = ?", [$family_id])->fetchColumn();
?>

<div class="align-items-center">
    <?php include '../../components/markdown_top.php'; ?>
    <textarea id="txtarea" class="form-control" name="textarea-input" rows="25"><?= $profileText ?></textarea>

    <button id="save-btn" class="mt-2 btn btn-bitbucket">
        Lagre
    </button>
</div>

<script>
    $(document).ready(function() {
        $('#save-btn').click(function() {
            var value = $("#txtarea").val();
            var family = <?= $family_id ?>;

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/saveProfile.inc.php',
                method: 'post',
                data: {
                    profileText: value,
                    family: family,
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