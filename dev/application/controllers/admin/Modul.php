<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('m_modul');
        $this->load->helper('download');
	}

	public function index()
	{
		$data['title'] 			= 'Modul';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/modul/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_modul->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $modul) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $modul->nama_mitra;
          $row[] = '
          <a class="btn btn-minier btn-success" href="modul/download/'.$modul->file_id.'" title="Download"><i class="fa fa-download"></i></a>&nbsp
          <a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$modul->file_id."'".')"><i class="fa fa-trash"></i></a>';
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_modul->count_all(),
					"recordsFiltered" => $this->m_modul->count_filtered(),
					"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add()
	{
        $this->_validate();
        // file_name nya boleh di enkripsi pakai md5 / setiap spasi replace dengan underscore _
		$data = [
			'nama_mitra'  	=> strtoupper($this->input->post('nama_mitra'))
		];

		$this->db->insert('tb_mitra', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
    }
    
    public function download($id)
    {
        $row = $this->db->get_where('tb_files', array('file_id' => $id))->row_array();
        force_download('assets/backend/files/modul/'.$row['file_name'].'',NULL);
    }

	public function ajax_delete($id)
	{
        $this->m_modul->delete_by_id($id);
        // hapus file nya juga yaa
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed!</div>'
			)
		);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('file_title') == '')
		{
			$data['inputerror'][] = 'file_title';
			$data['error_string'][] = 'Nama File is required';
			$data['status'] = FALSE;
        }
        
        // file untuk di upload juga wajib ada

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
