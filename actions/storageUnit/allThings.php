<?php

include '../../global-variables.php';
include '../../functions/things.php';
include '../../db/PDODB.php';

function amount_of_thing($acc_id, $id)
{
    $total = DB::run("SELECT count(*) FROM storage WHERE ST_acc_id = ? AND ST_type = ?", [$acc_id, $id])->fetchColumn();
    return $total;
}

$total_things = DB::run("SELECT count(*) FROM storage WHERE ST_acc_id = ?", [$session_id])->fetchColumn();

if ($total_things == 0) {
    echo '<div class="text-info df mt-2 mb-2 jcc">Du har ingen ting på lageret. Utfør
        <strong 
        hx-get="actions/theft/theft.php" 
        hx-trigger="click" 
        hx-target="#container" 
        hx-swap="outerHTML" 
        class="px-1 cursor-pointer fake-link" 
        id="htmxForm">
        brekk</strong> 
        for å skaffe ting.</div>';
} else {

?>
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                <th>Ting</th>
                <th>Verdi</th>
                <th>Antall</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stmt = DB::run("SELECT DISTINCT ST_type from storage WHERE ST_acc_id = ? ORDER BY ST_type DESC", [$session_id]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                $amount = amount_of_thing($session_id, $row['ST_type']);
            ?>
                <tr>
                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                    <td><?= $thing_name[$row['ST_type']] ?></td>
                    <td><?= number($thing_price[$row['ST_type']] * $amount) ?> kr</td>
                    <td><?= number($amount) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}
?>