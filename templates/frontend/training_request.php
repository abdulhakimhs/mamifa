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
    <p>Anda bisa melakukan permintaan pelatihan pada halaman ini.</p>
</div>
<form>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Nama Lengkap</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>NIK</b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nik" id="nik">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Level</b></label>
    <div class="col-sm-10">
    <select name="sto" id="sto" class="form-control" required>
        <option value="">-Pilih Level-</option>
        <option value="S">STAFF</option>
        <option value="TL">TEAM LEADER</option>
        <option value="SM">SITE MANAGER</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b></b></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="lokasi" id="lokasi" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Katalog Pelatihan</b></label>
    <div class="col-sm-10">
      <select name="jenis_laporan" id="jenis_laporan" class="form-control" required>
        <option value="">-Pilih Katalog-</option>
        <option value="fakta_brutal">Pilihan_1</option>
        <option value="bahaya_listrik">Pilihan_2</option>\
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><b>Alasan Permintaan Pelatihan</b></label>
    <div class="col-sm-10">
      <textarea name="saran" id="saran" cols="30" rows="5" class="form-control"></textarea>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
</form>
</div>