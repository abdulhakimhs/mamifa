<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_targetta');
		$this->load->model('m_nilai_ta');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'TA Sudah Pelatihan';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilian'] 		= $this->m_targetta->gettabelpenilaian()->result_array();
		$data['tabel_penilian_total'] 	= $this->m_targetta->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/sudah_pelatihan/ta/data',$data,true)
		]);
	}
}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */