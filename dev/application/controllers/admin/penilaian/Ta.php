<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Penilaian TA';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/ta/data',$data,true)
		]);
	}

}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */