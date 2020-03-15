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
			<h5 class="widget-title">Training Plan Fiber Academy Pekalongan</h5>
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
				<button class="btn btn-square btn-danger btn-sm" onclick="add_plan()"><i class="fa fa-plus"></i> Tambah Data</button>
				<div id="pesan" style="margin: 10px 5px;"></div>
				<table class="table table-bordered" cellspacing="0" width="100%">
					<tr>
						<th rowspan="3" valign="center">NO</th>
						<th rowspan="3">KELAS</th>
						<th rowspan="3">JENIS PELATIHAN</th>
						<th rowspan="3">NAME OF TRAINING</th>
						<th colspan="4">TGL</th>
						<th colspan="6">PARTICIPANTS</th>
						<th colspan="5">BULAN TAHUN</th>
						<th rowspan="3">TOTAL PESERTA</th>
					</tr>
					<tr>
						<th colspan="2">TELKOM AKSES</th>
						<th colspan="2">MITRA</th>
						<th rowspan="2">STAFF/TEKNISI</th>
						<th rowspan="2">TEAM LEADER</th>
						<th rowspan="2">Off-1/ Off-2</th>
						<th rowspan="2">SITE MGR</th>
						<th rowspan="2">MGR</th>
						<th rowspan="2">MITRA</th>
						<th>SENIN</th>
						<th>SELASA</th>
						<th>RABU</th>
						<th>KAMIS</th>
						<th>JUMAT</th>
					</tr>
					<tr>
						<th>BREVET PRAKTEK DAN ONLINE</th>
						<th>PELATIHAN</th>
						<th>PELATIHAN</th>
						<th>NAMA MITRA</th>
						<th>27</th>
						<th>28</th>
						<th>29</th>
						<th>30</th>
						<th>31</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var save_method;
var table;
	
function add_plan()
{
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Add Plan');
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Plan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    	<div class="row">
                    		<div class="col-lg-3">
                    			<div class="form-group">
		                            <label class="control-label col-md-3"><b>Kelas</b></label>
		                            <div class="col-md-9">
		                                <select name="kelas" class="form-control">
		                                	<option value="">-Pilih Kelas-</option>
		                                	<option value="A">A</option>
		                                	<option value="B">B</option>
		                                	<option value="C">C</option>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Jenis Pelatihan</b></label>
		                            <div class="col-md-9">
		                                <select name="jenis_pelatihan" class="form-control">
		                                	<option value="">-Pilih Jenis Pelatihan-</option>
		                                	<option value="A">A</option>
		                                	<option value="B">B</option>
		                                	<option value="C">C</option>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Name of Training</b></label>
		                            <div class="col-md-9">
		                                <select name="name_of_training" class="form-control">
		                                	<option value="">-Pilih-</option>
		                                	<option value="A">A</option>
		                                	<option value="B">B</option>
		                                	<option value="C">C</option>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
                    		</div>
                    		<div class="col-lg-3">
                    			<div class="form-group">
		                            <label class="control-label col-md-3" style="border-bottom: 1px solid #eee; font-size: 20px;"><b>TA</b></label>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Brevet, Praktek, Online</b></label>
		                            <div class="col-md-9">
		                                <input type="number" name="ta_brevet" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Pelatihan</b></label>
		                            <div class="col-md-9">
		                                <input type="number" name="ta_pelatihan" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3" style="border-bottom: 1px solid #eee; font-size: 20px;"><b>MITRA</b></label>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Pelatihan</b></label>
		                            <div class="col-md-9">
		                                <input type="number" name="mitra_pelatihan" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Nama Mitra</b></label>
		                            <div class="col-md-9">
		                                <input type="text" name="nama_mitra" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
                    		</div>
                    		<div class="col-lg-3">
                    			<div class="control-group">
									<label class="control-label bolder"><b>Participants</b></label>

									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> Staff / Teknisi</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> Team Leader</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> Off-1 / Off-2</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> Site Manager</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> MGR</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> Mitra</span>
										</label>
									</div>
								</div>
                    		</div>
                    		<div class="col-lg-3">
                    			<div class="form-group">
		                            <label><b>Tanggal Awal</b></label>
		                            <div class="row">
		                                <div class="col-xs-8 col-sm-11">
		                                    <div class="input-group">
		                                        <input class="form-control date-picker" name="ftgl_awal" id="ftgl_awal" type="text" data-date-format="yyyy-mm-dd" />
		                                        <span class="input-group-addon">
		                                            <i class="fa fa-calendar bigger-110"></i>
		                                        </span>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label><b>Tanggal Akhir</b></label>
		                            <div class="row">
		                                <div class="col-xs-8 col-sm-11">
		                                    <div class="input-group">
		                                        <input class="form-control date-picker" name="ftgl_akhir" id="ftgl_akhir" type="text" data-date-format="yyyy-mm-dd" />
		                                        <span class="input-group-addon">
		                                            <i class="fa fa-calendar bigger-110"></i>
		                                        </span>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
                    			<div class="control-group">
									<label class="control-label bolder"><b>Hari</b></label>

									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> SENIN</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> SELASA</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> RABU</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> KAMIS</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
											<span class="lbl bigger-120"> JUM'AT</span>
										</label>
									</div>
								</div>
                    		</div>
                    	</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.date-picker').datepicker({
	        autoclose: true,
	        todayHighlight: true
	    });
	});
</script>