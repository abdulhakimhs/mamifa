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
        <div id="pesan" style="margin: 10px 5px;"></div>
        <table id="table" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>NO</th>
                  <th>NIK</th>
                  <th>NAMA</th>
                  <th>MITRA</th>
                  <th>JENIS MITRA</th>
                  <th>PELATIHAN</th>
                  <th>LEVEL</th>
                  <?php if($this->session->userdata('level') == 1){ ?>
                    <th><i class="fa fa-gear"></i></th>
                  <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($rowdata as $row) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['nik'] ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['nama_mitra'] ?></td>
                  <td><?= $row['jenis_mitra'] ?></td>
                  <td><?= $row['jenis_pelatihan'] ?></td>
                  <td><?= $row['level'] ?></td>
                  <?php if($this->session->userdata('level') == 1){ ?>
                  <td>
                      <a href="javascript:void(0)" title="Follow UP" onclick="delete(<?= $row['target_m_id'];?>)"><i class="fa fa-trash"></i></a>
                  </td>
                  <?php } ?>
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
        orientation: "bottom auto",
        todayBtn: true,
        todayHighlight: true,  
    });
  });

</script>