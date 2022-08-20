<?php

$family_id = $_GET['id'];

?>
<table class="table table-vcenter">
    <thead>
        <tr>
            <th>Mafioso</th>
            <th>Søknadstekst</th>
            <th>Dato</th>
            <th style="width:10%;">Handling</th>
        </tr>
    </thead>
    <tbody>
        <div hx-get="actions/family/applicationsList.inc.php?id=<?= $family_id ?>" id="applicationList" hx-trigger="load, updateApplications"></div>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.accept').click(function() {
            var id = $(".accept").attr("id");

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/acceptUser.inc.php',
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    htmx.trigger("#applicationList", "updateApplications");
                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>