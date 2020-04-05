<style>
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

<div class="row">
    <div class="col-lg-12" style="height: 350px">
        <canvas id="canvas"></canvas>
    </div>
</div>
<br><br><br>
<div class="row" style="border-top: 2px solid grey;">
    <div class="col-lg-12" style="height: 350px">
        <canvas id="canvas_mitra"></canvas>
    </div>
</div>

<script>
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ['INDIHOME NON TEKNIS', 'MULTISKILL', 'CX BEHAVIOR', 'TS INDIHOME', 'SURVEY DESIGN FTTH', 'COM SKILL WASPANG', 'LEADERSHIP', 'LOGIC IP', 'PT-2 ODP SOLID', 'PENYAMBUNGAN DC'],
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                10,
                10,
                11,
                12,
                8,
                5,
                9,
                8,
                6,
                10
            ]
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                5,
                4,
                7,
                3,
                2,
                1,
                6,
                2,
                3,
                5
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
                2,
                3,
                4,
                2,
                3,
                4
            ]
        }, {
            label: 'MANAGER',
            backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
            borderColor: window.chartColors.green,
            borderWidth: 1,
            data: [
                3,
                2,
                1,
                2,
                3,
                2,
                2,
                4,
                2,
                3
            ]
        }]
    };

    var barChartDataM = {
        labels: ['INDIHOME NON TEKNIS', 'MULTISKILL', 'CX BEHAVIOR', 'TS INDIHOME', 'SURVEY DESIGN FTTH', 'COM SKILL WASPANG', 'LEADERSHIP', 'LOGIC IP', 'PT-2 ODP SOLID', 'PENYAMBUNGAN DC'],
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                10,
                10,
                11,
                12,
                8,
                5,
                9,
                8,
                6,
                10
            ]
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
                5,
                4,
                7,
                3,
                2,
                1,
                6,
                2,
                3,
                5
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
                    text: 'Pelatihan FA (TA) Pekalongan Januari 2020'
                }
            }
        });

        var ctxm = document.getElementById('canvas_mitra').getContext('2d');
        window.myBar = new Chart(ctxm, {
            type: 'bar',
            data: barChartDataM,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Pelatihan FA (MITRA) Pekalongan Januari 2020'
                }
            }
        });

    };
</script>



<!-- <style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
</style>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
    	<thead>
    		<tr>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">OPERATION</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">TOTAL NAKER</th>
                <th colspan="4" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">AMUNISI</th>
            </tr>
            <tr>
                <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">Pelatihan</th>
                <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">BREVET</th>
                <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">TEST ONLINE</th>
                <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">OJT</th>
            </tr>
    	</thead>
    	<tbody>

    	</tbody>
    </table>
</div> -->