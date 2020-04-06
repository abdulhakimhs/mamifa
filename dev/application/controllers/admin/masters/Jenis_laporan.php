<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_laporan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_jenislaporan');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Jenis Laporan';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/jenis_laporan/data',$data,true)
		]);
	}

	public function get_ajax() {
		$list = $this->m_jenislaporan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jenlap) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $jenlap->jenis_laporan;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$jenlap->jenis_lap_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$jenlap->jenis_lap_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_jenislaporan->count_all(),
					"recordsFiltered" => $this->m_jenislaporan->count_filtered(),
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
		$data = $this->m_jenislaporan->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_jenislaporan->delete_by_id($id);
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
		$this->m_jenislaporan->update(array('jenis_lap_id' => $this->input->post('id')), $data);
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
