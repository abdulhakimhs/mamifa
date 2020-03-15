<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_request extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'MAMI FA';
		$data['subtitle'] 		= 'Training Request';
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/training_request',$data,true)
		]);
	}
}
