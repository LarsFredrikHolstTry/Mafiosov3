<div class="align-items-center">
    <input id="sortpicture" type="file" name="sortpicture" />

    <button id="save-btn" class="mt-2 btn btn-bitbucket">
        Lagre
    </button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#save-btn').on('click', function() {
            var file_data = $('#sortpicture').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/saveAvatar.inc.php',
                dataType: 'text',
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