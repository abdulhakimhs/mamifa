<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
	}

	public function index()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Dashboard';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/dashboard',$data,true)
		]);
	}

	public function grafik_ta($bulan = 'now', $tahun = 'now')
	{
		$data = $this->m_dashboard->getgrafikta($bulan, $tahun)->result();
		echo json_encode($data);
	}

	public function grafik_mitra($bulan = 'now', $tahun = 'now')
	{
		$data = $this->m_dashboard->getgrafikmitra($bulan, $tahun)->result();
		echo json_encode($data);
	}
}
