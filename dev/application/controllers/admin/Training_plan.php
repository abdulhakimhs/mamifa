<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_plan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Training Plan';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_plan/data',$data,true)
		]);
	}
}
