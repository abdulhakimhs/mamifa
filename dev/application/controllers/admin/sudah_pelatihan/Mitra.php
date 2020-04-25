<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_nilai_mitra');
		$this->load->model('masters/m_pelatihan');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Mitra Sudah Pelatihan';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/sudah_pelatihan/mitra/data',$data,true)
		]);
	}

	public function get_ajax() {
		$list = $this->m_nilai_mitra->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mitra) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $mitra->nik;
		  $row[] = $mitra->nama;
		  $row[] = $mitra->nama_mitra;
		  $row[] = $mitra->jenis_mitra;
		  $row[] = $mitra->jenis_pelatihan;
		  $row[] = $mitra->level;
		  if($this->session->userdata('level') == 1){
			$row[] = '<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$mitra->target_m_id."'".')">
			<i class="fa fa-trash"></i>
			</a>';
		  }
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_nilai_mitra->count_all(),
					"recordsFiltered" => $this->m_nilai_mitra->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_delete($id)
	{
		$this->m_nilai_mitra->delete_nilai($id);
		$this->m_nilai_mitra->update(['target_m_id' => $id], ['status' => 0]);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}
}

/* End of file Mitra.php */
/* Location: ./application/controllers/admin/penilaian/Mitra.php */