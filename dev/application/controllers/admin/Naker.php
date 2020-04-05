<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Naker extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('m_naker');
	}

	public function index()
	{
		$data['title'] 			= 'Naker';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/naker/data',$data,true)
		]);
    }
    
    public function get_ajax() {
		$list = $this->m_naker->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $naker) {
		  $no++;
		  $row = array();
		  $row[] = $no;
          $row[] = $naker->nik;
          $row[] = $naker->nama;
          $row[] = $naker->position_title;
          $row[] = $naker->position_name;
          $row[] = $naker->sektor;
          $row[] = $naker->rayon;
          $row[] = $naker->level;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$naker->naker_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$naker->naker_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_naker->count_all(),
					"recordsFiltered" => $this->m_naker->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'nik'  				=> $this->input->post('nik'),
			'nama'  			=> $this->input->post('nama'),
			'position_name'  	=> $this->input->post('position_name'),
			'position_title'  	=> $this->input->post('position_title'),
			'sektor'  			=> $this->input->post('sektor'),
			'rayon'  			=> $this->input->post('rayon'),
			'level'  			=> $this->input->post('level')
		];

		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $data['bpjs'] = $upload;
        }

		$this->db->insert('tb_naker', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_naker->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		//delete file bpjs
		$naker = $this->m_naker->get_by_id($id);
        if(file_exists('./assets/backend/images/bpjs/'.$naker->bpjs) && $naker->bpjs)
            unlink('./assets/backend/images/bpjs/'.$naker->bpjs);

		$this->m_naker->delete_by_id($id);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed!</div>'
			)
		);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = [
			'position_name'  	=> $this->input->post('position_name'),
			'position_title'  	=> $this->input->post('position_title'),
			'sektor'  			=> $this->input->post('sektor'),
			'rayon'  			=> $this->input->post('rayon'),
			'level'  			=> $this->input->post('level')
		];

		if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('./assets/backend/images/bpjs/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('./assets/backend/images/bpjs/'.$this->input->post('remove_photo'));
            $data['bpjs'] = null;
        }
 
        if(!empty($_FILES['photo']['name']))
        {
			//delete file bpjs
			$naker = $this->m_naker->get_by_id($this->input->post('id'));
			if(file_exists('./assets/backend/images/bpjs/'.$naker->bpjs) && $naker->bpjs)
				unlink('./assets/backend/images/bpjs/'.$naker->bpjs);

            $upload = $this->_do_upload();
 
            $data['bpjs'] = $upload;
        }

		$this->m_naker->update(array('naker_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}
	
	public function upload()
	{
		$data = array();
	    if(isset($_POST['upload'])){
			/* 
				1) jika nama naker sudah ada pada database, maka update data naker tsb dengan data di excel yg di upload. 
				namun jika nama naker belum ada di database, maka insert data naker tsb .
				2) jenis file xlsx.
				3) hanya upload data saja, foto BPJS bisa di NULL kan terlebih dahulu.
				4) upload foto BPJS akan dilakukan manual oleh admin nanti.  
			*/

			$this->load->library('upload'); // Load librari upload

		  	// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';

			$config['upload_path'] 		= './assets/backend/excel/';
			$config['allowed_types'] 	= 'xlsx';
			$config['max_size']  		= '10000';
			$config['overwrite'] 		= true;
	
			$this->upload->initialize($config); // Load konfigurasi uploadnya
	
			if (!$this->upload->do_upload('file')) {
	
				//upload gagal
				$this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
				//redirect halaman
				redirect('admin/naker/upload');
	
			} else {
	
				$data_upload = $this->upload->data();
	
				$excelreader     	= new PHPExcel_Reader_Excel2007();
				$loadexcel          = $excelreader->load('assets/backend/excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
				$sheet              = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
				$data_insert = array();
				$data_update = array();
	
				$numrow = 1;
				foreach($sheet as $row){
					// Cek $numrow apakah lebih dari 1
					// Artinya karena baris pertama adalah nama-nama kolom
					// Jadi dilewat saja, tidak usah diimport
					if($numrow > 1){
						if($this->m_naker->get_by_nama($row['D']) > 0) {
							// Kita push (add) array data ke variabel data_update
							array_push($data_update, array(
								'position_name'		=>$row['A'],
								'position_title'	=>$row['B'],
								'nik'				=>$row['C'],
								'nama'				=>$row['D'],
								'sektor'			=>$row['E'],
								'rayon'				=>$row['F'],
								'level'				=>$row['K']
							));
						} else {
							// Kita push (add) array data ke variabel data_insert
							array_push($data_insert, array(
								'position_name'		=>$row['A'],
								'position_title'	=>$row['B'],
								'nik'				=>$row['C'],
								'nama'				=>$row['D'],
								'sektor'			=>$row['E'],
								'rayon'				=>$row['F'],
								'level'				=>$row['K']
							));
						}
					}
					
					$numrow++; // Tambah 1 setiap kali looping
				}

				if(!empty($data_insert)) {
					$this->db->insert_batch('tb_naker', $data_insert);
				}

				if(!empty($data_update)) {
					$this->db->update_batch('tb_naker', $data_update, 'nama');
				}

				//delete file from server
				unlink(realpath('assets/backend/excel/'.$data_upload['file_name']));
	
				//upload success
				$this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');

				//redirect halaman
				redirect('admin/naker/upload');
	
			}
		}
		
	    $data['title'] 		 = 'Naker';
		$data['subtitle'] 	 = 'Upload Naker';
	    $this->load->view('backend/template',[
			'content' => $this->load->view('backend/naker/upload',$data,true)
		]);
	}

	private function _do_upload()
    {
        $config['upload_path']          = './assets/backend/images/bpjs/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
        $config['file_name']            = $this->input->post('nik'); //just milisecond timestamp fot unique name
 
		// $this->load->library('upload', $config);
		$this->upload->initialize($config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
	}
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
		$data['status'] = TRUE;
		
		$nama = $this->m_naker->get_by_nama($this->input->post('nama'));

		if($this->input->post('method') == 'add') {
			if($nama > 0)
			{
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Nama already exists';
				$data['status'] = FALSE;
			}			
		}
 
		if($this->input->post('nik') == '')
        {
            $data['inputerror'][] = 'nik';
            $data['error_string'][] = 'NIK is required';
            $data['status'] = FALSE;
        }
		
		if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
