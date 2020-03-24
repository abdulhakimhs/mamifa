<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Penilaian';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/data',$data,true)
		]);
	}
}
