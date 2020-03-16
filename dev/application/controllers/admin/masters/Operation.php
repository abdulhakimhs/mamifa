<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
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
		  $row[] = $operation->operation_name;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
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
}
