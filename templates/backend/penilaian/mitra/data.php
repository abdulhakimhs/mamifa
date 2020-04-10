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
            <select name="bulan" id="bulan" class="form-control">
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
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Jenis Pelatihan</b></label>
            <select name="jenis_pelatihan" id="jenis_pelatihan" class="form-control">
                <option value="">-Pilih Pelatihan-</option>
                <?php foreach ($jenis_pelatihan as $jp) : ?>
                    <option value="<?= $jp['pelatihan_id'] ?>"><?= $jp['jenis_pelatihan'] ?></option>
                <?php endforeach; ?>
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
                        <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">MITRA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">TOTAL NAKER</th>
                        <th colspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;" id="tabel_judul">SEMUA PELATIHAN</th>
                    </tr>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">STAFF</th>
                        <th style="vertical-align : middle;text-align:center; background: #00A65A; color: #fff;">TL</th>
                    </tr>
                </thead>
                <tbody id="tabel_mitra">
                    <?php foreach ($tabel_penilaian as $tp) : ?>
                        <tr>
                            <td style="vertical-align : middle;text-align:center;"><?= $tp['nama_mitra'] ?></td>
                            <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show"><?= $tp['total_naker'] ?></a></td>
                            <td style="vertical-align : middle;text-align:center;"><?= $tp['staff'] ?></td>
                            <td style="vertical-align : middle;text-align:center;"><?= $tp['tl'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show"><?= $tabel_penilaian_total['total_naker'] ?></a></td>
                        <td style="vertical-align : middle;text-align:center;"><?= $tabel_penilaian_total['staff'] ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?= $tabel_penilaian_total['tl'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6" style="height: 350px">
        <canvas id="canvas"></canvas>
    </div>
</div>

<script>
    let label = [];
    let staff = [];
    let tl = [];

    let color = Chart.helpers.color;
    let barChartData = {
        labels: label,
        datasets: [{
            label: 'STAFF',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: staff
        }, {
            label: 'TL',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: tl
        }]

    };

    $(document).ready(function(){
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/penilaian/mitra/ambil_grafik')?>",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                for (let i = 0; i < data.isi.length; i++) {
                    label.push(data.isi[i].nama_mitra);
                    staff.push(data.isi[i].staff);
                    tl.push(data.isi[i].tl);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });

    $(window).load(function(){
        setTimeout(function(){
            let ctx = document.getElementById('canvas').getContext('2d');
            grafik = new Chart(ctx, {
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
                        text: 'Target SEMUA PELATIHAN FA (Mitra) Pekalongan All'
                    }
                }
            });
        }, 1000);
    });

    $("#bulan").change(function(){
        ambil_data();
    });

    $("#tahun").change(function(){
        ambil_data();
    });

    $("#jenis_pelatihan").change(function(){
        ambil_data();
    });

    function ambil_data(){
        let bulan = $("#bulan").val() == '' ? 'all' : $("#bulan").val();
        let tahun = $("#tahun").val() == '' ? 'all' : $("#tahun").val();
        let jenis_pelatihan = $("#jenis_pelatihan").val() == '' ? 'all' : $("#jenis_pelatihan").val();

        let title_bulan = bulan == 'all' ? '' : $("#bulan :selected").text();
        let title_tahun = tahun == 'all' ? '' : $("#tahun :selected").text();
        let tabel = jenis_pelatihan == 'all' ? 'SEMUA PELATIHAN' : $("#jenis_pelatihan :selected").text();

        $.ajax({
            url : "<?php echo site_url('admin/penilaian/mitra/ambil_grafik/')?>"+ bulan +"/"+ tahun +"/"+ jenis_pelatihan,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                let isi = '';
                let label_new = [];
                let staff_new = [];
                let tl_new = [];

                for (let i = 0; i < data.isi.length; i++) {
                    isi += '<tr>'+
                        '<td style="vertical-align : middle;text-align:center;">'+ data.isi[i].nama_mitra +'</td>'+
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">'+ data.isi[i].total_naker +'</a></td>'+
                        '<td style="vertical-align : middle;text-align:center;">'+ data.isi[i].staff +'</td>'+
                        '<td style="vertical-align : middle;text-align:center;">'+ data.isi[i].tl +'</td>'+
                    '</tr>';
                    
                    label_new.push(data.isi[i].nama_mitra);
                    staff_new.push(data.isi[i].staff);
                    tl_new.push(data.isi[i].tl);
                }

                isi += '<tr>'+
                    '<td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>'+
                    '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="penilaian/show">'+ data.total.total_naker +'</a></td>'+
                    '<td style="vertical-align : middle;text-align:center;">'+ data.total.staff +'</td>'+
                    '<td style="vertical-align : middle;text-align:center;">'+ data.total.tl +'</td>'+
                '</tr>';

                $("#tabel_mitra").html(isi);

                barChartData.labels = label_new;
                barChartData.datasets[0].data = staff_new;
                barChartData.datasets[1].data = tl_new;

                $("#tabel_judul").text(tabel);

                if(title_bulan == '' && title_tahun == '' && tabel == 'SEMUA PELATIHAN') {
                    grafik.options.title.text = 'Target SEMUA PELATIHAN FA (Mitra) Pekalongan All';
                } else {
                    grafik.options.title.text = 'Target '+ tabel +' FA (Mitra) Pekalongan '+ title_bulan +' '+ title_tahun;
                }
                grafik.data = barChartData;
                grafik.update();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    };
</script>