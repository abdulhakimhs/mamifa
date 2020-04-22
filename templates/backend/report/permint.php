<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Download Permintaan Material</h5>

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
			<form autocomplete="off" action="<?= site_url('admin/report/permint') ?>" method="POST">
				<div class="widget-main">
		            <div class="row">
                        <div class="col-lg-3">
	                        <div class="form-group">
	                            <label><b>Periode Tgl Material Masuk</b></label>
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
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>Pemohon</b></label>
                                <input type="text" name="pemohon" class="form-control" value="BENNY TARWIDI">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>Mengetahui</b></label>
                                <input type="text" name="mengetahui" class="form-control" value="ISKHANDARSYAH">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>Menyetujui</b></label>
                                <input type="text" name="menyetujui" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>Petugas Gudang</b></label>
                                <input type="text" name="petugas_gudang" class="form-control" value="MOHAMMAD ISMANU">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>NIK Pemohon</b></label>
                                <input type="text" name="nik_pemohon" class="form-control" value="93153453">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>NIK Mengetahui</b></label>
                                <input type="text" name="nik_mengetahui" class="form-control" value="955145">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>NIK Menyetujui</b></label>
                                <input type="text" name="nik_menyetujui" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><b>NIK Petugas Gudang</b></label>
                                <input type="text" name="nik_petugas_gudang" class="form-control" value="89157222">
                                <span class="help-block"></span>
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