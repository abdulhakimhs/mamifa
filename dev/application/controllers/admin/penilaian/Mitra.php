<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_targetmitra');
		$this->load->model('m_nilai_mitra');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 					= 'Target';
		$data['subtitle'] 				= 'Penilaian Mitra';
		$data['jenis_pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$data['tabel_penilaian']		= $this->m_targetmitra->gettabelpenilaian()->result_array();
		$data['tabel_penilaian_total']	= $this->m_targetmitra->gettabelpenilaiantotal()->row_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/mitra/data',$data,true)
		]);
	}

	public function ambil_grafik($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
	{
		$data['isi'] = $this->m_targetmitra->gettabelpenilaian($bulan, $tahun, $pelatihan)->result_array();
		$data['total'] = $this->m_targetmitra->gettabelpenilaiantotal($bulan, $tahun, $pelatihan)->row_array();

		echo json_encode($data);
	}

	public function show($mitra = 'all', $level='all', $pelatihan='all')
	{
		$data['title'] 		= 'Penilaian Mitra';
		$data['subtitle'] 	= strtoupper($mitra).' | '.strtoupper($level);
		$data['material'] 	= $this->m_material->stok_tersedia()->result_array();
		$data['rowdata']	= $this->m_targetmitra->show($mitra,$level,$pelatihan)->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/penilaian/mitra/show',$data,true)
		]);
	}

	public function detail($id)
	{
		$data = $this->m_targetmitra->get_by_id($id);
		echo json_encode($data);
	}

	public function insert_nilai()
	{
		$this->_validate();
		$data = array(
                'target_m_id' 	=> $this->input->post('id'),
                'lokasi' 		=> $this->input->post('lokasi'),
                'tgl_mulai' 	=> $this->input->post('tgl_mulai'),
                'tgl_selesai' 	=> $this->input->post('tgl_selesai'),
                'nilai' 		=> $this->input->post('nilai'),
                'keterangan' 	=> $this->input->post('keterangan'),
			);
		$material 	= $this->input->post('material');
		$jumlah 	= $this->input->post('jumlah');
		
        $insert = $this->m_nilai_mitra->save($data);
        if ($insert) {
        	$update = array(
        		'status' 	=> 1,
        	);
        	$this->db->where('target_m_id', $this->input->post('id'));
        	$this->db->update('tb_target_mitra', $update);
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
					'tanggal'		=> $this->input->post('tgl_selesai'),
					'status'		=> 1,
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

		if($this->input->post('tgl_mulai') == '')
		{
			$data['inputerror'][] = 'tgl_mulai';
			$data['error_string'][] = 'Tanggal Mulai is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('tgl_selesai') == '')
		{
			$data['inputerror'][] = 'tgl_selesai';
			$data['error_string'][] = 'Tanggal Selesai is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nilai') == '')
		{
			$data['inputerror'][] = 'nilai';
			$data['error_string'][] = 'Nilai is required';
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

/* End of file Mitra.php */
/* Location: ./application/controllers/admin/penilaian/Mitra.php */