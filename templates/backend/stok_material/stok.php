<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
</style>

<div class="row">
    <div class="col-lg-4">
        <h4>Stok Material Saat Ini</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #6FB3E0; color: #fff;">MATERIAL</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">STOK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($material as $m) : ?>
                        <?php if ($m['jenis'] == 'MATERIAL') {  ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['material'] ?></td>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['stok'] ?></td>
                            <tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <h4>&nbsp</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #87B87F; color: #fff;">MATERIAL HABIS PAKAI</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">STOK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($material as $m) : ?>
                        <?php if ($m['jenis'] == 'HABIS PAKAI') {  ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['material'] ?></td>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['stok'] ?></td>
                            <tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <h4>&nbsp</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="vertical-align : middle;text-align:center; background: #FFB752; color: #fff;">ALKER</th>
                        <th style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">STOK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($material as $m) : ?>
                        <?php if ($m['jenis'] == 'ALKER') {  ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['material'] ?></td>
                                <td style="vertical-align : middle;text-align:center;"><?= $m['stok'] ?></td>
                            <tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>