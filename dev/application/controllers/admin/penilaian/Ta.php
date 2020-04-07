<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_targetta');
		$this->load->model('masters/m_pelatihan');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Penilaian TA';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilian'] 		= $this->m_targetta->gettabelpenilaian()->result_array();
		$data['tabel_penilian_total'] 	= $this->m_targetta->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/ta/data',$data,true)
		]);
	}

	public function ambil_grafik($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
	{
		$data['isi'] = $this->m_targetta->gettabelpenilaian($bulan, $tahun, $pelatihan)->result_array();
		$data['total'] = $this->m_targetta->gettabelpenilaiantotal($bulan, $tahun, $pelatihan)->row_array();

		echo json_encode($data);
	}

}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */