<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
		$this->load->model('m_stok_material');
	}

	public function index()
	{
		$data['title'] 			= 'Stok';
		$data['subtitle'] 		= 'Material Saat Ini';
		$data['material']		= $this->m_stok_material->ambil()->result_array();
		$data['total']			= $this->m_stok_material->grandtotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/stok_material/stok',$data,true)
		]);
	}
	
	public function keluar()
	{
		$data['title'] 			= 'Stok';
		$data['subtitle'] 		= 'Material Keluar';
		$data['material']		= $this->m_stok_material->stok_keluar()->result_array();
		$data['total']			= $this->m_stok_material->grandtotal_keluar()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/stok_material/stok_keluar',$data,true)
		]);
	}

	public function ajax_get($bulan = 'all', $tahun = 'all')
	{
		$data['material']	= $this->m_stok_material->stok_keluar($bulan, $tahun)->result_array();
		$data['total']		= $this->m_stok_material->grandtotal_keluar($bulan, $tahun)->row_array();
		echo json_encode($data);
	}
}

/* End of file Stok_material.php */
/* Location: ./application/controllers/admin/Stok_material.php */