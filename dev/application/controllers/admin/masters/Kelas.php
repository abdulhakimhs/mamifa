<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_kelas');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Kelas';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/kelas/data',$data,true)
		]);
	}

	function get_ajax() {
		$list = $this->m_kelas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelas) {
		  $no++;
		  $row = array();
		  $row[] = $no;
		  $row[] = $kelas->nama_kelas;
		  if($kelas->status == 1) {
			$row[] = '<span class="label label-success">Aktif</span>';
		  } else {
			$row[] = '<span class="label label-danger">Tidak Aktif</span>';
		  }
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$kelas->kelas_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$kelas->kelas_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_kelas->count_all(),
					"recordsFiltered" => $this->m_kelas->count_filtered(),
					"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'nama_kelas'  	=> $this->input->post('nama_kelas'),
			'status'  		=> $this->input->post('status')
		];

		$this->db->insert('tb_kelas', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_kelas->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_kelas->delete_by_id($id);
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
		$data = array(
				'nama_kelas'  	=> $this->input->post('nama_kelas'),
				'status'  		=> $this->input->post('status')
			);
		$this->m_kelas->update(array('kelas_id' => $this->input->post('id')), $data);
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

		if($this->input->post('nama_kelas') == '')
		{
			$data['inputerror'][] = 'nama_kelas';
			$data['error_string'][] = 'Nama Kelas is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
