<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_targetmitra');
		$this->load->model('m_nilai_mitra');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Mitra Sudah Pelatihan';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilaian']		= $this->m_targetmitra->gettabelpenilaian()->result_array();
		$data['tabel_penilaian_total']	= $this->m_targetmitra->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/sudah_pelatihan/mitra/data',$data,true)
		]);
	}
}

/* End of file Mitra.php */
/* Location: ./application/controllers/admin/penilaian/Mitra.php */