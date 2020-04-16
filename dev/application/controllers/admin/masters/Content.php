<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
		if($this->session->userdata('level') == 0){
		  redirect(base_url("admin"));
		}
        $this->load->model('masters/m_content');
	}

	public function index()
	{
		$data['title'] 			= 'Headline';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/content/data',$data,true)
		]);
    }
    
    public function get_ajax() {
		$list = $this->m_content->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $content) {
		  $no++;
		  $row = array();
		  $row[] = $no;
          $row[] = $content->content_title;
		  $row[] = $content->content_active == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-secondary">Draft</span>';
		  $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$content->content_id."'".')">
				<i class="fa fa-edit"></i>
			  </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$content->content_id."'".')">
		  <i class="fa fa-trash"></i>
		  </a>';
	
		  $data[] = $row;
		}
	
		$output = array(
					"draw" => @$_POST['draw'],
					"recordsTotal" => $this->m_content->count_all(),
					"recordsFiltered" => $this->m_content->count_filtered(),
					"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = [
			'content_title'  	=> strtoupper($this->input->post('content_title')),
			'content_desc'  	=> $this->input->post('content_desc'),
			'content_active'  	=> $this->input->post('content_active')
		];

		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $data['content_image'] = $upload;
        }

		$this->db->insert('tb_content', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_content->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$content = $this->m_content->get_by_id($id);
        if(file_exists('./assets/backend/images/content/'.$content->content_image) && $content->content_image)
            unlink('./assets/backend/images/content/'.$content->content_image);

		$this->m_content->delete_by_id($id);
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
			'content_title'  	=> strtoupper($this->input->post('content_title')),
			'content_desc'  	=> $this->input->post('content_desc'),
			'content_active'  	=> $this->input->post('content_active')
		];

		if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('./assets/backend/images/content/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('./assets/backend/images/content/'.$this->input->post('remove_photo'));
            $data['content_image'] = null;
        }
 
        if(!empty($_FILES['photo']['name']))
        {
			//delete file bpjs
			$content = $this->m_content->get_by_id($this->input->post('id'));
			if(file_exists('./assets/backend/images/content/'.$content->content_image) && $content->content_image)
				unlink('./assets/backend/images/content/'.$content->content_image);

            $upload = $this->_do_upload();
 
            $data['content_image'] = $upload;
        }

		$this->m_content->update(array('content_id' => $this->input->post('id')), $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	private function _do_upload()
    {
        $config['upload_path']          = './assets/backend/images/content/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
 
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
 
		if($this->input->post('content_title') == '')
        {
            $data['inputerror'][] = 'content_title';
            $data['error_string'][] = 'Judul Headline is required';
            $data['status'] = FALSE;
        }
		
		if($this->input->post('content_desc') == '')
        {
            $data['inputerror'][] = 'content_desc';
            $data['error_string'][] = 'Deskripsi is required';
            $data['status'] = FALSE;
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
