<?php

include '../../functions/cities.php';

$familyId = $isMember;
$territoriumOwned = [];
$bulletRequirement = 1000;

$stmt = DB::run("SELECT * FROM territorium WHERE TE_family_id = $familyId");
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    array_push($territoriumOwned, $row['TE_city']);
}

?>

<div hx-get="actions/family/family.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer">
    Tilbake til familieoversikt
</div>
<p class="mt-2 text-muted">
    Ved å ta over territorium har familien mulighet for å tjene penger for hver transaksjon
    som blir utført i byen man eier. Det koster <?= number($bulletRequirement) ?> kuler å angripe
    en by som allerede er eid av en annen familie.
</p>

<div class="container-tight py-4">
    <div class="mb-3">
        <p>Kuler i familiebanken: <span id="fam_bullets"><?= number($familyRow['FA_bullets']); ?></span></p>
        <label class="form-label">Velg by</label>
        <select id="city" class="form-select">
            <?php

            for ($i = 0; $i < count($city); $i++) {
                if (!in_array($i, $territoriumOwned)) {
            ?>
                    <option value=<?= $i ?>><?= $city[$i] ?></option>
            <?php }
            } ?>
        </select>
        <div class=" d-flex mt-2">
            <div class="ml-025 btn btn-warning btn-square btn-md buy_bullets" id="attack">
                Angrip
            </div>
        </div>

        <div hx-get="actions/family/territorium_overview.inc.php" id="territoriumOverview" hx-trigger="load, territoriumUpdate"></div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#attack').click(function() {
            var city = $("#city").find(':selected').val();

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/territorium_attack.inc.php',
                method: 'post',
                data: {
                    city: city,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#territoriumOverview", "territoriumUpdate");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })
</script>