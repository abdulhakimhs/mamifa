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
      <h5 class="widget-title"><?= $subtitle ?></h5>
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
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-control-label"><b>Pilih Target Tahun</b></label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">-Pilih Tahun-</option>
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
                    <label class="form-control-label"><b>Pilih Target Bulan</b></label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">-Pilih Bulan-</option>
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
                    <select name="jenis_pelatihan" id="jenis_pelatihan" class="form-control">
                        <option value="">-Pilih Pelatihan-</option>
                        <?php foreach ($jenis_pelatihan as $jp) : ?>
                            <option value="<?= $jp['pelatihan_id'] ?>"><?= $jp['jenis_pelatihan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
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
                  <?php if($this->session->userdata('level') == 1){ ?>
                    <th><i class="fa fa-gear"></i></th>
                  <?php } ?>
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
  
  $(document).ready(function() {
  
      //datatables
      table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('admin/sudah_pelatihan/ta/get_ajax') ?>",
          "type": "POST",
          "data": function(data){
            data.bulan            = $('#bulan').val();
            data.tahun            = $('#tahun').val();
            data.jenis_pelatihan  = $('#jenis_pelatihan').val();
          }
        },

        dom: 'Bfrtip',
        "pageLength": 100,
        "scrollX": true,
        buttons: [
            { extend: 'copy', className: 'btn btn-default' },
            { extend: 'excel', className: 'btn btn-success' }
        ],

        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
          }
        ]
      });

      $('#bulan').change(function(){
        table.ajax.reload();
      });
      
      $('#tahun').change(function(){
        table.ajax.reload();
      });

      $('#jenis_pelatihan').change(function(){
        table.ajax.reload();
      });
  
  });
  
  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax 
  }
  
  function delete_data(id)
  {
      if(confirm('Are you sure delete this data?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('admin/sudah_pelatihan/ta/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
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