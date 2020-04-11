<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Material';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/material/data',$data,true)
		]);
	}

	public function get_ajax() {
		$list = $this->m_material->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mat) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $mat->material;
		  $row[] = $mat->merk;
		  $row[] = $mat->type;
		  $row[] = $mat->jenis == 'HABIS PAKAI' ? '<span class="label label-success">'.$mat->jenis.'</span>' : '<span class="label label-primary">'.$mat->jenis.'</span>';
		  $row[] = $mat->stok;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$mat->material_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$mat->material_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_material->count_all(),
					"recordsFiltered" => $this->m_material->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'jenis_laporan'  => strtoupper($this->input->post('jenis_laporan'))
		];

		$this->db->insert('tb_jenis_laporan', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_material->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_material->delete_by_id($id);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed!</div>'
			)
		);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'jenis_laporan' 	=> strtoupper($this->input->post('jenis_laporan'))
			);
		$this->m_material->update(array('jenis_lap_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jenis_laporan') == '')
		{
			$data['inputerror'][] = 'jenis_laporan';
			$data['error_string'][] = 'Jenis Laporan is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Material.php */
/* Location: ./application/controllers/admin/masters/Material.php */