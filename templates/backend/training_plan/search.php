<style type="text/css">
	.table tr th {
		text-align: center;
		vertical-align: middle !important;
	}
	.table tr td {
		text-align: center;
		vertical-align: middle !important;
	}
	@media (min-width: 768px) {
      .modal-xl {
        width: 90%;
        max-width:1400px;
      }
    }
</style>
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Search Training Plan Fiber Academy Pekalongan</h5>
			<div class="widget-toolbar">

				<a href="#" data-action="fullscreen" class="orange2">
					<i class="ace-icon fa fa-expand"></i>
				</a>

				<a href="javascript:void(0)" onclick="reload_table()" data-action="reload">
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
			<div class="widget-main">
				<div id="pesan" style="margin: 10px 5px;"></div>
				<form autocomplete="off" method="POST" action="<?= site_url('admin/training_plan/search_plan') ?>">
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
	                            <label><b>Pilih Tanggal Awal</b></label>
	                            <div class="row">
	                                <div class="col-xs-8 col-sm-11">
	                                    <div class="input-group">
	                                        <input class="form-control date-picker" name="ftgl_awal" id="ftgl_awal" type="text" data-date-format="yyyy-mm-dd" autocomplete="false" />
											<span class="input-group-addon">
	                                            <i class="fa fa-calendar bigger-110"></i>
	                                        </span>
	                                		<!-- <span class="help-block"></span> -->
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
	                            <label><b>Pilih Tanggal Akhir</b></label>
	                            <div class="row">
	                                <div class="col-xs-8 col-sm-11">
	                                    <div class="input-group">
											<input class="form-control date-picker" name="ftgl_akhir" id="ftgl_akhir" type="text" data-date-format="yyyy-mm-dd" autocomplete="false" readonly />
	                                        <span class="input-group-addon">
	                                            <i class="fa fa-calendar bigger-110"></i>
	                                        </span>
											<!-- <span class="help-block"></span> -->
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
						</div>
					</div>
					<button type="submit" name="search" class="btn btn-sm btn-danger"><i class="fa fa-search"></i> Show Plan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.date-picker').datepicker({
	        autoclose: true,
	        todayHighlight: true
	    });

		$('#ftgl_awal').change(function() {
			var tglAkhir = $('#ftgl_awal').datepicker('getDate', '+4d'); 
			tglAkhir.setDate(tglAkhir.getDate()+4); 
			$('#ftgl_akhir').datepicker('setDate', tglAkhir);
		});
	});
</script>