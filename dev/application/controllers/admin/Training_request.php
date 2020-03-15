<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_request extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Training Request';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_request/data',$data,true)
		]);
	}
}
