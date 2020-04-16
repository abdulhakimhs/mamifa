<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_slider');
		$this->load->model('masters/m_content');
	}

	public function index()
	{
		$data['title'] 		= 'MAMI FA';
		$data['subtitle'] 	= 'Home';
		$data['slider']		= $this->m_slider->ambil()->result();
		$data['content']	= $this->m_content->ambil()->result();
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/home',$data,true)
		]);
	}
}
