<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

?>
<div class="col-12" id="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $useLang->action->notifications; ?></h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="ms-auto text-muted">
                    Søk:
                    <div class="ms-2 d-inline-block">
                        <input type="text" id="my_input" onkeyup="searchTable()" class="form-control form-control-sm" aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter" id="table_id">
                <thead>
                    <tr>
                        <th>Varsel</th>
                        <th style="width: 200px;">Dato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $stmt = DB::run("SELECT NO_text, NO_date FROM notification WHERE NO_acc_id = ? ORDER BY NO_date asc", [$session_id]);
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

                    ?>
                        <tr>
                            <td><?= $row['NO_text'] ?></td>
                            <td class="text-muted">
                                <?= date_to_text($row['NO_date']) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>