<style type="text/css">
  @media (min-width: 768px) {
    .modal-xl {
      width: 100%;
     max-width:1200px;
    }
  }
</style>
<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
  <div class="widget-box widget-color-dark" id="widget-box-1">
    <div class="widget-header">
      <h5 class="widget-title">Penilaian TA <?= $subtitle ?></h5>
      <div class="widget-toolbar">

        <a href="javascript:history.back();" class="purle">
          <i class="ace-icon fa fa-arrow-left"></i>
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
        <table id="table" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>NO</th>
                  <th>NIK</th>
                  <th>NAMA</th>
                  <th>PELATIHAN</th>
                  <th>POSITION NAME</th>
                  <th>SUBUNIT</th>
                  <th>LEVEL</th>
                  <th><i class="fa fa-gear"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($rowdata as $row) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['nik'] ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['jenis_pelatihan'] ?></td>
                  <td><?= $row['position_name'] ?></td>
                  <td><?= $row['subunit'] ?></td>
                  <td><?= $row['level'] ?></td>
                  <td>
                      <a href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['target_id'];?>)"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
        dom: 'Bfrtip',
        "pageLength": 100,
        "scrollX": true,
        buttons: [
            { extend: 'copy', className: 'btn btn-default' },
            { extend: 'excel', className: 'btn btn-success' }
        ]
    });

    // $('.selectm').select2({width: '100%'});

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
  });

  function detail(id)
  {
      //save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('admin/penilaian/ta/detail')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id"]').val(data.target_id);
              $('[name="nik"]').val(data.nik);
              $('[name="nama"]').val(data.nama);
              $('[name="nama_pelatihan"]').val(data.jenis_pelatihan);
              
              $('#modal_nilai').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Beri Nilai Pelatihan'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_nilai" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nilai</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <input type="hidden" value="" name="nama_pelatihan"/>
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label col-md-3">NIK</label>
                              <div class="col-md-9">
                                  <input name="nik" class="form-control" type="text" readonly>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">NAMA</label>
                              <div class="col-md-9">
                                  <input name="nama" class="form-control" type="text" readonly>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">Periode Tgl</label>
                              <div class="col-md-9">
                                  <input name="periode_tgl" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">Lokasi/Ruang</label>
                              <div class="col-md-9">
                                  <select class="form-control" name="lokasi">
                                    <option value="R. FIBER ACADEMY PEKALONGAN">R. FIBER ACADEMY PEKALONGAN</option>
                                  </select>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label col-md-3">Role Play</label>
                              <div class="col-md-9">
                                  <input name="roleplay" class="form-control" type="number">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">PRE Test</label>
                              <div class="col-md-9">
                                  <input name="pre_test" class="form-control" type="number">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">POST Test</label>
                              <div class="col-md-9">
                                  <input name="post_test" class="form-control" type="number">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">Kehadiran</label>
                              <div class="col-md-9">
                                  <input name="kehadiran" class="form-control" type="number">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">Keterangan</label>
                              <div class="col-md-9">
                                  <textarea class="form-control" name="keterangan" rows="3"></textarea>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="row">
                              <div class="col-lg-7">
                                  <div class="form-group">
                                    <div class="col-md-12">
                                      <select name="material[]" id="material0" class="form-control selectm">
                                        <option value="">-Pilih Material-</option>
                                        <?php foreach ($material as $m) : ?>
                                          <option value="<?= $m['material_id'] ?>"><?= $m['material'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                      <span class="help-block"></span>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-5">
                                  <div class="form-group">
                                        <div class="col-md-8">
                                          <input type="text" class="form-control" id="jumlah" name="jumlah[]" placeholder="Jumlah">
                                        </div>
                                        <div class="col-md-4">
                                          <button class="btn btn-success btn-sm" type="button" id="btnAdd"  onclick="add_fields();"> <span class="fa fa-plus" aria-hidden="true"></span> </button>
                                        </div>
                                  </div>
                              </div>
                              <div class="clear"></div>
                          </div>
                          <div id="form_fields"></div>
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

<script type="text/javascript">
  
  $(document).ready(function(){

    $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).parent().find('.help-block').empty();
    });

  });

  let room = 1;
  let id_m = 1;

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable

      // ajax adding data to database
      $.ajax({
          url : "<?php echo site_url('admin/penilaian/ta/insert_nilai')?>",
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data)
          {

              if(data.status) //if success close modal and reload ajax table
              {
                  $('#modal_nilai').modal('hide');
                  window.location.reload()
                  document.getElementById('pesan').innerHTML = data.pesan;
                  setTimeout(function(){ $("#pesan").empty(); }, 3000);
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++)
                  {
                    if(data.error_string[i] == 'Jumlah melebihi batas stok material'){
                      $('[id="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                      $('[id="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
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

  function add_fields() {
      room++;
      var objTo = document.getElementById('form_fields');
      var divtest = document.createElement("div");
      divtest.setAttribute("class", "col-sm-12 form-group removeclass"+room);
      var rdiv = 'removeclass'+room;
      divtest.innerHTML = `<div class="row">
          <div class="col-lg-7">
              <div class="form-group">
              <div class="col-md-12">
                  <select name="material[]" id="material`+ id_m +`" class="form-control selectm">
                  <option value="">-Pilih Material-</option>
                  <?php foreach ($material as $m) : ?>
                    <option value="<?= $m['material_id'] ?>"><?= $m['material'] ?></option>
                  <?php endforeach; ?>
                  </select>
                  <span class="help-block"></span>
              </div>
              </div>
          </div>
          <div class="col-lg-5">
              <div class="form-group">
                  <div class="col-md-8">
                      <input type="text" class="form-control" id="jumlah" name="jumlah[]" placeholder="Jumlah">
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-danger btn-sm" type="button" onclick="remove_fields(`+room+`);"> <span class="fa fa-minus" aria-hidden="true"></span> </button>
                  </div>
              </div>
          </div>
          <div class="clear"></div>
          <div id="form_fields"></div>
      </div>`;
      objTo.appendChild(divtest);
      id_m++;
  }

  function remove_fields(rid) {
      $('.removeclass'+rid).remove();
      id_m--;
  }
</script>