<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_kelas');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Kelas';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/kelas/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_kelas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelas) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $kelas->nama_kelas;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_kelas->count_all(),
					"recordsFiltered" => $this->m_kelas->count_filtered(),
					"data" => $data,
				);
		echo json_encode($output);
	}
}
