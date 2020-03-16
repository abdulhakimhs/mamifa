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
      $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
            <i class="fa fa-edit"></i>
          </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
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
}
