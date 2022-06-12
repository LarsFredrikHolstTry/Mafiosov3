<?php

include '../../global-variables.php';

$price = 1000000;

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->jail; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <img class="center-image" style="width: auto;" src="actions/jail/img/fengsel.png" />
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal-small">
                    Kjøp fengsel
                </button>
            </div>
        </div>
    </div>

    <?php include '../../actions/jail/modals.php'; ?>

</div>

<script>

</script>