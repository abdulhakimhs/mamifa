<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
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
		  $row[] = $modul->file_title;
		  $row[] = formatSizeUnits($modul->file_size);
		  $row[] = $modul->file_type;
		  $row[] = $modul->file_created;
		  if($this->session->userdata('level') == 1){
			$row[] = '
			<a class="btn btn-minier btn-success" href="'.site_url("admin/modul/download/".$modul->file_id).'" title="Download"><i class="fa fa-download"></i></a>&nbsp
			<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$modul->file_id."'".')"><i class="fa fa-trash"></i></a>';
		  }
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
		if(!empty($_FILES['file_modul']['name']))
        {
            // $nama_file 		= $_FILES['file_modul']['name'];
            $ukuran_file 	= $_FILES['file_modul']['size'];
			$tipe_file 		= $_FILES['file_modul']['type'];

			$config['upload_path']          = './assets/backend/files/modul/';
			$config['allowed_types']        = 'jpg|jpeg|png|avi|mpeg|mp4|mkv|3gp|pdf|docx|doc|xls|xlsx|ppt|pptx|zip|rar|7z';
			$config['max_size']             = 20000; //set max size allowed in Kilobyte (20mb)
			// $config['file_name']            = $nama_file;
	
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
	
			if(!$this->upload->do_upload('file_modul')) //upload and validate
			{
				$data['inputerror'][] = 'file_modul';
				$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}
        }
		
		$data = [
			'file_title'  	=> $this->input->post('file_title'),
			'file_desc'  	=> $this->input->post('file_desc'),
			'file_name'  	=> $this->upload->data('file_name'),
			'file_size'  	=> $ukuran_file,
			'file_type'  	=> $tipe_file,
			'file_created'  => date('Y-m-d'),
			'file_by'  		=> $this->session->userdata('user_id')
		];

		$this->db->insert('tb_files', $data);
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
		$row = $this->db->get_where('tb_files', array('file_id' => $id))->row_array();
        $this->m_modul->delete_by_id($id);
		// hapus file nya juga yaa
		unlink('./assets/backend/files/modul/'.$row['file_name']);
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
