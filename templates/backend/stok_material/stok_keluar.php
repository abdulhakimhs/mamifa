<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
</style>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label"><b>Pilih Target Tahun</b></label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">-Pilih Tahun-</option>
                <option value="<?= date('Y', strtotime('-2 years')) ?>"><?= date('Y', strtotime('-2 years')) ?></option>
                <option value="<?= date('Y', strtotime('-1 years')) ?>"><?= date('Y', strtotime('-1 years')) ?></option>
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                <option value="<?= date('Y', strtotime('+1 years')) ?>"><?= date('Y', strtotime('+1 years')) ?></option>
                <option value="<?= date('Y', strtotime('+2 years')) ?>"><?= date('Y', strtotime('+2 years')) ?></option>
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
</div>

<div class="row">
    <div class="col-lg-6">
        <h4 id="judul">Stok Material Keluar</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #6FB3E0; color: #fff;">MATERIAL</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody id="material">
                    <?php foreach ($material as $m) : ?>
                        <?php if ($m['jenis'] == 'MATERIAL') {  ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['material'] ?></td>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['jumlah_m'] ?></td>
                            <tr>
                        <?php } ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>
                        <td style="vertical-align : middle;text-align:center; text-decoration: none;"><b id="total_material"><?= $total['total_m'] ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <h4>&nbsp</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #87B87F; color: #fff;">MATERIAL HABIS PAKAI</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody id="material_habis">
                    <?php foreach ($material as $m) : ?>
                        <?php if ($m['jenis'] == 'HABIS PAKAI') {  ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['material'] ?></td>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['jumlah_mhp'] ?></td>
                            <tr>
                        <?php } ?>
                    <?php endforeach; ?>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>
                        <td style="vertical-align : middle;text-align:center; text-decoration: none;"><b id="total_material_habis"><?= $total['total_mhp'] ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$("#bulan").change(function(){
    ambil_data();
});

$("#tahun").change(function(){
    ambil_data();
});

function ambil_data(){
    let bulan = $("#bulan").val() == '' ? 'all' : $("#bulan").val();
    let tahun = $("#tahun").val() == '' ? 'all' : $("#tahun").val();

    let title_bulan = bulan == 'all' ? 'Semua Bulan' : $("#bulan :selected").text();
    let title_tahun = tahun == 'all' ? 'Semua Tahun' : $("#tahun :selected").text();

    $.ajax({
        url : "<?php echo site_url('admin/stok_material/ajax_get/')?>"+ bulan +"/"+ tahun,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            let isi_material = '';
            let isi_material_habis = '';

            for (let i = 0; i < data.material.length; i++) {
                if(data.material[i].jenis == 'MATERIAL') {
                    isi_material += '<tr>'+
                            '<td style="vertical-align : middle;text-align:center;">'+ data.material[i].material +'</td>'+
                            '<td style="vertical-align : middle;text-align:center;">'+ data.material[i].jumlah_m +'</td>'+
                        '<tr>';
                } else {
                    isi_material_habis += '<tr>'+
                            '<td style="vertical-align : middle;text-align:center;">'+ data.material[i].material +'</td>'+
                            '<td style="vertical-align : middle;text-align:center;">'+ data.material[i].jumlah_mhp +'</td>'+
                        '<tr>';
                }
            }

            isi_material += '<tr>'+
                        '<td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>'+
                        '<td style="vertical-align : middle;text-align:center; text-decoration: none;"><b id="total_material"><?= $total['total_m'] ?></b></td>'+
                    '</tr>';

            isi_material_habis += '<tr>'+
                        '<td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>'+
                        '<td style="vertical-align : middle;text-align:center; text-decoration: none;"><b id="total_material_habis"><?= $total['total_mhp'] ?></b></td>'+
                    '</tr>';

            $("#material").html(isi_material);
            $("#material_habis").html(isi_material_habis);
            $("#total_material").text(data.total.total_m == null ? 0 : data.total.total_m);
            $("#total_material_habis").text(data.total.total_mhp == null ? 0 : data.total.total_mhp);

            if(title_bulan == 'Semua Bulan' && title_tahun == 'Semua Tahun') {
                $('#judul').text('Stok Material Keluar');
            } else {
                $('#judul').text('Stok Material '+ title_bulan +' '+ title_tahun);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};
</script>