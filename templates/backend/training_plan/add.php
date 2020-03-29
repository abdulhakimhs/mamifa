<style type="text/css">
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
			<h5 class="widget-title">Add Training Plan Fiber Academy Pekalongan</h5>
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
				<form action="#" id="form" class="form-horizontal" autocomplete="off">
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
											<?php foreach ($mitra as $t) : ?>
		                                		<option value="<?= $t['mitra_id'] ?>"><?= $t['nama_mitra'] ?></option>
											<?php endforeach; ?>
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
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

	$("input").change(function(){
		if ($(this).attr('name') == 'nama_pengajar') {
			$(this).parent().parent().removeClass('has-error');
			$(this).parent().find('.help-block').empty();
        } else {
			$(this).parent().removeClass('has-error');
        }
	});

	$("select").change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).parent().find('.help-block').empty();
	});
});
	
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

	url = "<?php echo site_url('admin/training_plan/ajax_add')?>";
 
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
				setTimeout(function(){ $('#pesan-modal').empty(); }, 3000);
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

</script>