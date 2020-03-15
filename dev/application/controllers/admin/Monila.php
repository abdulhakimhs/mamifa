<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monila extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Monila';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/monila/data',$data,true)
		]);
	}
}
