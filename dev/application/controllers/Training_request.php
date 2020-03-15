<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_request extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('m_pelatihan');

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('pelatihan', 'Pelatihan', 'required');
		$this->form_validation->set_rules('alasan', 'Alasan Permintaan Pelatihan', 'required');

		if($this->form_validation->run() == false) {
			$data['title'] 			= 'MAMI FA';
			$data['subtitle'] 		= 'Training Request';

			$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();

			$this->load->view('frontend/template',[
				'content' => $this->load->view('frontend/training_request',$data,true)
			]);
		} else {
			$data = [
				'nama_lengkap'		=> $this->input->post('nama_lengkap'),
				'nik'				=> $this->input->post('nik'),
				'level'				=> $this->input->post('level'),
				// 'sub_level'			=> $this->input->post('sub_level'),
				'pelatihan_id'		=> $this->input->post('pelatihan'),
				'alasan_permintaan'	=> $this->input->post('alasan')
			];

			$this->db->insert('tb_training_request', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan sudah terkirim!</div>');
			redirect('training_request');
		}
	}
}
