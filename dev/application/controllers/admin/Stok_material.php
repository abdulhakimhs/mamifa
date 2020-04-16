<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_stok_material');
	}

	public function index()
	{
		$data['title'] 			= 'Stok';
		$data['subtitle'] 		= 'Material';
		$data['material']		= $this->m_stok_material->ambil()->result_array();
		$data['total']			= $this->m_stok_material->grandtotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/stok_material/stok',$data,true)
		]);
	}

}

/* End of file Stok_material.php */
/* Location: ./application/controllers/admin/Stok_material.php */