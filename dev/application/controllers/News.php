<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_content');
	}

	public function detail()
	{
		$slug 				= $this->uri->segment(2);
		$news				= $this->m_content->get_by_slug($slug)->row();
		$count				= $news->content_count + 1;

		$subtitle 			= str_replace('-', ' ', $slug);

		$this->m_content->update(['content_slug' => $slug], ['content_count' => $count]);

        $data['title'] 		= 'News';
		$data['subtitle'] 	= ucwords($subtitle);
		$data['news']		= $news;
		$data['content_popular']	= $this->m_content->ambil_popular()->result();
		$data['content_latest']		= $this->m_content->ambil_latest()->result();
		$this->load->view('frontend/template',[
			'content' => $this->load->view('frontend/news',$data,true)
		]);
	}
}
