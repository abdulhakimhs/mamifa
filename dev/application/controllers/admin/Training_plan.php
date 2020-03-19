<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_plan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trainingplan');
	}

	public function index()
	{
		$this->load->model('masters/m_kelas');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_training');

		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Training Plan';

		$data['kelas'] 		= $this->m_kelas->ambil()->result_array();
		$data['pelatihan'] 	= $this->m_pelatihan->ambil()->result_array();
		$data['training'] 	= $this->m_training->ambil()->result_array();

		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_plan/data',$data,true)
		]);
	}

	public function ajax_get()
	{
		$data = $this->m_trainingplan->ambil()->result();
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		if ($this->input->post('ta_bop') == ''){
			$ta_bop = null;
		} else {
			$ta_bop = $this->input->post('ta_bop');
		}

		if ($this->input->post('ta_pelatihan') == ''){
			$ta_pelatihan = null;
		} else {
			$ta_pelatihan = $this->input->post('ta_pelatihan');
		}

		if ($this->input->post('mitra_pelatihan') == ''){
			$mitra_pelatihan = null;
		} else {
			$mitra_pelatihan = $this->input->post('mitra_pelatihan');
		}

		if ($this->input->post('nama_mitra') == ''){
			$nama_mitra = null;
		} else {
			$nama_mitra = $this->input->post('nama_mitra');
		}

		$data = [
			'tgl_awal'  		=> $this->input->post('ftgl_awal'),
			'tgl_akhir'  		=> $this->input->post('ftgl_akhir'),
			'kelas_id'  		=> $this->input->post('kelas'),
			'pelatihan_id'  	=> $this->input->post('jenis_pelatihan'),
			'not_id'  			=> $this->input->post('name_of_training'),
			'ta_bop'  			=> $this->input->post('ta_bop') == '' ? null : $this->input->post('ta_bop'),
			'ta_pelatihan'  	=> $this->input->post('ta_pelatihan') == '' ? null : $this->input->post('ta_pelatihan'),
			'mitra_pelatihan'  	=> $this->input->post('mitra_pelatihan') == '' ? null : $this->input->post('mitra_pelatihan'),
			'nama_mitra'  		=> $this->input->post('nama_mitra') == '' ? null : $this->input->post('nama_mitra'),
			'staff_teknisi'  	=> $this->input->post('staff_teknisi') == null ? 0 : 1,
			'team_leader'  		=> $this->input->post('team_leader') == null ? 0 : 1,
			'officer'  			=> $this->input->post('officer') == null ? 0 : 1,
			'site_manager'  	=> $this->input->post('site_manager') == null ? 0 : 1,
			'mgr'  				=> $this->input->post('mgr') == null ? 0 : 1,
			'mitra'  			=> $this->input->post('mitra') == null ? 0 : 1,
			'senin'  			=> $this->input->post('senin') == null ? 0 : 1,
			'selasa'  			=> $this->input->post('selasa') == null ? 0 : 1,
			'rabu'  			=> $this->input->post('rabu') == null ? 0 : 1,
			'kamis'  			=> $this->input->post('kamis') == null ? 0 : 1,
			'jumat'  			=> $this->input->post('jumat') == null ? 0 : 1
		];

		$this->db->insert('tb_training_plan', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_trainingplan->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_trainingplan->delete_by_id($id);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed!</div>'
			)
		);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kelas') == '')
		{
			$data['inputerror'][] = 'kelas';
			$data['error_string'][] = 'Kelas is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis_pelatihan') == '')
		{
			$data['inputerror'][] = 'jenis_pelatihan';
			$data['error_string'][] = 'Jenis Pelatihan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('name_of_training') == '')
		{
			$data['inputerror'][] = 'name_of_training';
			$data['error_string'][] = 'Name Of Training is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ftgl_awal') == null)
		{
			$data['inputerror'][] = 'ftgl_awal';
			$data['error_string'][] = 'Tanggal Awal is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ftgl_akhir') == null)
		{
			$data['inputerror'][] = 'ftgl_akhir';
			$data['error_string'][] = 'Tanggal Akhir is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
