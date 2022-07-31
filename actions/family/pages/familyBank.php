<div hx-get="actions/family/family.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer">
    Tilbake til familieoversikt
</div>
<p class="mt-2 text-muted">I familiebanken kan Boss og Underboss ta ut penger, mens alle kan sette inn penger.
    Pengene blir gjerne brukt til angrep ved krig eller til å skaffe familiemedlemmer midler</p>

<div class="container-tight py-4">
    <div class="mb-3">
        <p>Penger i familiebanken: <span id="fam_money"><?= number($familyRow['FA_money']); ?></span> kr</p>
        <label class="form-label">Antall kr</label>
        <input type="text" id="number" class="form-control" name="example-text-input" placeholder="antall...">
        <div class="d-flex mt-2">
            <div class="btn btn-success btn-square btn-md buy_bullets" id="money_in">
                Sett inn
            </div>
            <div class="ml-025 btn btn-warning btn-square btn-md buy_bullets" id="money_out">
                Ta ut
            </div>
        </div>
    </div>
</div>

<script>
    number_space("#number");

    $(document).ready(function() {
        $('#money_in').click(function() {
            var amount = parseInt($("#number").val().replace(/\s/g, ''));

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/money_in.inc.php',
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
                        var amountInBank = parseInt($("#fam_money").text());
                        var newAmount = (amountInBank + amount);
                        $('#fam_money').text(newAmount.toLocaleString());

                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })

    $(document).ready(function() {
        $('#money_out').click(function() {
            var amount = parseInt($("#number").val().replace(/\s/g, ''));

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/money_out.inc.php',
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
                        var amountInBank = parseInt($("#fam_money").text());
                        var newAmount = (amountInBank - amount);
                        $('#fam_money').text(newAmount.toLocaleString());

                        htmx.trigger("#moneyInHand", "moneyHandUpdated");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>