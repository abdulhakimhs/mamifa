<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		$this->load->model('m_targetta');
		$this->load->model('m_nilai_ta');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Penilaian TA';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilian'] 		= $this->m_targetta->gettabelpenilaian()->result_array();
		$data['tabel_penilian_total'] 	= $this->m_targetta->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/ta/data',$data,true)
		]);
	}

	public function ambil_grafik($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
	{
		$data['isi'] = $this->m_targetta->gettabelpenilaian($bulan, $tahun, $pelatihan)->result_array();
		$data['total'] = $this->m_targetta->gettabelpenilaiantotal($bulan, $tahun, $pelatihan)->row_array();

		echo json_encode($data);
	}

	public function show($unit = 'all', $level='all', $pelatihan='all')
	{
		$data['title'] 		= 'Penilaian TA';
		$data['subtitle'] 	= strtoupper($unit).' | '.strtoupper($level);
		$data['material'] 	= $this->m_material->stok_tersedia()->result_array();
		$data['rowdata']	= $this->m_targetta->show($unit,$level,$pelatihan)->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/ta/show',$data,true)
		]);
	}

	public function detail($id)
	{
		$data = $this->m_targetta->get_by_id($id);
		echo json_encode($data);
	}

	public function insert_nilai()
	{
		$this->_validate();
		$data = array(
                'target_id' 	=> $this->input->post('id'),
                'roleplay' 		=> $this->input->post('roleplay'),
                'pre_test' 		=> $this->input->post('pre_test'),
                'post_test' 	=> $this->input->post('post_test'),
                'post_test' 	=> $this->input->post('post_test'),
                'kehadiran' 	=> $this->input->post('kehadiran'),
                'lokasi' 		=> $this->input->post('lokasi'),
                'periode_tgl' 	=> $this->input->post('periode_tgl'),
                'keterangan' 	=> $this->input->post('keterangan'),
			);
		$material 	= $this->input->post('material');
		$jumlah 	= $this->input->post('jumlah');
		
        $insert = $this->m_nilai_ta->save($data);
        if ($insert) {
        	$update = array(
        		'status' 	=> 1,
        	);
        	$this->db->where('target_id', $this->input->post('id'));
        	$this->db->update('tb_target_ta', $update);
		}

		//Cek apakah ada inputan material
		if($material[0] != "") {
			//Variabel yang menampung transaksi
			$m_transaksi = [];
			
			//Perulangan untuk mengambil nilai material transaksi
			foreach ($material as $key => $m) {
				//Cek stok material saat ini
				$stok = $this->m_material->cek_stok($m)->row_array();
				//Pengurangan stok material
				$saldo = $stok['stok'] - $jumlah[$key];
				//Mengisi variabel material transaksi
				$m_transaksi[] = [
					'material_id'	=> $m,
					'jumlah'		=> $jumlah[$key],
					'sumber_tujuan'	=> $this->input->post('nama_pelatihan'),
					'tanggal'		=> $this->input->post('periode_tgl'),
					'status'		=> 0,
					'saldo'			=> $saldo
				];
				//Mengupdate stok material
				$this->m_material->update(['material_id' => $m], ['stok' => $saldo]);
			}
	
			//Menginputkan data ke database secara massal (array)
			$this->db->insert_batch('tb_material_trans', $m_transaksi);
		}

        echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Nilai successfully inserted!</div>'
			)
		);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		$roleplay 	= $this->input->post('roleplay');
		$pre_test 	= $this->input->post('pre_test');
		$post_test 	= $this->input->post('post_test');
		$kehadiran 	= $this->input->post('kehadiran');

		if(empty($roleplay) && empty($pre_test) && !empty($post_test) && empty($kehadiran)){
			if($this->input->post('periode_tgl') == '')
			{
				$data['inputerror'][] = 'periode_tgl';
				$data['error_string'][] = 'Periode Tanggal is required';
				$data['status'] = FALSE;
			}

			$material = $this->input->post('material');
			$jumlah = $this->input->post('jumlah');
	
			if(!empty($material))
			{
				foreach ($material as $key => $m) {
					$cek_stok = $this->m_material->cek_stok($m)->row_array();
					if($jumlah[$key] > $cek_stok['stok']) {
						$data['inputerror'][] = "material$key";
						$data['error_string'][] = 'Jumlah melebihi batas stok material';
						$data['status'] = FALSE;
					}
				}
			}
	
			if($data['status'] === FALSE)
			{
				echo json_encode($data);
				exit();
			}
		} else {
			if($this->input->post('periode_tgl') == '')
			{
				$data['inputerror'][] = 'periode_tgl';
				$data['error_string'][] = 'Periode Tanggal is required';
				$data['status'] = FALSE;
			}
	
			if($this->input->post('roleplay') == '')
			{
				$data['inputerror'][] = 'roleplay';
				$data['error_string'][] = 'Role Play is required';
				$data['status'] = FALSE;
			}
	
			if($this->input->post('pre_test') == '')
			{
				$data['inputerror'][] = 'pre_test';
				$data['error_string'][] = 'Pre Test is required';
				$data['status'] = FALSE;
			}
	
			if($this->input->post('post_test') == '')
			{
				$data['inputerror'][] = 'post_test';
				$data['error_string'][] = 'Post Test is required';
				$data['status'] = FALSE;
			}
	
			if($this->input->post('kehadiran') == '')
			{
				$data['inputerror'][] = 'kehadiran';
				$data['error_string'][] = 'Kehadiran is required';
				$data['status'] = FALSE;
			}
	
			$material = $this->input->post('material');
			$jumlah = $this->input->post('jumlah');
	
			if(!empty($material))
			{
				foreach ($material as $key => $m) {
					$cek_stok = $this->m_material->cek_stok($m)->row_array();
					if($jumlah[$key] > $cek_stok['stok']) {
						$data['inputerror'][] = "material$key";
						$data['error_string'][] = 'Jumlah melebihi batas stok material';
						$data['status'] = FALSE;
					}
				}
			}
	
			if($data['status'] === FALSE)
			{
				echo json_encode($data);
				exit();
			}
		}
	}
}

/* End of file Ta.php */
/* Location: ./application/controllers/admin/penilaian/Ta.php */