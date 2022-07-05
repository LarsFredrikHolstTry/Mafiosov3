<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>
    <div class="page-header d-print-none">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <span class="status-indicator status-green status-indicator-animated">
                    <span class="status-indicator-circle"></span>
                    <span class="status-indicator-circle"></span>
                    <span class="status-indicator-circle"></span>
                </span>
            </div>
            <div class="col">
                <h2 class="page-title">
                    Mafioso.no
                </h2>
                <div class="text-muted">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">Status: <span class="text-green">Online</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="cursor-pointer btn btn-bitbucket">
                        Steng Mafioso
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <h3 class="card-title text-capitalize">Admin panel</h3>
                </h3>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart-demo-line" class="chart-lg"></div>
                        </div>
                    </div>
                    <script>
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-line'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 240,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: false,
                                },
                                animations: {
                                    enabled: false
                                },
                            },
                            fill: {
                                opacity: 1,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                                curve: "straight",
                            },
                            series: [{
                                name: "Session Duration",
                                data: [117, 92, 94, 98, 75, 110, 69, 80, 109, 113, 115, 95]
                            }, {
                                name: "Page Views",
                                data: [59, 80, 61, 66, 70, 84, 87, 64, 94, 56, 55, 67]
                            }, {
                                name: "Total Visits",
                                data: [53, 51, 52, 41, 46, 60, 45, 43, 30, 50, 58, 59]
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
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02'
                            ],
                            colors: ["#fab005", "#5eba00", "#206bc4"],
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>