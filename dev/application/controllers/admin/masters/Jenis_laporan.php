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

	function get_ajax() {
		$list = $this->m_jenislaporan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jenlap) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $jenlap->jenis_laporan;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
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
}
