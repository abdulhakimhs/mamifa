<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Operation';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/operation/data',$data,true)
		]);
	}
}
