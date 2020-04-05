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
		if(isset($_POST['upload'])){
			/* 
				1) jika taregt untuk TA, maka insert ke tb_target_ta, jika mitra tb_target_mitra.
				2) jenis file xlsx.
			*/
		}
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Upload';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/target/upload',$data,true)
		]);
	}
}
