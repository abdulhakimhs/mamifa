<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
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
      $row[] = '<a class="btn btn-minier btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail()">
            <i class="fa fa-edit"></i>
          </a>&nbsp<a class="btn btn-minier btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data()">
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

}