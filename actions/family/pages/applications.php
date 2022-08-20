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
        <?php

        $id = $_GET['id'];

        $stmt = DB::run("SELECT * FROM family_application WHERE FAP_family = $id ORDER BY FAP_date ASC");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

            $acc_row = DB::run("SELECT ACC_id, ACC_username FROM account WHERE ACC_id = " . $row['FAP_acc_id'] . "")->fetch();

        ?>
            <tr>
                <td>
                    <span hx-post="actions/myProfile/myProfile.php?id=<?= $acc_row['ACC_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer font-weight-medium"><?= $acc_row['ACC_username'] ?></span>
                </td>
                <td class="text-muted"><?= $row['FAP_text'] ?></td>
                <td class="text-muted"><?= date_to_text($row['FAP_date']) ?></td>
                <td>
                    <div class="df">
                        <div class="accept btn btn-success btn-icon mr-05" aria-label="Button" id="<?= $row['FAP_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div class="cancel btn btn-danger btn-icon" aria-label="Button" id="<?= $row['FAP_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
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

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        })
    })

    $(document).ready(function() {
        $('.cancel').click(function() {
            var id = $(".cancel").attr("id");

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/family/cancelUser.inc.php',
                method: 'post',
                data: {
                    id: id,
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