<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Upload Target Pelatihan</h5>
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
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Target Tahun</b></label>
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">-Pilih Tahun-</option>
                                    <option value="2002">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Target Bulan</b></label>
                                <select name="bulan" id="tahun" class="form-control">
                                    <option value="">-Pilih Bulan-</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Jenis Pelatihan</b></label>
                                <select name="jenis_pelatihan" id="tahun" class="form-control">
                                    <option value="">-Pilih Pelatihan-</option>
                                    <option value="01">INDIHOME NON TEKNIS</option>
                                    <option value="02">MULTISKILL</option>
                                    <option value="03">TS INDIHOME</option>
                                    <option value="04">SURVEY DESIGN FTTH</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label"><b>Pilih Target Untuk</b></label>
                                <select name="target_for" id="tahun" class="form-control">
                                    <option value="">-Pilih Target Untuk-</option>
                                    <option value="TA">TA</option>
                                    <option value="MITRA">MITRA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="file" name="userfile" id="fileupload">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="upload" class="btn btn-sm btn-danger"><i class="fa fa-upload"></i> Upload</button>
                    <a href="<?= base_url() ?>assets/backend/files/format_target_ta.xlsx">Format Target TA</a> |
                    <a href="<?= base_url() ?>assets/backend/files/format_target_mitra.xlsx">Format Target MITRA</a>
                </form>
			</div>
		</div>
	</div>
</div>