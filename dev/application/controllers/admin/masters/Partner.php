<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
        $this->load->model('masters/m_partner');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Foto';
		$data['foto']			= $this->m_partner->getAll()->result();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/partner/data',$data,true)
		]);
    }
    
    public function get_ajax() {
		$list = $this->m_partner->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $slider) {
		  $no++;
		  $row = array();
		  $row[] = $no;
          $row[] = $slider->slide_title;
		  $row[] = $slider->slide_active == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-secondary">Draft</span>';
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$slider->slide_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$slider->slide_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_partner->count_all(),
					"recordsFiltered" => $this->m_partner->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'partner_name'  => strtoupper($this->input->post('partner_name')),
		];

		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $data['photo'] = $upload;
        }

		$this->db->insert('tb_partner', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_partner->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$partner = $this->m_partner->get_by_id($id);
        if(file_exists('./assets/backend/images/gallery/'.$partner->photo) && $partner->photo)
            unlink('./assets/backend/images/gallery/'.$partner->photo);

		$this->m_partner->delete_by_id($id);
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
			'slide_title'  	=> strtoupper($this->input->post('slide_title')),
			'slide_desc'  	=> ucfirst($this->input->post('slide_desc')),
			'slide_active'  => $this->input->post('slide_active')
		];

		if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('./assets/backend/images/slider/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('./assets/backend/images/slider/'.$this->input->post('remove_photo'));
            $data['slide_image'] = null;
        }
 
        if(!empty($_FILES['photo']['name']))
        {
			$slide = $this->m_partner->get_by_id($this->input->post('id'));
			if(file_exists('./assets/backend/images/slider/'.$slide->slide_image) && $slide->slide_image)
				unlink('./assets/backend/images/slider/'.$slide->slide_image);

            $upload = $this->_do_upload();
 
            $data['slide_image'] = $upload;
        }

		$this->m_partner->update(array('slide_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	private function _do_upload()
    {
        $config['upload_path']          = './assets/backend/images/gallery/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 2000; //set max size allowed in Kilobyte
 
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
 
		if($this->input->post('partner_name') == '')
        {
            $data['inputerror'][] = 'partner_name';
            $data['error_string'][] = 'Judul Foto is required';
            $data['status'] = FALSE;
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
