<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monila extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_monila');
	}

	public function index()
	{
		$data['title'] 			= 'Monila';
		$data['subtitle'] 		= 'Data';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/monila/data',$data,true)
		]);
	}

	function get_ajax() {
      $list = $this->m_monila->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $monila) {
          $no++;
          $row = array();
          $row[] = $no;
          $row[] = $monila->nik;
          $row[] = $monila->nama_lengkap;
          $row[] = $monila->jenis_laporan;
          $row[] = $monila->lokasi_temuan;
          $row[] = ($monila->koordinat == '' ? '-' : $monila->koordinat) .' / '.($monila->odp == '' ? '-' : $monila->odp);
          if($monila->status == 0) {
            $row[] = '<td><span class="badge badge-warning">Belum Diterima</span></td>';
          } else {
            $row[] = '<td><span class="badge badge-success">Sudah Diterima</span></td>';
          }
          $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail('."'".$monila->monila_id."'".')">
                <i class="fa fa-edit"></i>
              </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$monila->monila_id."'".')">
      <i class="fa fa-trash"></i>
      </a>';

    $data[] = $row;
      }

      $output = array(
                  "draw" => @$_POST['draw'],
                  "recordsTotal" => $this->m_monila->count_all(),
                  "recordsFiltered" => $this->m_monila->count_filtered(),
                  "data" => $data,
              );

      echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->m_monila->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_delete($id)
  {
      $this->m_monila->delete_by_id($id);
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
              'status' => $this->input->post('status_monila'),
          );
      $this->m_monila->update(array('monila_id' => $this->input->post('id')), $data);
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

    if($this->input->post('status_monila') == '')
    {
        $data['inputerror'][] = 'status_monila';
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
