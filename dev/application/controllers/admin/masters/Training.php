<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Training';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/training/data',$data,true)
		]);
	}
}
