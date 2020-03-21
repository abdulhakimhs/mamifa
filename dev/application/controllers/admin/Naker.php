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
		$data = [
			'nik'  				=> $this->input->post('nik'),
			'nama'  			=> $this->input->post('nama'),
			'position_name'  	=> $this->input->post('position_name'),
			'position_title'  	=> $this->input->post('position_title'),
			'sektor'  			=> $this->input->post('sektor'),
			'rayon'  			=> $this->input->post('rayon'),
			'level'  			=> $this->input->post('level')
		];

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
		$data = [
			'nik'  				=> $this->input->post('nik'),
			'nama'  			=> $this->input->post('nama'),
			'position_name'  	=> $this->input->post('position_name'),
			'position_title'  	=> $this->input->post('position_title'),
			'sektor'  			=> $this->input->post('sektor'),
			'rayon'  			=> $this->input->post('rayon'),
			'level'  			=> $this->input->post('level')
		];
		$this->m_naker->update(array('naker_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}
}
