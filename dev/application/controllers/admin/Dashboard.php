<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Dashboard';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/dashboard',$data,true)
		]);
	}
}
