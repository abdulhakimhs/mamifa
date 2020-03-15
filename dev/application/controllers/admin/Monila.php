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
            $row[] = $monila->odp_koordinat;
            if($monila->status == 0) {
              $row[] = '<td><span class="badge badge-warning">Belum Diterima</span></td>';
            } else {
              $row[] = '<td><span class="badge badge-danger">Sudah Diterima</span></td>';
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
                    "recordsTotal" => $this->m_monila->count_all(),
                    "recordsFiltered" => $this->m_monila->count_filtered(),
                    "data" => $data,
                );

        echo json_encode($output);
    }
}
