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

	private function _do_upload()
    {
        $config['upload_path']          = './assets/backend/images/bpjs/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
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
		
		$nik = $this->m_naker->get_nik($this->input->post('nik'));

		if($this->input->post('method') == 'add') {
			if($nik > 0)
			{
				$data['inputerror'][] = 'nik';
				$data['error_string'][] = 'NIK already exists';
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
