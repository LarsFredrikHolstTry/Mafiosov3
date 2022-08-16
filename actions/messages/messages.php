<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

// TODO: Sjekk om brukeren har fått meldinger i det hele tatt!

$lastMessageRow = DB::run("SELECT * FROM pm WHERE LENGTH(PM_message) > 0 AND PM_from = ? OR PM_to = ? LIMIT 1", [$session_id, $session_id])->fetch();
$uniqueId = $lastMessageRow['PM_uniqueId'];

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Samtaler</h3>
            </h3>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Siste samtaler</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable overflow-auto" style="height: 35rem">
                        <?php

                        $stmt = DB::run("SELECT * FROM pm WHERE PM_from = $session_id OR PM_to = $session_id GROUP BY PM_uniqueId ORDER BY PM_date DESC");
                        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

                            $userId =       $row['PM_from'] == $session_id ? $row['PM_to'] : $row['PM_from'];
                            $lastMessage =  $row['PM_message'];
                            $avatar =       DB::run("SELECT AS_avatar FROM account_stat WHERE AS_id = ?", [$userId])->fetchColumn();
                            $ACC_row =      DB::run("SELECT ACC_username, ACC_last_active FROM account WHERE ACC_id = ?", [$userId])->fetch();
                            $isActive =     $ACC_row['ACC_last_active'] + 120 >= time();

                        ?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar" style="background-image: url(<?= $avatar ?>)">
                                            <?php if ($isActive) { ?>
                                                <span class="badge bg-green"></span>
                                            <?php } else { ?>
                                                <span class="badge bg-red"></span>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    <div class="col text-truncate">
                                        <div class="text-reset d-block fake-link cursor-pointer"><?= $ACC_row['ACC_username'] ?></div>
                                        <div class="d-block text-muted text-truncate mt-n1"><?= $lastMessage ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="overflow-auto" style="height: 33rem; display: flex; flex-direction: column-reverse;">
                    <div hx-get="actions/messages/fetch_messages.inc.php?id=<?= $uniqueId ?>" id="updatePM" hx-trigger="updatePM, load"></div>
                </div>
                <div class="align-items-center" style="margin: 5px;">
                    <?php include '../../components/markdown_top.php'; ?>
                    <div class="df">
                        <textarea id="txtarea" class="form-control" name="textarea-input" rows="2" placeholder="Send melding..."></textarea>
                        <div class="btn send-message">Send</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.send-message').click(function() {
            var message = $("#txtarea").val();
            var uniqueId = "<?= $uniqueId ?>";

            $("#feedback-container").load("components/feedback.php");

            $.ajax({
                url: 'actions/messages/send_message.inc.php',
                method: 'post',
                data: {
                    message: message,
                    uniqueId: uniqueId,
                },
                success: function(response) {
                    var feedback = response;
                    feedback = feedback.split("<|>");

                    var feedbackText = feedback[0];
                    var feedbackType = feedback[1];

                    if (feedbackType == 'success') {
                        htmx.trigger("#updatePM", "updatePM");
                    }

                    feedbackReturn(feedbackText, feedbackType);
                }
            });
        });
    });
</script>