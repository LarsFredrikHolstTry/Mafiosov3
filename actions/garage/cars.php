<?php

include '../../global-variables.php';
include '../../functions/cars.php';
include '../../functions/cities.php';
include '../../db/PDODB.php';

function amount_of_car($acc_id, $id, $city)
{
    $total = DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ? AND GA_car = ? AND GA_city = ?", [$acc_id, $id, $city])->fetchColumn();
    return $total;
}

$total_cars = DB::run("SELECT count(*) FROM garage WHERE GA_acc_id = ?", [$session_id])->fetchColumn();

if ($total_cars == 0) {
    echo '<div class="text-info df mt-2 mb-2 jcc">Du har ingen biler i garasjen. Utfør
    <strong 
    hx-get="actions/carTheft/carTheft.php" 
    hx-trigger="click" 
    hx-target="#container" 
    hx-swap="outerHTML" 
    class="px-1 cursor-pointer fake-link" 
    id="htmxForm">
    biltyveri</strong> 
    for å skaffe biler.</div>';
} else {

?>
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                <th>Bil</th>
                <th>By</th>
                <th>Verdi</th>
                <th>Antall</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stmt = DB::run("SELECT DISTINCT GA_car, GA_city from garage WHERE GA_acc_id = ? ORDER BY GA_car DESC", [$session_id]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                $amount = amount_of_car($session_id, $row['GA_car'], $row['GA_city']);
            ?>
                <tr>
                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                    <td><?= $car_name[$row['GA_car']] ?></td>
                    <td><span class="flag flag-country-<?= $flag[$row['GA_city']] ?> me-1"></span><?= $city[$row['GA_city']] ?></td>
                    <td><?= number($car_price[$row['GA_car']] * $amount) ?> kr</td>
                    <td><?= number($amount) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}
?>