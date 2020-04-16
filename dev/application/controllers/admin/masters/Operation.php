<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
		$this->load->model('masters/m_operation');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Operation';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/operation/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_operation->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $operation) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $operation->operation_code;
		  $row[] = $operation->operation_name;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$operation->operation_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$operation->operation_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_operation->count_all(),
					"recordsFiltered" => $this->m_operation->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'operation_code'  => strtoupper($this->input->post('operation_code')),
			'operation_name'  => strtoupper($this->input->post('operation_name'))
		];

		$this->db->insert('tb_operation', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_operation->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_operation->delete_by_id($id);
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
			'operation_code'  => strtoupper($this->input->post('operation_code')),
			'operation_name'  => strtoupper($this->input->post('operation_name'))
		);
		$this->m_operation->update(array('operation_id' => $this->input->post('id')), $data);
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

		if($this->input->post('operation_code') == '')
		{
			$data['inputerror'][] = 'operation_code';
			$data['error_string'][] = 'Operation Code is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('operation_name') == '')
		{
			$data['inputerror'][] = 'operation_name';
			$data['error_string'][] = 'Operation Name is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
