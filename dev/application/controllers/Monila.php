<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monila extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'MAMI FA';
		$data['subtitle'] 		= 'Monila';
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/monila',$data,true)
		]);
	}
}
