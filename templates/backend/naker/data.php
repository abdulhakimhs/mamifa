<style type="text/css">
  @media (min-width: 768px) {
    .modal-xl {
      width: 70%;
     max-width:1200px;
    }
  }
</style>
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Data Naker</h5>
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
			<button class="btn btn-danger btn-sm" onclick="add_data()"><i class="fa fa-plus"></i> Tambah Data</button>
            <a href="<?= site_url('admin/naker/upload') ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Upload Naker</a>
				<div id="pesan" style="margin: 10px 5px;"></div>
	            <table id="table" class="table table-bordered table-hover table-sm text-nowrap" cellspacing="0" width="100%">
	                <thead>
		                <tr>
                            <th width="10">NO</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Position Title</th>
                            <th>Position Name</th>
                            <th>Nama CP</th>
                            <th>Hubungan</th>
                            <th>Kontak CP</th>
                            <th>Sektor</th>
                            <th>Rayon</th>
                            <th>Level</th>
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
 
var table;
var save_method;
var base_url = '<?php echo base_url();?>';
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('admin/naker/get_ajax') ?>",
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

    $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).parent().find('.help-block').empty();
    });
 
});

function add_data()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
    $('[name="method"]').val(save_method); // set input hiiden method
    $('[name="nik"]').attr('readonly',false); // remove nik readonly
    $('[name="nama"]').attr('readonly',false); // remove nama readonly

    $('#photo-preview').hide(); // hide photo preview modal
    $('#label-photo').text('Upload BPJS'); // label photo upload
}

function detail(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('[name="method"]').val(save_method); // set input hiiden method
    $('[name="nik"]').attr('readonly',true); // set nik readonly
    $('[name="nama"]').attr('readonly',true); // set nama readonly
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/naker/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.naker_id);
			$('[name="nik"]').val(data.nik);
			$('[name="nama"]').val(data.nama);
			$('[name="position_name"]').val(data.position_name);
			$('[name="position_title"]').val(data.position_title);
			$('[name="sektor"]').val(data.sektor);
			$('[name="rayon"]').val(data.rayon);
			$('[name="level"]').val(data.level);
            $('[name="nama_cp"]').val(data.nama_cp);
            $('[name="hubungan"]').val(data.hubungan);
            $('[name="no_cp"]').val(data.kontak_cp);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Ubah Data'); // Set title to Bootstrap modal title

            $('#photo-preview').show();

            if(data.bpjs)
            {
                $('#label-photo').text('Change BPJS'); // label photo upload
                $('#photo-preview div').html('<a href="naker/download_bpjs/'+data.naker_id+'" target="_blank"><i class="fa fa-cloud-download"></i> Download BPJS</a>'); // show photo
            }
            else
            {
                $('#label-photo').text('Upload BPJS'); // label photo upload
                $('#photo-preview div').text('(No File)');
            }
 
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
 
    if(save_method == 'add') {
        url = "<?php echo site_url('admin/naker/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/naker/ajax_update')?>";
	}
 
    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
                document.getElementById('pesan').innerHTML = data.pesan;
                setTimeout(function(){ $('#pesan').empty(); }, 3000);
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
            url : "<?php echo site_url('admin/naker/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                document.getElementById('pesan').innerHTML = data.pesan;
                setTimeout(function(){ $('#pesan').empty(); }, 3000);
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
                <h3 class="modal-title">Data Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <input type="hidden" value="" name="method"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="control-label col-md-3">NIK</label>
                                    <div class="col-md-9">
                                        <input name="nik" class="form-control" type="text" placeholder="Nomor Induk Karyawan">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama</label>
                                    <div class="col-md-9">
                                        <input name="nama" class="form-control" type="text" placeholder="Nama Karyawan">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Position Name</label>
                                    <div class="col-md-9">
                                        <input name="position_name" class="form-control" type="text" placeholder="Nama Posisi Karyawan">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Position Title</label>
                                    <div class="col-md-9">
                                        <input name="position_title" class="form-control" type="text" placeholder="Title Posisi Karyawan">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Sektor</label>
                                    <div class="col-md-9">
                                        <input name="sektor" class="form-control" type="text" placeholder="Nama Sektor">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Rayon</label>
                                    <div class="col-md-9">
                                        <input name="rayon" class="form-control" type="text" placeholder="Nama Rayon">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Level</label>
                                    <div class="col-md-9">
                                        <select name="level" id="level" class="form-control">
                                            <option value="DRAFTER">Drafter</option>
                                            <option value="HELPDESK">Helpdesk</option>
                                            <option value="MANAGER">Manager</option>
                                            <option value="SITE MANAGER">Site Manager</option>
                                            <option value="STAFF">Staff</option>
                                            <option value="SURVEYOR">Surveyor</option>
                                            <option value="TEAM LEADER">Team Leader</option>
                                            <option value="TEKNISI">Teknisi</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="photo-preview">
                                    <label class="control-label col-md-3">BPJS</label>
                                    <div class="col-md-9">
                                        (No File)
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3" id="label-photo">Upload BPJS </label>
                                    <div class="col-md-9">
                                        <input name="photo" type="file">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama CP</label>
                                    <div class="col-md-9">
                                        <input name="nama_cp" id="nama_cp" class="form-control" type="text" placeholder="Nama org yg dapat dihubungi">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Hubungan</label>
                                    <div class="col-md-9">
                                        <select name="hubungan" id="hubungan" class="form-control">
                                            <option value="">-PIlih Hubungan-</option>
                                            <option value="BAPAK">BAPAK</option>
                                            <option value="IBU">IBU</option>
                                            <option value="ANAK">ANAK</option>
                                            <option value="SAUDARA">SAUDARA</option>
                                            <option value="ISTRI">ISTRI</option>
                                            <option value="SUAMI">SUAMI</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">NO CP</label>
                                    <div class="col-md-9">
                                        <input name="no_cp" id="no_cp" class="form-control" type="number" placeholder="Nomor org yg dapat dihubungi">
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