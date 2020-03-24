<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/target/tabel',$data,true)
		]);
	}

	public function upload()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Upload';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/target/upload',$data,true)
		]);
	}
}
