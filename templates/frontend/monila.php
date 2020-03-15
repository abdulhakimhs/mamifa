<!-- Full Page Image Header with Vertically Centered Content -->
<header class="mastheader text-white text-center">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center"></div>
    </div>
  </div>
</header>
<div class="container">
<div class="bd-callout bd-callout-warning">
    <p>Anda bisa melaporkan temuan di lapangan pada halaman ini, upaya ini dilakukan untuk membuat jaringan layanan kita bisa lebih baik lagi. Untuk itu pastikan niat anda melaporkan dengan tujuan baik.</p>
</div>
<?= $this->session->flashdata('message'); ?>
<?= form_open_multipart('monila'); ?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Jenis Laporan</b></label>
    <div class="col-sm-10">
      <select name="jenis_laporan" id="jenis_laporan" class="form-control" required>
        <option value="">-Pilih Jenis Laporan-</option>
        <?php foreach ($jenis_laporan as $jp) : ?>
          <option value="<?= $jp['jenis_lap_id'] ?>"><?= $jp['jenis_laporan'] ?></option>
        <?php endforeach; ?>>
      </select>
      <?= form_error('jenis_laporan', '<div class="error">', '</div>'); ?>
    </div>
  </div>
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
    <label class="col-sm-2 col-form-label"><b>Lokasi Temuan</b></label>
    <div class="col-sm-10">
    <select name="sto" id="sto" class="form-control" required>
        <option value="">-Pilih STO-</option>
        <option value="PKL">PKL</option>
        <option value="TEG">TEG</option>
        <option value="BRB">BRB</option>
      </select>
      <?= form_error('sto', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Koordinat / Nama ODP</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="odp_koordinat" id="odp_koordinat">
      <?= form_error('odp_koordinat', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>File Evident</b></label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="file_evident">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Saran Perbaikan</b></label>
    <div class="col-sm-10">
      <textarea name="saran" id="saran" cols="30" rows="5" class="form-control"></textarea>
      <?= form_error('saran', '<div class="error">', '</div>'); ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
</form>
</div>