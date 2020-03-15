<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'MAMI FA';
		$data['subtitle'] 		= 'Home';
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/home',$data,true)
		]);
	}
}
