<?php

include '../../global-variables.php';

?>
<div class="col-12" id="container">

    <div id="feedback-container"></div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h3 class="card-title text-capitalize">Aksjemarked</h3>
            </h3>
            <div class="ms-auto">
                <span hx-get="actions/faq/faq.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="form-help">?</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="position-relative mb-2">
                    <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
                        <div class="row g-2">
                            <div class="col-auto">
                                <div class="chart-sparkline chart-sparkline-square" id="sparkline-activity" style="min-height: 41px;">
                                    <div id="apexchartslkm6wjqtj" class="apexcharts-canvas apexchartslkm6wjqtj apexcharts-theme-light" style="width: 40px; height: 41px;"><svg id="SvgjsSvg2329" width="40" height="41" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                            <g id="SvgjsG2331" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                                <defs id="SvgjsDefs2330">
                                                    <clipPath id="gridRectMasklkm6wjqtj">
                                                        <rect id="SvgjsRect2333" width="46" height="42" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMasklkm6wjqtj"></clipPath>
                                                    <clipPath id="nonForecastMasklkm6wjqtj"></clipPath>
                                                    <clipPath id="gridRectMarkerMasklkm6wjqtj">
                                                        <rect id="SvgjsRect2334" width="44" height="44" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g id="SvgjsG2335" class="apexcharts-radialbar">
                                                    <g id="SvgjsG2336">
                                                        <g id="SvgjsG2337" class="apexcharts-tracks">
                                                            <g id="SvgjsG2338" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                                                <path id="apexcharts-radialbarTrack-0" d="M 20 4.146341463414631 A 15.85365853658537 15.85365853658537 0 1 1 19.99723301461454 4.1463417048796565" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.3658536585365857" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 20 4.146341463414631 A 15.85365853658537 15.85365853658537 0 1 1 19.99723301461454 4.1463417048796565"></path>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG2340">
                                                            <g id="SvgjsG2342" class="apexcharts-series apexcharts-radial-series" seriesName="series-1" rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath2343" d="M 20 4.146341463414631 A 15.85365853658537 15.85365853658537 0 0 1 32.82587917911502 29.31854668268555" fill="none" fill-opacity="0.85" stroke="rgba(32,107,196,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.439024390243903" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="126" data:value="35" index="0" j="0" data:pathOrig="M 20 4.146341463414631 A 15.85365853658537 15.85365853658537 0 0 1 32.82587917911502 29.31854668268555"></path>
                                                            </g>
                                                            <circle id="SvgjsCircle2341" r="14.670731707317076" cx="20" cy="20" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine2344" x1="0" y1="0" x2="40" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine2345" x1="0" y1="0" x2="40" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                            </g>
                                            <g id="SvgjsG2332" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div>Dagens inntekt: 0kr</div>
                                <div class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="3 17 9 11 13 15 21 7"></polyline>
                                        <polyline points="14 7 21 7 21 14"></polyline>
                                    </svg>
                                    +0% mer enn i går
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="personalGraph"></div>
                    <script>
                        window.ApexCharts && (new ApexCharts(document.getElementById('personalGraph'), {
                            chart: {
                                type: "area",
                                fontFamily: 'inherit',
                                height: 230,
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
                                data: [12, 15, 16, 15, 16, 17, 15, 14, 13, 12]
                            }],
                            grid: {
                                padding: {
                                    top: -20,
                                    right: 0,
                                    left: -4,
                                    bottom: -4
                                },
                                strokeDashArray: 2,
                                yaxis: {
                                    lines: {
                                        show: false
                                    }
                                },
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
                                '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '00:00'
                            ],
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
                <div class="col-6 mt-4">
                    <div hx-get="actions/stockMarket/renderStockGraph.inc.php?id=0" hx-trigger="load"></div>
                </div>
                <div class="col-6 mt-4">
                    <div hx-get="actions/stockMarket/renderStockGraph.inc.php?id=1" hx-trigger="load"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var value = value;
            $("#feedback-container").load("components/feedback.php");
        })
    })
</script>