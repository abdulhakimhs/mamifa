<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Penilaian Mitra';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/mitra/data',$data,true)
		]);
	}

}

/* End of file Mitra.php */
/* Location: ./application/controllers/admin/penilaian/Mitra.php */