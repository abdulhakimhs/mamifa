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
            <select name="tahun" id="tahun" class="form-control" required>
                <option value="">-Pilih Tahun-</option>
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                <option value="<?= date('Y', strtotime('+1 years')) ?>"><?= date('Y', strtotime('+1 years')) ?></option>
                <option value="<?= date('Y', strtotime('+2 years')) ?>"><?= date('Y', strtotime('+2 years')) ?></option>
                <option value="<?= date('Y', strtotime('+3 years')) ?>"><?= date('Y', strtotime('+3 years')) ?></option>
                <option value="<?= date('Y', strtotime('+4 years')) ?>"><?= date('Y', strtotime('+4 years')) ?></option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Target Bulan</b></label>
            <select name="bulan" id="bulan" class="form-control" required>
                <option value="">-Pilih Bulan-</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
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
    let label_ta = [];
    let staff_ta = [];
    let tl_ta = [];
    let sm_ta = [];
    let m_ta = [];

    let label_mitra = [];
    let staff_mitra = [];
    let tl_mitra = [];

    $(document).ready(function(){
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_ta')?>",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                for (let i = 0; i < data.length; i++) {
                    label_ta.push(data[i].jenis_pelatihan);
                    staff_ta.push(data[i].staff);
                    tl_ta.push(data[i].tl);
                    sm_ta.push(data[i].sm);
                    m_ta.push(data[i].m);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_mitra')?>",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                for (let i = 0; i < data.length; i++) {
                    label_mitra.push(data[i].jenis_pelatihan);
                    staff_mitra.push(data[i].staff);
                    tl_mitra.push(data[i].tl);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });

    var color = Chart.helpers.color;
    var barChartData = {
        labels: label_ta,
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: staff_ta
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: tl_ta
        }, {
            label: 'SM',
            backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
            borderColor: window.chartColors.yellow,
            borderWidth: 1,
            data: sm_ta
        }, {
            label: 'MANAGER',
            backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
            borderColor: window.chartColors.green,
            borderWidth: 1,
            data: m_ta
        }]
    };

    var barChartDataM = {
        labels: label_mitra,
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: staff_mitra
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: tl_mitra
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        punya_ta = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    yAxes:[{
                        ticks: {
                            beginAtZero:true
                        }
                    }],
                },
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
        punya_mitra = new Chart(ctxm, {
            type: 'bar',
            data: barChartDataM,
            options: {
                scales: {
                    yAxes:[{
                        ticks: {
                            beginAtZero:true
                        }
                    }],
                },
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

    $("#tahun").change(function(){
        let bulan = $("#bulan").val() == '' ? 'all' : $("#bulan").val();
        let tahun = $("#tahun").val();

        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_ta/')?>"+ bulan +"/"+ tahun,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                for (let i = 0; i < data.length; i++) {
                    label_ta.pop();
                    staff_ta.pop();
                    tl_ta.pop();
                    sm_ta.pop();
                    m_ta.pop();
                }

                for (let i = 0; i < data.length; i++) {
                    label_ta.push(data[i].jenis_pelatihan);
                    staff_ta.push(data[i].staff);
                    tl_ta.push(data[i].tl);
                    sm_ta.push(data[i].sm);
                    m_ta.push(data[i].m);
                }

                punya_ta.data = barChartData;
                punya_ta.update();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_mitra/')?>"+ bulan +"/"+ tahun,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                for (let i = 0; i < data.length; i++) {
                    label_mitra.pop();
                    staff_mitra.pop();
                    tl_mitra.pop();
                }

                for (let i = 0; i < data.length; i++) {
                    label_mitra.push(data[i].jenis_pelatihan);
                    staff_mitra.push(data[i].staff);
                    tl_mitra.push(data[i].tl);
                }

                punya_mitra.data = barChartDataM;
                punya_mitra.update();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });

    $("#bulan").change(function(){
        let bulan = $("#bulan").val();
        let tahun = $("#tahun").val() == '' ? 'all' : $("#tahun").val();

        // punya_ta.destroy();
        // punya_mitra.destroy();

        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_ta/')?>"+ bulan +"/"+ tahun,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                for (let i = 0; i < data.length; i++) {
                    label_ta.pop();
                    staff_ta.pop();
                    tl_ta.pop();
                    sm_ta.pop();
                    m_ta.pop();
                }

                for (let i = 0; i < data.length; i++) {
                    label_ta.push(data[i].jenis_pelatihan);
                    staff_ta.push(data[i].staff);
                    tl_ta.push(data[i].tl);
                    sm_ta.push(data[i].sm);
                    m_ta.push(data[i].m);
                }

                punya_ta.data = barChartData;
                punya_ta.update();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        $.ajax({
            url : "<?php echo site_url('admin/target/grafik_mitra/')?>"+ bulan +"/"+ tahun,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                for (let i = 0; i < data.length; i++) {
                    label_mitra.pop();
                    staff_mitra.pop();
                    tl_mitra.pop();
                }

                for (let i = 0; i < data.length; i++) {
                    label_mitra.push(data[i].jenis_pelatihan);
                    staff_mitra.push(data[i].staff);
                    tl_mitra.push(data[i].tl);
                }

                punya_mitra.data = barChartDataM;
                punya_mitra.update();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });
</script>