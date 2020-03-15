<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monila extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('m_jenislaporan');

		$this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('sto', 'STO', 'required');
		$this->form_validation->set_rules('odp_koordinat', 'Koordinat / Nama ODP', 'required');
		$this->form_validation->set_rules('saran', 'Saran Perbaikan', 'required');

		if($this->form_validation->run() == false) {
			$data['title'] 			= 'MAMI FA';
			$data['subtitle'] 		= 'Monila';

			$data['jenis_laporan'] = $this->m_jenislaporan->ambil()->result_array();

			$this->load->view('frontend/template',[
				'content' => $this->load->view('frontend/monila',$data,true)
			]);
		} else {
			$file = $_FILES['file_evident']['name'];

            if ($file) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/backend/images/file_evident/';

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_evident')) {
					$nama_file = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
			}

			$data = [
				'jenis_lap_id' 		=> $this->input->post('jenis_laporan'),
				'nama_lengkap' 		=> $this->input->post('nama_lengkap'),
				'nik' 				=> $this->input->post('nik'),
				'lokasi_temuan' 	=> $this->input->post('sto'),
				'odp_koordinat'		=> $this->input->post('odp_koordinat'),
				'file_evident' 		=> $nama_file,
				'saran_perbaikan'	=> $this->input->post('saran')
			];

			$this->db->insert('tb_monila', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Laporan sudah terkirim!</div>');
			redirect('monila');
		}
	}
}
