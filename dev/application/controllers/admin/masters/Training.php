<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_training');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Training';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/training/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_training->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $training) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $training->name_of_training;
		  if($training->status == 1) {
			$row[] = '<span class="label label-success">Aktif</span>';
		  } else {
			$row[] = '<span class="label label-danger">Tidak Aktif</span>';
		  }
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_training->count_all(),
					"recordsFiltered" => $this->m_training->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}
}
