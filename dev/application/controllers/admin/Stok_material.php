<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_material extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Stok';
		$data['subtitle'] 		= 'Material';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/material/stok',$data,true)
		]);
	}

}

/* End of file Stok_material.php */
/* Location: ./application/controllers/admin/Stok_material.php */