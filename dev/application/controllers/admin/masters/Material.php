<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
		$this->load->model('masters/m_material');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Material';
		$data['material']		= $this->m_material->ambil()->result_array();
		$data['material_2']		= $this->m_material->ambilSelainHabisPakai()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/material/data',$data,true)
		]);
	}

	public function get_ajax() {
		$list = $this->m_material->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mat) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $mat->material;
		  $row[] = $mat->merk;
		  $row[] = $mat->type;
		  if($mat->jenis == "HABIS PAKAI") {
			$row[] = '<span class="label label-success">'.$mat->jenis.'</span>';
		  } else if ($mat->jenis == "MATERIAL") {
			$row[] = '<span class="label label-primary">'.$mat->jenis.'</span>';
		  } else {
			$row[] = '<span class="label label-warning">'.$mat->jenis.'</span>';
		  }
		  $row[] = $mat->satuan; 
		  $row[] = $mat->stok;
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$mat->material_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$mat->material_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_material->count_all(),
					"recordsFiltered" => $this->m_material->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'material'  => strtoupper($this->input->post('material')),
			'merk'  	=> strtoupper($this->input->post('merk')),
			'type'  	=> strtoupper($this->input->post('type')),
			'jenis'  	=> strtoupper($this->input->post('jenis')),
			'satuan'  	=> strtolower($this->input->post('satuan'))
		];

		$this->db->insert('tb_material', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_material->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_material->delete_by_id($id);
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
			'material'  => strtoupper($this->input->post('material')),
			'merk'  	=> strtoupper($this->input->post('merk')),
			'type'  	=> strtoupper($this->input->post('type')),
			'jenis'  	=> strtoupper($this->input->post('jenis')),
			'satuan'  	=> strtolower($this->input->post('satuan'))
		];
		$this->m_material->update(array('material_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('material') == '')
		{
			$data['inputerror'][] = 'material';
			$data['error_string'][] = 'Material is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis') == '')
		{
			$data['inputerror'][] = 'jenis';
			$data['error_string'][] = 'Jenis is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('satuan') == '')
		{
			$data['inputerror'][] = 'satuan';
			$data['error_string'][] = 'Satuan is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function material_masuk()
	{
		$this->_validate_masuk();

		$stok = $this->m_material->cek_stok($this->input->post('material_id'))->row_array();
		$saldo = $this->input->post('jumlah_masuk') + $stok['stok'];

		$data = [
			'material_id'  	=> $this->input->post('material_id'),
			'jumlah'  		=> $this->input->post('jumlah_masuk'),
			'sumber_tujuan' => strtoupper($this->input->post('sumber')),
			'tanggal'  		=> $this->input->post('tanggal'),
			'status'  		=> 1,
			'saldo'  		=> $saldo,
			'keterangan'  	=> $this->input->post('keterangan')
		];

		$this->m_material->update(['material_id' => $this->input->post('material_id')], ['stok' => $saldo]);
		$this->db->insert('tb_material_trans', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}
	
	public function material_keluar()
	{
		$this->_validate_keluar();

		$stok = $this->m_material->cek_stok($this->input->post('material_keluar'))->row_array();
		$saldo = $stok['stok'] - $this->input->post('jumlah_keluar');

		$data = [
			'material_id'  	=> $this->input->post('material_keluar'),
			'jumlah'  		=> $this->input->post('jumlah_keluar'),
			'sumber_tujuan' => $this->input->post('keterangan_keluar'),
			'tanggal'  		=> $this->input->post('tanggal_keluar'),
			'status'  		=> 0,
			'saldo'  		=> $saldo,
			'keterangan'  	=> $this->input->post('keterangan_keluar')
		];

		$this->m_material->update(['material_id' => $this->input->post('material_keluar')], ['stok' => $saldo]);
		$this->db->insert('tb_material_trans', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	private function _validate_masuk()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('material_id') == '')
		{
			$data['inputerror'][] = 'material_id';
			$data['error_string'][] = 'Material is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jumlah_masuk') == '')
		{
			$data['inputerror'][] = 'jumlah_masuk';
			$data['error_string'][] = 'Jumlah Masuk is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('sumber') == '')
		{
			$data['inputerror'][] = 'sumber';
			$data['error_string'][] = 'Sumber is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('tanggal') == '')
		{
			$data['inputerror'][] = 'tanggal';
			$data['error_string'][] = 'Tanggal is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_keluar()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('material_keluar') == '')
		{
			$data['inputerror'][] = 'material_keluar';
			$data['error_string'][] = 'Material is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jumlah_keluar') == '')
		{
			$data['inputerror'][] = 'jumlah_keluar';
			$data['error_string'][] = 'Jumlah Keluar is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('tanggal_keluar') == '')
		{
			$data['inputerror'][] = 'tanggal_keluar';
			$data['error_string'][] = 'Tanggal is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('keterangan_keluar') == '')
		{
			$data['inputerror'][] = 'keterangan_keluar';
			$data['error_string'][] = 'Keterangan is required';
			$data['status'] = FALSE;
		}

		$material = $this->input->post('material_keluar');
		$jumlah = $this->input->post('jumlah_keluar');

		if(!empty($material))
		{
			$cek_stok = $this->m_material->cek_stok($material)->row_array();
			if($jumlah > $cek_stok['stok']) {
				$data['inputerror'][] = "jumlah_keluar";
				$data['error_string'][] = 'Jumlah melebihi batas stok material';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function cek_stok($id)
	{
		$data = $this->m_material->cek_stok($id)->row_array();
		echo json_encode($data);
	}

	public function tes($id)
	{
		$stok = $this->m_material->cek_stok($id)->row_array();

		echo $stok['stok'];
	}

}

/* End of file Material.php */
/* Location: ./application/controllers/admin/masters/Material.php */