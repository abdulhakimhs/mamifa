<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("admin/auth"));
        }
        if($this->session->userdata('level') == 0){
          redirect(base_url("admin"));
        }
        $this->load->model('m_users');
	}

	public function index()
	{
		$data['title'] 		    = 'Users';
		$data['subtitle'] 	    = 'Web';
        $this->load->view('backend/template',[
			'content' => $this->load->view('backend/users/data',$data,true)
		]);
	}

	public function users_list()
    {
        $list = $this->m_users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $row = array();
            if ($users->level == 1) {
            	$level = '<span class="label label-danger">Admin</span>';
            }
            else{
            	$level = '<span class="label label-default">Tamu</span>';
            }
            $row[] = $no;
            $row[] = $users->email;
            $row[] = $users->fullname;
            $row[] = $level;
            $row[] = $users->active == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Blocked</span>';
            $row[] = $users->last_login;

            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_users('."'".$users->users_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_users('."'".$users->users_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_users->count_all(),
                        "recordsFiltered" => $this->m_users->count_filtered(),
                        "data" => $data,
                );

        echo json_encode($output);
    }

    public function users_edit($id)
    {
        $data = $this->m_users->get_by_id($id);
        echo json_encode($data);
    }

    public function users_add()
    {
        $this->_validate();
		$data = array(
            'username' 		=> str_replace(' ', '_', strtolower($this->input->post('fullname'))),
            'password' 		=> bCrypt('fapekl', 12),
            'email' 		=> $this->input->post('email'),
            'level' 		=> $this->input->post('level'),
            'fullname' 		=> $this->input->post('fullname'),
            'active' 		=> $this->input->post('active'),
        );
        $insert = $this->m_users->save($data);
        echo json_encode(
        	array(
        		"status" => TRUE,
        		'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> User successfully added!</div>'
        	)
        );
    }

    public function users_update()
    {
        //$this->_validate();
        $data = array(
                'username' 		=> str_replace(' ', '_', $this->input->post('fullname')),
                'email' 		=> $this->input->post('email'),
                'level' 		=> $this->input->post('level'),
                'fullname' 		=> $this->input->post('fullname'),
                'active' 		=> $this->input->post('active'),
            );
        $this->m_users->update(array('users_id' => $this->input->post('id')), $data);
        echo json_encode(
        	array(
        		"status" => TRUE,
        		'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> User successfully changed!</div>'
        	)
        );
    }

    public function users_delete($id)
    {
        $this->m_users->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $post = $this->input->post(NULL, TRUE);
        $cek  = $this->db->query("SELECT email FROM tb_users where email='".$post['email']."'")->num_rows();
 
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('fullname') == '')
        {
            $data['inputerror'][] = 'fullname';
            $data['error_string'][] = 'Fullname is required';
            $data['status'] = FALSE;
        }

        if ($cek > 0) {
        	$data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is already used, use another email';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Web.php */
/* Location: ./application/controllers/users/Web.php */