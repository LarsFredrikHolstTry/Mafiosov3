<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.php'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->placebo; ?></h3>
            </h3>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Siste samtaler</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable overflow-auto" style="height: 35rem">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto"><span class="badge bg-red"></span></div>
                                <div class="col-auto">
                                    <a href="#">
                                        <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                    </a>
                                </div>
                                <div class="col text-truncate">
                                    <a href="#" class="text-reset d-block">Paweł Kuna</a>
                                    <div class="d-block text-muted text-truncate mt-n1">Change deprecated html tags to text decoration classes (#29604)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="overflow-auto" style="height: 33rem">
                    <div class="card card-sm highlight" style="margin: 5px; width: 300px;">
                        <div class="card-body">
                            <p>This is some text within a card body.</p>
                        </div>
                    </div>
                    <div class="card card-sm bg-indigo" style="float: right; margin: 5px; width: 300px;">
                        <div class="card-body">
                            <p>This is some text within a card body.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>