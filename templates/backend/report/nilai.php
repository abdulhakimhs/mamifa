<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Laporan Nilai TA</h5>

			<div class="widget-toolbar">

				<a href="#" data-action="fullscreen" class="orange2">
					<i class="ace-icon fa fa-expand"></i>
				</a>

				<a href="javascript:void(0)" data-action="reload">
					<i class="ace-icon fa fa-refresh"></i>
				</a>

				<a href="#" data-action="collapse">
					<i class="ace-icon fa fa-chevron-up"></i>
				</a>

				<a href="#" data-action="close">
					<i class="ace-icon fa fa-times"></i>
				</a>
			</div>
		</div>

		<div class="widget-body">
			<form autocomplete="off" action="<?= site_url('admin/report/nilai_ta') ?>" method="POST">
				<div class="widget-main">
		            <div class="row">
                        <div class="col-lg-3">
	                        <div class="form-group">
	                            <label><b>Periode Tgl</b></label>
	                            <div class="row">
	                                <div class="col-xs-8 col-sm-11">
	                                    <div class="input-group">
	                                        <input class="form-control date-picker" name="periode_tgl" id="ftgl" type="text" data-date-format="yyyy-mm-dd" required />
	                                        <span class="input-group-addon">
	                                            <i class="fa fa-calendar bigger-110"></i>
	                                        </span>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>  
	                    </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Jenis Pelatihan</b></label>
                                <select name="jenis_pelatihan" id="jenis_pelatihan" class="form-control" required>
                                    <option value="">-Pilih Pelatihan-</option>
                                    <?php foreach ($pelatihan as $p) : ?>
                                        <option value="<?= $p['pelatihan_id'] ?>"><?= $p['jenis_pelatihan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
		            </div>
		            <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fa fa-download"></i> Download Data</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Laporan Nilai Mitra</h5>

			<div class="widget-toolbar">

				<a href="#" data-action="fullscreen" class="orange2">
					<i class="ace-icon fa fa-expand"></i>
				</a>

				<a href="javascript:void(0)" data-action="reload">
					<i class="ace-icon fa fa-refresh"></i>
				</a>

				<a href="#" data-action="collapse">
					<i class="ace-icon fa fa-chevron-up"></i>
				</a>

				<a href="#" data-action="close">
					<i class="ace-icon fa fa-times"></i>
				</a>
			</div>
		</div>

		<div class="widget-body">
			<form autocomplete="off" action="<?= site_url('admin/report/nilai_mitra') ?>" method="POST">
				<div class="widget-main">
		            <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Tahun</b></label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="all">All</option>
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
                                <label class="form-control-label"><b>Pilih Bulan</b></label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="all">All</option>
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
                                <select name="jenis_pelatihan_m" id="jenis_pelatihan_m" class="form-control" required>
                                    <option value="">-Pilih Pelatihan-</option>
                                    <?php foreach ($pelatihan as $p) : ?>
                                        <option value="<?= $p['pelatihan_id'] ?>"><?= $p['jenis_pelatihan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
		            </div>
		            <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fa fa-download"></i> Download Data</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.date-picker').datepicker({
	        autoclose: true,
	        todayHighlight: true
	    });
	})
</script>