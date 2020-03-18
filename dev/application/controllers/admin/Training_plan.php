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
}
