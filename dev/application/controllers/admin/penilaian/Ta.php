<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_targetta');
		$this->load->model('m_nilai_ta');
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

	public function show($unit = 'all', $level='all', $pelatihan='all')
	{
		$data['title'] 		= 'Penilaian TA';
		$data['subtitle'] 	= strtoupper($unit).' | '.strtoupper($level);
		$datap['pelatihan'] = $pelatihan;
		$data['rowdata']	= $this->m_targetta->show($unit,$level,$pelatihan)->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/ta/show',$data,true)
		]);
	}

	public function detail($id)
	{
		$data = $this->m_targetta->get_by_id($id);
		echo json_encode($data);
	}

	public function insert_nilai()
	{
		$data = array(
                'target_id' 	=> $this->input->post('id'),
                'roleplay' 		=> $this->input->post('roleplay'),
                'pre_test' 		=> $this->input->post('pre_test'),
                'post_test' 	=> $this->input->post('post_test'),
                'post_test' 	=> $this->input->post('post_test'),
                'kehadiran' 	=> $this->input->post('kehadiran'),
                'lokasi' 		=> $this->input->post('lokasi'),
                'periode_tgl' 	=> $this->input->post('periode_tgl'),
                'keterangan' 	=> $this->input->post('keterangan'),
            );
        $insert = $this->m_nilai_ta->save($data);
        if ($insert) {
        	$update = array(
        		'status' 	=> 1,
        	);
        	$this->db->where('target_id', $this->input->post('id'));
        	$this->db->update('tb_target_ta', $update);
        }
        echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Nilai successfully inserted!</div>'
			)
		);
	}


}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */