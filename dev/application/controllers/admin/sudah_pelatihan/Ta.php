<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_nilai_ta');
		$this->load->model('masters/m_pelatihan');
	}

	public function index()
	{
		$data['title'] 				= 'Target';
		$data['subtitle'] 			= 'TA Sudah Pelatihan';
		$data['jenis_pelatihan']	= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/sudah_pelatihan/ta/data',$data,true)
		]);
	}

	public function get_ajax() {
		$list = $this->m_nilai_ta->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $ta) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $ta->nik;
		  $row[] = $ta->nama;
		  $row[] = $ta->jenis_pelatihan;
		  $row[] = $ta->position_name;
		  $row[] = $ta->subunit;
		  $row[] = $ta->level;
		  if($this->session->userdata('level') == 1){
			$row[] = '<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$ta->target_id."'".')">
			<i class="fa fa-trash"></i>
			</a>';
		  }
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_nilai_ta->count_all(),
					"recordsFiltered" => $this->m_nilai_ta->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_delete($id)
	{
		$this->m_nilai_ta->delete_nilai($id);
		$this->m_nilai_ta->update(['target_id' => $id], ['status' => 0]);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}
}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */