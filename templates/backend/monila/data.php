<style type="text/css">
	@media (min-width: 768px) {
      .modal-xl {
        width: 90%;
        max-width:1000px;
      }
    }
</style>
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Data Monila</h5>
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
	            <table id="table" class="table table-bordered table-hover table-sm text-nowrap" cellspacing="0" width="100%">
	                <thead>
		                <tr>
                            <th width="10">NO</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Laporan</th>
                            <th>Lokasi Temuan</th>
                            <th>Koordinat/ODP</th>
                            <th>Status</th>
			                <th width="100"><i class="fa fa-gear"></i></th>
		                </tr>
		            </thead>
		            <tbody>
		            </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var save_method;
var table;
var base_url = '<?php echo base_url();?>';
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/monila/get_ajax') ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });
 
});

function detail(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/monila/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.monila_id);
			$('[name="nik"]').val(data.nik);
			$('[name="nama_lengkap"]').val(data.nama_lengkap);
            $('[name="jenis_lap_id"]').val(data.jenis_laporan);
            $('[name="lokasi_temuan"]').val(data.lokasi_temuan);
			$('[name="odp_koordinat"]').val(data.odp_koordinat);
			$('[name="saran_perbaikan"]').val(data.saran_perbaikan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Follow Up'); // Set title to Bootstrap modal title
			
			$('#photo-preview div').html('<img src="'+base_url+'assets/backend/images/file_evident/'+data.file_evident+'" class="img-responsive">'); // show photo
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    // if(save_method == 'add') {
    //     url = "<?php echo site_url('admin/monila/ajax_add')?>";
    // } else {
    //     url = "<?php echo site_url('admin/monila/ajax_update')?>";
	// }
	
	url = "<?php echo site_url('admin/monila/ajax_update')?>";
 
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
                $('#modal_form').modal('hide');
                reload_table();
                document.getElementById('pesan').innerHTML = data.pesan;
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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
            url : "<?php echo site_url('admin/monila/ajax_delete')?>/"+id,
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
                <h3 class="modal-title">Follow Up Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group" id="photo-preview">
								<label class="control-label col-md-3">Photo</label>
								<div class="col-md-9">
									(No photo)
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">NIK</label>
									<div class="col-md-9">
										<input name="nik" class="form-control" type="text" readonly>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Nama Lengkap</label>
									<div class="col-md-9">
										<input name="nama_lengkap" class="form-control" type="text" readonly>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Jenis Laporan</label>
									<div class="col-md-9">
										<input name="jenis_lap_id" class="form-control" type="text" readonly>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Lokasi Temuan</label>
									<div class="col-md-9">
										<input name="lokasi_temuan" class="form-control" type="text" readonly>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">ODP</label>
									<div class="col-md-9">
										<input name="odp_koordinat" class="form-control" type="text" readonly>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Saran Perbaikan</label>
									<div class="col-md-9">
										<textarea name="saran_perbaikan" class="form-control" readonly></textarea>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Status Monila</label>
									<div class="col-md-9">
										<select name="status_monila" class="form-control">
											<option value="">-Pilih Status-</option>
											<option value="1">SUDAH DITERIMA</option>
										</select>
										<span class="help-block"></span>
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

</script>