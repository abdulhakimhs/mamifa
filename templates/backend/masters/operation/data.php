<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Data Operation</h5>
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
				<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Tambah Data</a>
				<div id="pesan" style="margin: 10px 5px;"></div>
	            <table id="table" class="table table-bordered table-hover table-sm text-nowrap" cellspacing="0" width="100%">
	                <thead>
		                <tr>
                            <th width="10">NO</th>
                            <th>Operation</th>
			                <th width="100"><i class="fa fa-gear"></i></th>
		                </tr>
		            </thead>
		            <tbody>
                        <tr>
                            <td>1</td>
                            <td>PEKALONGAN</td>
                            <td>
                                <a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CCAN</td>
                            <td>
                                <a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

		            </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
    });
 
});
</script>