<div class="modal modal-blur fade" id="modal-small" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Er du sikker?</div>
                <div>Er du sikker på at du vil selge alle tingene dine?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Avbryt</button>
                <button type="button" id="sell_all" class="btn btn-success" data-bs-dismiss="modal">Selg alle</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#sell_all').click(function() {
            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/storageUnit/storageUnit_sell_all.inc.php',
                method: 'post',
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        $('#total_things').text(0);
                        htmx.trigger("#rankbar", "rankbarUpdated");
                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                        htmx.trigger("#things", "sellThings");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>