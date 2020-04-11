<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
</style>

<div class="row">
    <div class="col-lg-6">
        <h4>Stok Material Bulan <?= date('M') ?> Tahun <?= date("Y") ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #6FB3E0; color: #fff;">MATERIAL</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">STOK</th>
                    </tr>
                </thead>
                <tbody id="tabel_ta">
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">SOC</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="show/soc">0</a></td>
                    <tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>
                        <td style="vertical-align : middle;text-align:center; text-decoration: none;"><b><a style="text-decoration: none;" href="#">0</a></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <h4>&nbsp</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #87B87F; color: #fff;">MATERIAL HABIS PAKAI</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">STOK</th>
                    </tr>
                </thead>
                <tbody id="tabel_ta">
                    <tr>
                        <td style="vertical-align : middle;text-align:center;">SOC</td>
                        <td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="show/soc">0</a></td>
                    <tr>
                    <tr>
                        <td style="vertical-align : middle;text-align:center;"><b>GRAND TOTAL</b></td>
                        <td style="vertical-align : middle;text-align:center; text-decoration: none;"><b><a style="text-decoration: none;" href="#">0</a></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>