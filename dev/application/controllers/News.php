<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function detail()
	{
        $slug = $this->uri->segment(2);
        $data['title'] 		= 'News';
		$data['subtitle'] 	= 'Judul Beritanya';
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/news',$data,true)
		]);
	}
}
