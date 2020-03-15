<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Pelatihan';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/pelatihan/data',$data,true)
		]);
	}
}
