<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_targetta');
		$this->load->model('m_targetmitra');
		$this->load->model('masters/m_operation');
		$this->load->model('masters/m_pelatihan');
	}

	public function index()
	{
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Data';
		// $data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/target/tabel',$data,true)
		]);
	}

	public function upload()
	{
		if(isset($_POST['upload'])){
			/* 
				1) jika taregt untuk TA, maka insert ke tb_target_ta, jika mitra tb_target_mitra.
				2) jenis file xlsx.
			*/
			
			$this->load->library('upload'); // Load librari upload

		  	// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';

			$config['upload_path'] 		= './assets/backend/excel/';
			$config['allowed_types'] 	= 'xlsx';
			$config['max_size']  		= '10000';
			$config['overwrite'] 		= true;
	
			$this->upload->initialize($config); // Load konfigurasi uploadnya
	
			if (!$this->upload->do_upload('userfile')) {
	
				//upload gagal
				$this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
				//redirect halaman
				redirect('admin/target/upload');
	
			} else {
	
				$data_upload = $this->upload->data();
	
				$excelreader     	= new PHPExcel_Reader_Excel2007();
				$loadexcel          = $excelreader->load('assets/backend/excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
				$sheet              = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
				$data_ta = array();
				$data_mitra = array();
	
				$numrow = 1;
				foreach($sheet as $row){
					// Cek $numrow apakah lebih dari 1
					// Artinya karena baris pertama adalah nama-nama kolom
					// Jadi dilewat saja, tidak usah diimport
					if($numrow > 1){
						if($this->input->post('target_for') == 'TA') {
							//Cek apakah operation tersedia di data master
							$operation = $this->m_operation->get_by_name($row['G']);
							if(!empty($operation)){
								// Kita push (add) array data ke variabel data_ta
								array_push($data_ta, array(
									'nik'				=>$row['A'],
									'nama'				=>strtoupper($row['B']),
									'sektor'			=>strtoupper($row['C']),
									'level'				=>strtoupper($row['D']),
									'position_name'		=>strtoupper($row['E']),
									'subunit'			=>strtoupper($row['F']),
									'bulan'				=>$this->input->post('bulan'),
									'tahun'				=>$this->input->post('tahun'),
									'pelatihan_id'		=>$this->input->post('jenis_pelatihan'),
									'operation_id'		=>$operation['operation_id']
								));
							}
						} else {
							// Kita push (add) array data ke variabel data_mitra
							array_push($data_mitra, array(
								'nik'				=>$row['A'],
								'nama'				=>strtoupper($row['B']),
								'jenis_kelamin'		=>strtoupper($row['C']),
								'nama_mitra'		=>strtoupper($row['D']),
								'jenis_mitra'		=>strtoupper($row['E']),
								'pelatihan_id'		=>$this->input->post('jenis_pelatihan'),
								'jenis_teknisi'		=>strtoupper($row['F']),
								'level'				=>strtoupper($row['G']),
								'lokasi_pelatihan'	=>strtoupper($row['H']),
								'bulan'				=>$this->input->post('bulan'),
								'tahun'				=>$this->input->post('tahun'),
							));
						}
					}
					
					$numrow++; // Tambah 1 setiap kali looping
				}

				if ($this->input->post('target_for') == 'TA') {
					$this->db->insert_batch('tb_target_ta', $data_ta);
				} else {
					$this->db->insert_batch('tb_target_mitra', $data_mitra);
				}

				//delete file from server
				unlink(realpath('assets/backend/excel/'.$data_upload['file_name']));
	
				//upload success
				$this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');

				//redirect halaman
				redirect('admin/target/upload');
	
			}
		}
		$data['title'] 			= 'Target';
		$data['subtitle'] 		= 'Upload';
		$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/target/upload',$data,true)
		]);
	}

	public function grafik_ta($bulan = 'all', $tahun = 'all')
	{
		$data = $this->m_targetta->getgrafik($bulan, $tahun)->result();
		echo json_encode($data);
	}

	public function grafik_mitra($bulan = 'all', $tahun = 'all')
	{
		$data = $this->m_targetmitra->getgrafik($bulan, $tahun)->result();
		echo json_encode($data);
	}

	public function tes()
	{
		echo medium_bulan(date('m'));
	}
}
