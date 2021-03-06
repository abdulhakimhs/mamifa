<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
		$this->load->model('masters/m_mitra');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Mitra';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/mitra/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_mitra->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mitra) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $mitra->nama_mitra;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$mitra->mitra_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$mitra->mitra_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_mitra->count_all(),
					"recordsFiltered" => $this->m_mitra->count_filtered(),
					"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'nama_mitra'  	=> strtoupper($this->input->post('nama_mitra'))
		];

		$this->db->insert('tb_mitra', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_mitra->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_mitra->delete_by_id($id);
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
				'nama_mitra'  	=> strtoupper($this->input->post('nama_mitra'))
			);
		$this->m_mitra->update(array('mitra_id' => $this->input->post('id')), $data);
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

		if($this->input->post('nama_mitra') == '')
		{
			$data['inputerror'][] = 'nama_mitra';
			$data['error_string'][] = 'Nama Mitra is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
