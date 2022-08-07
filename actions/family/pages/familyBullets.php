<div hx-get="actions/family/family.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer">
    Tilbake til familieoversikt
</div>
<p class="mt-2 text-muted">I familiebanken kan Boss og Underboss ta ut kuler, mens alle kan sette inn kuler.
    Kulene blir gjerne brukt til angrep ved krig eller ved store drap</p>

<div class="container-tight py-4">
    <div class="mb-3">
        <p>Kuler i familiebanken: <span id="fam_bullets"><?= number($familyRow['FA_bullets']); ?></span></p>
        <label class="form-label">Antall kuler</label>
        <input type="text" id="number" class="form-control" name="example-text-input" placeholder="antall...">
        <div class="d-flex mt-2">
            <div class="btn btn-success btn-square btn-md buy_bullets" id="bullets_in">
                Sett inn kuler
            </div>
            <div class="ml-025 btn btn-warning btn-square btn-md buy_bullets" id="bullets_out">
                Ta ut kuler
            </div>
        </div>
    </div>
</div>

<script>
    number_space("#number");

    $(document).ready(function() {
        $('#bullets_in').click(function() {
            var amount = parseInt($("#number").val().replace(/\s/g, ''));

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/bullets_in.inc.php',
                method: 'post',
                data: {
                    amount: amount,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        var amountInFamily = parseInt($("#fam_bullets").text());
                        var newAmount = (amountInFamily + amount);
                        $('#fam_bullets').text(newAmount.toLocaleString());

                        htmx.trigger("#bulletsUser", "bulletsUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })

    $(document).ready(function() {
        $('#bullets_out').click(function() {
            var amount = parseInt($("#number").val().replace(/\s/g, ''));

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/bullets_out.inc.php',
                method: 'post',
                data: {
                    amount: amount,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        var amountInFamily = parseInt($("#fam_bullets").text());
                        var newAmount = (amountInFamily - amount);
                        $('#fam_bullets').text(newAmount.toLocaleString());

                        htmx.trigger("#bulletsUser", "bulletsUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>