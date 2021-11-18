<!-- Toastr style -->
<link href="<?= base_url() ?>assets/vendor/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

<!-- Gritter -->
<link href="<?= base_url() ?>assets/vendor/inspinia/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

<div class="row  border-bottom white-bg dashboard-header">
    <h2>
        <center><b>Capaian Vaksin Kabupaten Temanggung 2021</b></center>
    </h2>
    <br>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Data Capaian Vaksin Kabupaten Temanggung</h5>
            </div>
            <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot_bar_chart"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Data Capaian Vaksin Keseluruhan </h5>
            </div>
            <div class="ibox-content">
                <canvas id="doughnutChart" width="500" height="500"></canvas>
                <b>
                    <h5>Data Capaian Vaksin Keseluruhan Temanggung 2021</h5>
                    <p>Keterangan :
                </b></p>
                <input type="hidden" value="<?php echo $jmlSudahVaksin1; ?>" name="jmlSudahVaksin1" id="jmlSudahVaksin1">
                <input type="hidden" value="<?php echo $jmlSudahVaksin2; ?>" name="jmlSudahVaksin2" id="jmlSudahVaksin2">
                <input type="hidden" value="<?php echo $jmlBelumVaksin; ?>" name="jmlBelumVaksin" id="jmlBelumVaksin">
                <li class="list-group-item fist-item">
                    <span class="label label-success">*</span> Jumlah Penduduk Sudah Vaksin
                </li>
                <li class="list-group-item">

                    <span class="label label-danger">*</span> Jumlah Penduduk Belum Vaksin
                </li>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Data Capaian Vaksin Per Kecamatan </h5>
            </div>
            <div class="ibox-content">
                <canvas id="polarChart" width="300" height="300"></canvas>
                <b>
                    <h5>Capaian Vaksin Per Kecamatan (Sudah Vaksin)</h5>
                    <p>Keterangan :
                </b></p>
                <li class="list-group-item fist-item">
                    <span class="label label-success">*</span>
                </li>
                <li class="list-group-item">

                    <span class="label label-danger">*</span> Jumlah Penduduk Belum Vaksin Per Kecamatan
                </li>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Data Belum Vaksin Per Kecamatan </h5>
            </div>
            <div class="ibox-content">
                <canvas id="polarChart1" width="300" height="300"></canvas>
                <b>
                    <h5>Capaian Vaksin Per Kecamatan (Belum Vaksin)</h5>
                    <p>Keterangan :
                </b></p>
                <li class="list-group-item fist-item">
                    <span class="label label-success">*</span> Jumlah Penduduk Belum Vaksin Per Kecamatan
                </li>
            </div>
        </div>
    </div>



    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Capaian Vaksin Per Desa</h5>
                </div>
                <div class="ibox-content">
                    <div id="ct-chart4" class="ct-perfect-fourth"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Belum Vaksin Per Desa</h5>
                </div>
                <div class="ibox-content">
                    <div id="ct-chart5" class="ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- GITTER -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/toastr/toastr.min.js"></script>

    <!-- Chartist -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/chartist/chartist.min.js"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            }, 1300);

            //Flot Bar Chart

            // var jmlBelumVaksin = ParseInt($('#jmlBelumVaksin').val());
            // var jmlSudahVaksin1 = ParseInt($('#jmlSudahVaksin1').val());
            // var jmlSudahVaksin2 = ParseInt($('#jmlSudahVaksin2').val());
            var barOptions = {
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.6,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.8
                            }, {
                                opacity: 0.8
                            }]
                        }
                    }
                },
                xaxis: {
                    tickDecimals: 0
                },
                colors: ["#1ab394"],
                grid: {
                    color: "#999999",
                    hoverable: true,
                    clickable: true,
                    tickColor: "#D4D4D4",
                    borderWidth: 0
                },
                legend: {
                    show: false
                },
                tooltip: true,
                tooltipOpts: {
                    content: "x: %x, y: %y"
                }
            };
            
            var barData = {
                label: "bar",
                data: [
                    ["aaaa", 2],
                    [2, 3],
                    [3, 4],
                    [4, 5],
                    [5, 6],
                    [6, 7]
                ]
            };
            $.plot($("#flot_bar_chart"), [barData], barOptions);



            var data1 = [
                [0, 4],
                [1, 8],
                [2, 5],
                [3, 10],
                [4, 4],
                [5, 16],
                [6, 5],
                [7, 11],
                [8, 6],
                [9, 11],
                [10, 30],
                [11, 10],
                [12, 13],
                [13, 4],
                [14, 3],
                [15, 3],
                [16, 6]
            ];
            var data2 = [
                [0, 1],
                [1, 0],
                [2, 2],
                [3, 0],
                [4, 1],
                [5, 3],
                [6, 1],
                [7, 5],
                [8, 2],
                [9, 3],
                [10, 2],
                [11, 1],
                [12, 0],
                [13, 2],
                [14, 8],
                [15, 0],
                [16, 0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1c84c6", "#ed5565"],
                xaxis: {},
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            });

            // var jmlBelumVaksin = ParseInt($('#jmlBelumVaksin').val());
            // var jmlSudahVaksin1 = ParseInt($('#jmlSudahVaksin1').val());
            // var jmlSudahVaksin2 = ParseInt($('#jmlSudahVaksin2').val());
            var doughnutData = [

                {
                    value:3,
                    color: "#1c84c6",
                    highlight: "#73A7D6",
                    label: "Sudah Vaksin"
                },
              
                {
                    value: 1,
                    color: "#ed5565",
                    highlight: "#F08580",
                    label: "Belum Vaksin"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [{
                    value: 80,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "Kecamatan Ngadirejo"
                },
                {
                    value: 10,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 150,
                    color: "#73A7D6",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 170,
                    color: "#23AD42 ",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 170,
                    color: "#D97DE1",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 20,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Kecamatan Parakan"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

            //js yang ke 2
            var polarData1 = [{
                    value: 80,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "Kecamatan Ngadirejo"
                },
                {
                    value: 10,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 150,
                    color: "#73A7D6",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 170,
                    color: "#23AD42 ",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 170,
                    color: "#D97DE1",
                    highlight: "#1ab394",
                    label: "Kecamatan Tembarak"
                },
                {
                    value: 20,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Kecamatan Parakan"
                }
            ];

            var polarOptions1 = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart1").getContext("2d");
            var Polarchart1 = new Chart(ctx).PolarArea(polarData1, polarOptions1);

        });

        // data perdesa1
        new Chartist.Bar('#ct-chart4', {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            series: [
                [5, 4, 3, 7, 5, 10, 3],
                [3, 2, 9, 5, 4, 6, 4]
            ]
        }, {
            seriesBarDistance: 10,
            reverseData: true,
            horizontalBars: true,
            axisY: {
                offset: 70
            }
        });

        // data perdesa2
        new Chartist.Bar('#ct-chart5', {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            series: [
                [5, 4, 3, 7, 5, 10, 3],
                [3, 2, 9, 5, 4, 6, 4]
            ]
        }, {
            seriesBarDistance: 10,
            reverseData: true,
            horizontalBars: true,
            axisY: {
                offset: 70
            }
        });
    </script>