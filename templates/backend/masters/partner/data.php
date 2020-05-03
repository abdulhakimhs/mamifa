<button class="btn btn-danger btn-sm" onclick="add_data()"><i class="fa fa-plus"></i> Tambah Data</button>
<div id="pesan" style="margin: 10px 5px;"></div>
<br/>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div>
            <ul class="ace-thumbnails clearfix">
                <?php foreach ($foto as $ft) : ?>
                    <li>
                        <a href="<?= base_url('/assets/backend/images/gallery/'. $ft->photo) ?>" data-rel="colorbox">
                            <img width="150" height="150" alt="150x150" src="<?= base_url('/assets/backend/images/gallery/'. $ft->photo) ?>" />
                            <div class="text">
                                <div class="inner"><?= $ft->partner_name ?></div>
                            </div>
                        </a>
    
                        <div class="tools tools-bottom">
                            <a href="javascript:void(0)"  onclick="delete_data(<?= $ft->partner_id ?>)" > <!-- kasih parameter ID nya ya -->
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        </div>
                    </li>                    
                <?php endforeach; ?>
            </ul>
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

<script type="text/javascript">

var save_method;
var base_url = '<?php echo base_url();?>';

function add_data()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Foto'); // Set Title to Bootstrap modal title
    $('[name="method"]').val(save_method); // set input hiiden method

    $('#photo-preview').hide(); // hide photo preview modal
    $('#label-photo').text('Upload Foto'); // label photo upload
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
 
    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : "<?php echo site_url('admin/masters/partner/ajax_add')?>",
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
                document.getElementById('pesan').innerHTML = data.pesan;
                setTimeout(function(){ window.location.reload(); }, 500);
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
    if(confirm('Are you sure delete this photo?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/masters/partner/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                document.getElementById('pesan').innerHTML = data.pesan;
                setTimeout(function(){ window.location.reload(); }, 500);
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
    <div class="modal-dialog">
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
                        <div class="form-group">
                            <label class="control-label col-md-3">Judul Foto</label>
                            <div class="col-md-9">
                                <input name="partner_name" class="form-control" type="text" placeholder="Judul Foto">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Foto</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Foto </label>
                            <div class="col-md-9">
                                <input name="photo" type="file" required/>
                                <span class="help-block"></span>
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