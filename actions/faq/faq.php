<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <?php include '../../components/feedback.html'; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize"><?= $useLang->action->placebo; ?></h3>
            </h3>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="space-y-4">
                    <?php

                    include 'sections/intro.php';
                    include 'sections/ranks.php';
                    include 'sections/carTheft.php';

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>