<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_pelatihan');
	}

	public function material()
	{
        if(isset($_POST['submit'])) {
            # code...
        }
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Stok Material';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/material',$data,true)
		]);
    }
    
    public function nilai()
	{
        if(isset($_POST['submit'])) {
            # code...
        }
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Nilai TA/Mitra';
		$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/nilai',$data,true)
		]);
    }
}
