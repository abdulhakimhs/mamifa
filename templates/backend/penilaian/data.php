<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Target Tahun</b></label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">-Pilih Tahun-</option>
                <option value="2002">2020</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Target Bulan</b></label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">-Pilih Bulan-</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Jenis Pelatihan</b></label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">-Pilih Pelatihan-</option>
                <option value="01">INDIHOME NON TEKNIS</option>
                <option value="02">MULTISKILL</option>
                <option value="03">TS INDIHOME</option>
                <option value="04">SURVEY DESIGN FTTH</option>
            </select>
        </div>
    </div>
</div>
<div class="row" style="border-top: 1px solid #eee;">
    <div class="col-lg-6">
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">OPERATION</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">TOTAL NAKER</th>
                        <th colspan="4" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">INDIHOME NON TEKNIS</th>
                    </tr>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">STAFF</th>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">TL</th>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">SM</th>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">MANAGER</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">PKL</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">10</a></td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                    </tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">BTG</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">12</a></td>
                        <td style="vertical-align : middle;text-align:center;">5</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                    </tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">TEG</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">15</a></td>
                        <td style="vertical-align : middle;text-align:center;">7</td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                    </tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">SDI</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">8</a></td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                        <td style="vertical-align : middle;text-align:center;">1</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                    </tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">CCAN</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">10</a></td>
                        <td style="vertical-align : middle;text-align:center;">4</td>
                        <td style="vertical-align : middle;text-align:center;">3</td>
                        <td style="vertical-align : middle;text-align:center;">2</td>
                        <td style="vertical-align : middle;text-align:center;">1</td>
                    </tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">GRAND TOTAL</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">55</a></td>
                        <td style="vertical-align : middle;text-align:center;">17</td>
                        <td style="vertical-align : middle;text-align:center;">13</td>
                        <td style="vertical-align : middle;text-align:center;">10</td>
                        <td style="vertical-align : middle;text-align:center;">10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6" style="height: 350px">
        <canvas id="canvas"></canvas>
    </div>
</div>

<!-- <script>
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var options = {
        tooltips: {
            enabled: false
        },
        responsive: true,
        plugins: {
            datalabels: {
            formatter: (value, ctx) => {

                let datasets = ctx.chart.data.datasets;

                if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                let percentage = Math.round((value / sum) * 100) + '%';
                return percentage;
                } else {
                return percentage;
                }
            },
            color: '#fff',
            }
        }
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    10,
                    20,
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.green,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Belum',
                'Sudah',
            ]
        },
        options: options
    };

    window.onload = function() {
        var ctx = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };
</script> -->

<script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ['PKL', 'BTG', 'TEG', 'SDI', 'CCAN'],
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                3,
                5,
                7,
                3,
                4
            ]
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                3,
                2,
                3,
                2,
                3
            ]
        }, {
            label: 'SM',
            backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
            borderColor: window.chartColors.yellow,
            borderWidth: 1,
            data: [
                2,
                3,
                2,
                1,
                2
            ]
        }, {
            label: 'MANAGER',
            backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
            borderColor: window.chartColors.green,
            borderWidth: 1,
            data: [
                2,
                2,
                3,
                2,
                1
            ]
        }]

    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Pelatihan Indihome Non Teknis FA Pekalongan Januari 2020'
                }
            }
        });

    };
</script>