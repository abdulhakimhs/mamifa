<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_targetmitra');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Penilaian Mitra';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilaian']		= $this->m_targetmitra->gettabelpenilaian()->result_array();
		$data['tabel_penilaian_total']	= $this->m_targetmitra->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/mitra/data',$data,true)
		]);
	}

	public function ambil_grafik($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
	{
		$data['isi'] = $this->m_targetmitra->gettabelpenilaian($bulan, $tahun, $pelatihan)->result_array();
		$data['total'] = $this->m_targetmitra->gettabelpenilaiantotal($bulan, $tahun, $pelatihan)->row_array();

		echo json_encode($data);
	}

	public function show($mitra = 'all', $level='all', $pelatihan='all')
	{
		$data['title'] 		= 'Penilaian Mitra';
		$data['subtitle'] 	= strtoupper($mitra).' | '.strtoupper($level);
		$data['material'] 	= $this->m_material->stok_tersedia()->result_array();
		$data['rowdata']	= $this->m_targetmitra->show($mitra,$level,$pelatihan)->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/mitra/show',$data,true)
		]);
	}

	public function detail($id)
	{
		$data = $this->m_targetmitra->get_by_id($id);
		echo json_encode($data);
	}

}

/* End of file Mitra.php */
/* Location: ./application/controllers/admin/penilaian/Mitra.php */