<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Material';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/material/data',$data,true)
		]);
	}

}

/* End of file Material.php */
/* Location: ./application/controllers/admin/masters/Material.php */