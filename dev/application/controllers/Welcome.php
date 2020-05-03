<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_slider');
		$this->load->model('masters/m_content');
		$this->load->model('masters/m_partner');
	}

	public function index()
	{
		$data['title'] 				= 'MAMI FA';
		$data['subtitle'] 			= 'Home';
		$data['slider']				= $this->m_slider->ambil()->result();
		$data['content']			= $this->m_content->ambil()->result();
		$data['content_popular']	= $this->m_content->ambil_popular()->result();
		$data['content_latest']		= $this->m_content->ambil_latest()->result();
		$data['foto']				= $this->m_partner->getAll()->result();
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/home',$data,true)
		]);
	}
}
