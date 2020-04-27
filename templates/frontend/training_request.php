<style>
    .navbar-default{
        background-color:#222 !important;
    }
</style>
<section id="page-title" style="margin-top: 80px; background-color:#eeeeee;">
    <div class="container">
        <div class="page-title col-md-5">
            <h1>Training Request</h1>
        </div>
        <div class="col-md-7">
            <ol class="breadcrumb pull-right" style="background-color: #eeeeee;">
                <li><a href="#"><i class="fa fa-home"></i></a>
                </li>
                <li><a href="#" ><span>Training Request</span></a></li>
                <li class="active">Form Training Request</li>
            </ol>
        </div>
    </div>
</section>
<div class="container">
<div class="bs-callout bs-callout-warning">
    <p>Anda bisa melakukan permintaan pelatihan pada halaman ini.</p>
</div>
<?= $this->session->flashdata('message'); ?>
<form action="<?= base_url('training_request'); ?>" method="POST">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Nama Lengkap</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
      <?= form_error('nama_lengkap', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>NIK</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nik" id="nik">
      <?= form_error('nik', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Level</b></label>
    <div class="col-sm-10">
    <select name="level" id="level" class="form-control" required>
        <option value="">-Pilih Level-</option>
        <option value="STAFF">STAFF</option>
        <option value="TEAM LEADER">TEAM LEADER</option>
        <option value="SITE MANAGER">SITE MANAGER</option>
      </select>
      <?= form_error('level', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b></b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="sub_level" id="sub_level" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Katalog Pelatihan</b></label>
    <div class="col-sm-10">
      <select name="pelatihan" id="pelatihan" class="form-control" required>
        <option value="">-Pilih Katalog-</option>
        <?php foreach ($pelatihan as $p) : ?>
          <option value="<?= $p['pelatihan_id'] ?>"><?= $p['jenis_pelatihan'] ?></option>
        <?php endforeach; ?>
      </select>
      <?= form_error('pelatihan', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Alasan Permintaan Pelatihan</b></label>
    <div class="col-sm-10">
      <textarea name="alasan" id="alasan" cols="30" rows="5" class="form-control"></textarea>
      <?= form_error('alasan', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Submit</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
</form>
</div>

<script>
  $("#level").change(function(){
    if($("#level").val() == 'STAFF') {
      $("#sub_level").val('FIBER ACADEMY PEKALONGAN');
    } else if($("#level").val() == '') {
      $("#sub_level").val('');
    } else {
      $("#sub_level").val('REGIONAL');
    }
  });
</script>