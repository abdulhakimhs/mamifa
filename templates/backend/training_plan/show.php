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
											<input class="form-control date-picker" name="ftgl_akhir" id="ftgl_akhir" type="text" data-date-format="yyyy-mm-dd" autocomplete="false" disabled />
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
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Training Plan Fiber Academy Pekalongan <?= date_indo($this->input->post('ftgl_awal')) ?> - <?= date_indo(date('Y-m-d',strtotime($this->input->post('ftgl_awal') . "+4 days"))) ?></h5>
			<div class="widget-toolbar">
				<a href="javascript:void(0)" onclick="add_plan()">
					<i class="ace-icon fa fa-plus"></i>
				</a>
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
				<div class="table-responsive">
					<table class="table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th rowspan="3" valign="center">NO</th>
								<th rowspan="3">NAMA PENGAJAR</th>
								<th rowspan="3">JENIS PELATIHAN</th>
								<th rowspan="3">NAME OF TRAINING</th>
								<th colspan="4">TGL</th>
								<th colspan="6">PARTICIPANTS</th>
								<th colspan="5">BULAN TAHUN</th>
								<th rowspan="3">TOTAL PESERTA</th>
								<th rowspan="3"><i class="fa fa-gear"></i></th>
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
								<th>PELATIHAN</th>
								<th>BREVET PRAKTEK DAN ONLINE</th>
								<th>PELATIHAN</th>
								<th>NAMA MITRA</th>
								<th>27</th>
								<th>28</th>
								<th>29</th>
								<th>30</th>
								<th>31</th>
							</tr>
						</thead>
						<tbody id="tabel_trainingplan">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var save_method;

$(document).ready(function() {
	reload_table();
});
	
function add_plan()
{
    save_method = 'add';
	$('#pesan-modal').empty();
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.input-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Add Plan');
}

function detail(id)
{
    save_method = 'update';
	$('#pesan-modal').empty();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.input-group').removeClass('has-error'); // clear error class date
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/training_plan/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.training_plan_id);
			$('[name="ftgl_awal"]').val(data.tgl_awal);
			$('[name="ftgl_akhir"]').val(data.tgl_akhir);
			$('[name="mitra"]').val(data.mitra_id);
			$('[name="jenis_pelatihan"]').val(data.pelatihan_id);
			$('[name="name_of_training"]').val(data.not_id);
			$('[name="ta_bop"]').val(data.ta_bop);
			$('[name="ta_pelatihan"]').val(data.ta_pelatihan);
			$('[name="mitra_pelatihan"]').val(data.mitra_pelatihan);
			$('[name="nama_mitra"]').val(data.nama_mitra);
			data.staff_teknisi == 0 ? '' : $('[name="staff_teknisi"]').prop('checked', true);
			data.team_leader == 0 ? '' : $('[name="team_leader"]').prop('checked', true);
			data.officer == 0 ? '' : $('[name="officer"]').prop('checked', true);
			data.site_manager == 0 ? '' : $('[name="site_manager"]').prop('checked', true);
			data.mgr == 0 ? '' : $('[name="mgr"]').prop('checked', true);
			data.mitra == 0 ? '' : $('[name="mitra"]').prop('checked', true);
			data.senin == 0 ? '' : $('[name="senin"]').prop('checked', true);
			data.selasa == 0 ? '' : $('[name="selasa"]').prop('checked', true);
			data.rabu == 0 ? '' : $('[name="rabu"]').prop('checked', true);
			data.kamis == 0 ? '' : $('[name="kamis"]').prop('checked', true);
			data.jumat == 0 ? '' : $('[name="jumat"]').prop('checked', true);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Ubah Data'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/training_plan/ajax_get/'.$this->input->post('ftgl_awal'))?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			var isi = '';
			var no = 1;
			var total = 0;
			for(var i=0; i<data.length; i++){
				total += (data[i].ta_bop == null ? 0 : parseInt(data[i].ta_bop));
				total += (data[i].ta_pelatihan == null ? 0 : parseInt(data[i].ta_pelatihan));
				total += (data[i].mitra_pelatihan == null ? 0 : parseInt(data[i].mitra_pelatihan));
				isi += '<tr>'+
							'<td>'+ no +'</td>'+
							'<td>'+ data[i].nama_pengajar +'</td>'+
							'<td>'+ data[i].jenis_pelatihan +'</td>'+
							'<td>'+ data[i].name_of_training +'</td>'+
							'<td>'+ (data[i].ta_pelatihan == null ? '' : data[i].ta_pelatihan) +'</td>'+
							'<td>'+ (data[i].ta_bop == null ? '' : data[i].ta_bop) +'</td>'+
							'<td>'+ (data[i].mitra_pelatihan == null ? '' : data[i].mitra_pelatihan) +'</td>'+
							'<td>'+ (data[i].nama_mitra == null ? '' : data[i].nama_mitra) +'</td>'+
							'<td>'+ (data[i].staff_teknisi == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].team_leader == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].officer == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].site_manager == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].mgr == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].mitra == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].senin == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].selasa == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].rabu == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].kamis == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ (data[i].jumat == 0 ? '' : '<i class="fa fa-check"></i>') +'</td>'+
							'<td>'+ total +'</td>'+
							'<td><a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('+ "'" + data[i].training_plan_id + "'" +')"><i class="fa fa-edit"></i></a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data(' + "'" + data[i].training_plan_id + "'" + ')"><i class="fa fa-trash"></i></a></td>'+
						'</tr>';
				no++;
				total = 0;
			}
			$('#tabel_trainingplan').html(isi);
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('admin/training_plan/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/training_plan/ajax_update')?>";
	}
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                document.getElementById('pesan-modal').innerHTML = data.pesan;
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
					if(data.inputerror[i] == 'ftgl_awal' || data.inputerror[i] == 'ftgl_akhir') {
						$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    	// $('[name="'+data.inputerror[i]+'"]').prev().text(data.error_string[i]); //select span help-block class set text error string
					} else {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    	$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_data(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/training_plan/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                document.getElementById('pesan').innerHTML = data.pesan;
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
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
						<div id="pesan-modal" style="margin: 10px 5px;"></div>
                    	<div class="row">
                    		<div class="col-lg-3">
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Jenis Pelatihan</b></label>
		                            <div class="col-md-9">
		                                <select name="jenis_pelatihan" class="form-control" required>
		                                	<option value="">-Pilih Jenis Pelatihan-</option>
											<?php foreach ($pelatihan as $p) : ?>
		                                		<option value="<?= $p['pelatihan_id'] ?>"><?= $p['jenis_pelatihan'] ?></option>
											<?php endforeach; ?>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Name of Training</b></label>
		                            <div class="col-md-9">
		                                <select name="name_of_training" class="form-control" required>
		                                	<option value="">-Pilih-</option>
											<?php foreach ($training as $t) : ?>
		                                		<option value="<?= $t['not_id'] ?>"><?= $t['name_of_training'] ?></option>
											<?php endforeach; ?>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Nama Pengajar</b></label>
		                            <div class="col-md-9">
		                                <input type="text" name="nama_pengajar" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
                    		</div>
                    		<div class="col-lg-3">
                    			<div class="form-group">
		                            <label class="control-label col-md-3" style="border-bottom: 1px solid #eee; font-size: 20px;"><b>TA</b></label>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Pelatihan</b></label>
		                            <div class="col-md-9">
		                                <input type="number" name="ta_pelatihan" class="form-control">
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3"><b>Brevet, Praktek, Online</b></label>
		                            <div class="col-md-9">
		                                <input type="number" name="ta_bop" class="form-control">
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
		                                <select name="nama_mitra" class="form-control" required>
											<option value="">-Pilih Mitra-</option>
		                                </select>
		                                <span class="help-block"></span>
		                            </div>
		                        </div>
                    		</div>
                    		<div class="col-lg-3">
                    			<div class="control-group">
									<label class="control-label bolder"><b>Participants</b></label>

									<div class="checkbox">
										<label class="block">
											<input name="staff_teknisi" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> Staff / Teknisi</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="team_leader" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> Team Leader</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="officer" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> Off-1 / Off-2</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="site_manager" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> Site Manager</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="mgr" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> MGR</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="mitra" type="checkbox" class="ace input-lg" value="1" />
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
		                                		<!-- <span class="help-block"></span> -->
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
												<!-- <span class="help-block"></span> -->
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
                    			<div class="control-group">
									<label class="control-label bolder"><b>Hari</b></label>

									<div class="checkbox">
										<label class="block">
											<input name="senin" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> SENIN</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="selasa" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> SELASA</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="rabu" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> RABU</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="kamis" type="checkbox" class="ace input-lg" value="1" />
											<span class="lbl bigger-120"> KAMIS</span>
										</label>
									</div>
									<div class="checkbox">
										<label class="block">
											<input name="jumat" type="checkbox" class="ace input-lg" value="1" />
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

		$('#ftgl_awal').change(function() {
			var tglAkhir = $('#ftgl_awal').datepicker('getDate', '+4d'); 
			tglAkhir.setDate(tglAkhir.getDate()+4); 
			$('#ftgl_akhir').datepicker('setDate', tglAkhir);
		});
	});
</script>