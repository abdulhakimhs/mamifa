<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
        redirect(base_url("admin/auth"));
    }
    if($this->session->userdata('level') == 0){
      redirect(base_url("admin"));
    }
		$this->load->model('masters/m_pelatihan');
	}

	public function index()
	{
		$data['title'] 			= 'Master Data';
		$data['subtitle'] 		= 'Pelatihan';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/masters/pelatihan/data',$data,true)
		]);
	}

	function get_ajax() {
    $list = $this->m_pelatihan->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $pelatihan) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $pelatihan->jenis_pelatihan;
      if($pelatihan->status == 1) {
        $row[] = '<span class="label label-success">Aktif</span>';
      } else {
        $row[] = '<span class="label label-danger">Tidak Aktif</span>';
      }
      $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$pelatihan->pelatihan_id."'".')">
            <i class="fa fa-edit"></i>
          </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$pelatihan->pelatihan_id."'".')">
      <i class="fa fa-trash"></i>
      </a>';

      $data[] = $row;
    }

    $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_pelatihan->count_all(),
                "recordsFiltered" => $this->m_pelatihan->count_filtered(),
                "data" => $data,
            );

    echo json_encode($output);
  }

  public function ajax_add()
  {
      $this->_validate();
      $data = [
        'jenis_pelatihan'   => strtoupper($this->input->post('jenis_pelatihan')),
        'status'            => strtoupper($this->input->post('status'))
      ];

      $this->db->insert('tb_pelatihan', $data);
      echo json_encode(
        array(
            "status" => TRUE,
            'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
        )
      );
  }

  public function ajax_edit($id)
  {
    $data = $this->m_pelatihan->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_delete($id)
  {
      $this->m_pelatihan->delete_by_id($id);
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
        'jenis_pelatihan'   => strtoupper($this->input->post('jenis_pelatihan')),
        'status'            => strtoupper($this->input->post('status'))
      );
      $this->m_pelatihan->update(array('pelatihan_id' => $this->input->post('id')), $data);
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

    if($this->input->post('jenis_pelatihan') == '')
    {
        $data['inputerror'][] = 'jenis_pelatihan';
        $data['error_string'][] = 'Jenis Pelatihan is required';
        $data['status'] = FALSE;
    }

    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
  }

}