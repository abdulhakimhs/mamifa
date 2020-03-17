<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_request extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trainingrequest');
	}

	public function index()
	{
		$data['title'] 			= 'Training Request';
		$data['subtitle'] 		= 'Data';

		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_request/data',$data,true)
		]);
	}

	function get_ajax() {
    $list = $this->m_trainingrequest->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $training) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $training->nik;
      $row[] = $training->nama_lengkap;
      $row[] = $training->level;
      $row[] = $training->jenis_pelatihan;
      if($training->status == 0) {
        $row[] = '<td><span class="badge badge-warning">Menunggu</span></td>';
      } else if($training->status == 1) {
        $row[] = '<td><span class="badge badge-success">Diterima</span></td>';
      } else {
        $row[] = '<td><span class="badge badge-danger">Ditolak</span></td>';
      }
      $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$training->training_request_id."'".')">
            <i class="fa fa-edit"></i>
          </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$training->training_request_id."'".')">
      <i class="fa fa-trash"></i>
      </a>';

      $data[] = $row;
    }

    $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_trainingrequest->count_all(),
                "recordsFiltered" => $this->m_trainingrequest->count_filtered(),
                "data" => $data,
            );

    echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->m_trainingrequest->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_delete($id)
  {
      $this->m_trainingrequest->delete_by_id($id);
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
              'status' => $this->input->post('status_training'),
          );
      $this->m_trainingrequest->update(array('training_request_id' => $this->input->post('id')), $data);
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

    if($this->input->post('status_training') == '')
    {
        $data['inputerror'][] = 'status_training';
        $data['error_string'][] = 'Status update is required';
        $data['status'] = FALSE;
    }

    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
  }

}
