<?php

$id = $_GET['id'];

$country =  ['us', 'se'];
$stocks =   ['Tusla', 'Frimurarbröder'];
$ticker =   ['TUSL', 'FRBR'];

$us_stock = [12, 15, 16, 12, 16, 17, 15, 14, 13, 12];
$se_stock = [26, 25, 24, 28, 30, 23, 21, 16, 14, 17];

$stock_array = $id == 0 ? $us_stock : $se_stock;
$upOrDown =
    $id == 0 ?
    ($us_stock[8] > $us_stock[9] ? 'red' : 'green')
    : ($se_stock[8] > $se_stock[9] ? 'red' : 'green');

$js_array = json_encode($stock_array);


?>

<h3><span class="flag flag-country-<?= $country[$id] ?>"></span> <?= $stocks[$id] ?> <span class="text-muted">(<?= $ticker[$id] ?>)</span></h3>
<div id="chart-demo-line<?= $id ?>"></div>
<span class="text-muted">Du eier: 0 aksjer</span>
<input type="text" class="form-control" name="example-text-input" placeholder="Antall" disabled>
<div class="mt-1 df aic">
    <div class="btn disabled">Kjøp</div>
    <div class="btn ml-025 disabled">Selg</div>
</div>

<script>
    var javascript_array = <?= $js_array ?>;
    var upOrDown = "<?= $upOrDown ?>";

    window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-line<?= $id ?>'), {
        chart: {
            type: "area",
            fontFamily: 'inherit',
            height: 130,
            parentHeightOffset: 0,
            toolbar: {
                show: false,
            },
            animations: {
                enabled: false
            },
        },
        dataLabels: {
            enabled: false,
        },
        fill: {
            opacity: 1,
        },
        stroke: {
            width: 2,
            lineCap: "round",
            curve: "smooth",
        },
        series: [{
            name: "Pris",
            data: javascript_array
        }],
        grid: {
            padding: {
                top: -20,
                right: 0,
                left: -4,
                bottom: -4
            },
            strokeDashArray: 4,
        },
        xaxis: {
            labels: {
                padding: 0,
            },
            tooltip: {
                enabled: false
            },
            type: 'text',
        },
        yaxis: {
            labels: {
                padding: 4
            },
        },
        labels: [
            '15:00', '15:10', '15:20', '15:30', '15:40', '15:50', '16:00', '16:10', '16:20', '16:30'
        ],
        colors: [upOrDown],
        legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
                width: 10,
                height: 10,
                radius: 100,
            },
            itemMargin: {
                horizontal: 8,
                vertical: 8
            },
        },
    })).render();
</script>