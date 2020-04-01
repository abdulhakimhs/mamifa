<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_plan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_trainingplan');
		$this->load->model('masters/m_mitra');
		$this->load->model('masters/m_pelatihan');
		$this->load->model('masters/m_training');
	}

	public function index()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Training Plan';

		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_plan/search',$data,true)
		]);
	}

	public function add()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Add Training Plan';
		$data['mitra'] 			= $this->m_mitra->ambil()->result_array();
		$data['pelatihan'] 		= $this->m_pelatihan->ambil()->result_array();
		$data['training'] 		= $this->m_training->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_plan/add',$data,true)
		]);
	}

	public function search_plan()
	{
		$data['title'] 			= 'ADMIN MAMI FA';
		$data['subtitle'] 		= 'Show Training Plan';
		$data['mitra'] 			= $this->m_mitra->ambil()->result_array();
		$data['pelatihan'] 		= $this->m_pelatihan->ambil()->result_array();
		$data['training'] 		= $this->m_training->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/training_plan/show',$data,true)
		]);
	}

	public function ajax_get($tglawal)
	{
		$data = $this->m_trainingplan->ambil($tglawal)->result();

		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$data = [
			'tgl_awal'  		=> $this->input->post('ftgl_awal'),
			'tgl_akhir'  		=> $this->input->post('ftgl_akhir'),
			'nama_pengajar'		=> strtoupper($this->input->post('nama_pengajar')),
			'pelatihan_id'  	=> $this->input->post('jenis_pelatihan'),
			'not_id'  			=> $this->input->post('name_of_training'),
			'ta_bop'  			=> $this->input->post('ta_bop') == '' ? null : $this->input->post('ta_bop'),
			'ta_pelatihan'  	=> $this->input->post('ta_pelatihan') == '' ? null : $this->input->post('ta_pelatihan'),
			'mitra_pelatihan'  	=> $this->input->post('mitra_pelatihan') == '' ? null : $this->input->post('mitra_pelatihan'),
			'mitra_id'  		=> $this->input->post('nama_mitra') == '' ? null : $this->input->post('nama_mitra'),
			'staff_teknisi'  	=> $this->input->post('staff_teknisi') == null ? 0 : 1,
			'team_leader'  		=> $this->input->post('team_leader') == null ? 0 : 1,
			'officer'  			=> $this->input->post('officer') == null ? 0 : 1,
			'site_manager'  	=> $this->input->post('site_manager') == null ? 0 : 1,
			'mgr'  				=> $this->input->post('mgr') == null ? 0 : 1,
			'mitra'  			=> $this->input->post('mitra') == null ? 0 : 1,
			'senin'  			=> $this->input->post('senin') == null ? 0 : 1,
			'selasa'  			=> $this->input->post('selasa') == null ? 0 : 1,
			'rabu'  			=> $this->input->post('rabu') == null ? 0 : 1,
			'kamis'  			=> $this->input->post('kamis') == null ? 0 : 1,
			'jumat'  			=> $this->input->post('jumat') == null ? 0 : 1
		];

		$this->db->insert('tb_training_plan', $data);
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully added!</div>'
			)
		);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_trainingplan->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->m_trainingplan->delete_by_id($id);
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
			'tgl_awal'  		=> $this->input->post('ftgl_awal'),
			'tgl_akhir'  		=> $this->input->post('ftgl_akhir'),
			'nama_pengajar'		=> $this->input->post('nama_pengajar'),
			'pelatihan_id'  	=> $this->input->post('jenis_pelatihan'),
			'not_id'  			=> $this->input->post('name_of_training'),
			'ta_bop'  			=> $this->input->post('ta_bop') == '' ? null : $this->input->post('ta_bop'),
			'ta_pelatihan'  	=> $this->input->post('ta_pelatihan') == '' ? null : $this->input->post('ta_pelatihan'),
			'mitra_pelatihan'  	=> $this->input->post('mitra_pelatihan') == '' ? null : $this->input->post('mitra_pelatihan'),
			'mitra_id'  		=> $this->input->post('nama_mitra') == '' ? null : $this->input->post('nama_mitra'),
			'staff_teknisi'  	=> $this->input->post('staff_teknisi') == null ? 0 : 1,
			'team_leader'  		=> $this->input->post('team_leader') == null ? 0 : 1,
			'officer'  			=> $this->input->post('officer') == null ? 0 : 1,
			'site_manager'  	=> $this->input->post('site_manager') == null ? 0 : 1,
			'mgr'  				=> $this->input->post('mgr') == null ? 0 : 1,
			'mitra'  			=> $this->input->post('mitra') == null ? 0 : 1,
			'senin'  			=> $this->input->post('senin') == null ? 0 : 1,
			'selasa'  			=> $this->input->post('selasa') == null ? 0 : 1,
			'rabu'  			=> $this->input->post('rabu') == null ? 0 : 1,
			'kamis'  			=> $this->input->post('kamis') == null ? 0 : 1,
			'jumat'  			=> $this->input->post('jumat') == null ? 0 : 1
		];

		$this->m_trainingplan->update(array('training_plan_id' => $this->input->post('id')), $data);
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

		if($this->input->post('nama_pengajar') == '')
		{
			$data['inputerror'][] = 'nama_pengajar';
			$data['error_string'][] = 'Nama Pengajar is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis_pelatihan') == '')
		{
			$data['inputerror'][] = 'jenis_pelatihan';
			$data['error_string'][] = 'Jenis Pelatihan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('name_of_training') == '')
		{
			$data['inputerror'][] = 'name_of_training';
			$data['error_string'][] = 'Name Of Training is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ftgl_awal') == null)
		{
			$data['inputerror'][] = 'ftgl_awal';
			$data['error_string'][] = 'Tanggal Awal is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ftgl_akhir') == null)
		{
			$data['inputerror'][] = 'ftgl_akhir';
			$data['error_string'][] = 'Tanggal Akhir is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function cetak($ftgl_awal_search)
    {
		if(date('m',strtotime($ftgl_awal_search)) == date('m',strtotime($ftgl_awal_search . "+4 days"))) {
			$title_date = date('d',strtotime($ftgl_awal_search)) ." - ". date_indo(date('Y-m-d',strtotime($ftgl_awal_search . "+4 days")));
		} else {
			$title_date = date_indo($ftgl_awal_search) ." - ". date_indo(date('Y-m-d',strtotime($ftgl_awal_search . "+4 days")));
		}

		if(date('m',strtotime($ftgl_awal_search)) == date('m',strtotime($ftgl_awal_search . "+4 days"))) {
			$bln_thn = bln_indo(date('Y-m-d',strtotime($ftgl_awal_search . "+4 days")));
		} else {
			$bln_thn = bln_indo($ftgl_awal_search) ." - ". bln_indo(date('Y-m-d',strtotime($ftgl_awal_search . "+4 days")));
		}

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $excel = new PHPExcel();
        
        $excel->getProperties()->setCreator('FIBER ACADEMY PEKALONGAN')
                     ->setLastModifiedBy('FIBER ACADEMY PEKALONGAN')
                     ->setTitle("Training Plan")
                     ->setSubject("Admin")
                     ->setDescription("Laporan Training Plan")
                     ->setKeywords("Training Plan");
        
        $style_col = array(
          'font' => array('bold' => true),
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
          )
        );
        
        $style_row_normal = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
          )
		);

		$style_row_tengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
			  'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
			  'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
			  'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
			  'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		  );
		
		//Set Judul
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "TRAINING PLAN $title_date");

		//Set Merge
        $excel->getActiveSheet()->mergeCells('A1:T1'); // Judul
        $excel->getActiveSheet()->mergeCells('A2:A4'); // NO
        $excel->getActiveSheet()->mergeCells('B2:B4'); // JENIS PELATIHAN
        $excel->getActiveSheet()->mergeCells('C2:C4'); // NAME OF TRAINING
		$excel->getActiveSheet()->mergeCells('D2:G2'); // TANGGAL
		$excel->getActiveSheet()->mergeCells('D3:E3'); // TELKOM AKSES
		$excel->getActiveSheet()->mergeCells('F3:G3'); // MITRA
		$excel->getActiveSheet()->mergeCells('H2:M2'); // PARTICIPANTS
		$excel->getActiveSheet()->mergeCells('H3:H4'); // STAFF / TEKNISI
		$excel->getActiveSheet()->mergeCells('I3:I4'); // TEAM LEADER
		$excel->getActiveSheet()->mergeCells('J3:J4'); // OFF-1 / OFF-2
		$excel->getActiveSheet()->mergeCells('K3:K4'); // SITE MGR
		$excel->getActiveSheet()->mergeCells('L3:L4'); // MGR
		$excel->getActiveSheet()->mergeCells('M3:M4'); // MITRA
		$excel->getActiveSheet()->mergeCells('N2:R2'); // BULAN TAHUN
		$excel->getActiveSheet()->mergeCells('S2:S4'); // NAMA PENGAJAR
		$excel->getActiveSheet()->mergeCells('T2:T4'); // TOTAL PESERTA
		
		//Set Heading
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('A2', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B2', "JENIS PELATIHAN");
        $excel->setActiveSheetIndex(0)->setCellValue('C2', "NAME OF TRAINING");
        $excel->setActiveSheetIndex(0)->setCellValue('D2', $title_date);
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "TELKOM AKSES");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "MITRA");
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "PELATIHAN");
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "BREVET PRAKTEK DAN ONLINE");
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "PELATIHAN");
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "NAMA MITRA");
        $excel->setActiveSheetIndex(0)->setCellValue('H2', "PARTICIPANTS");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "STAFF / TEKNISI");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "TEAM LEADER");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "OFF-1 / OFF-2");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "SITE MGR");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "MGR");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "MITRA");
        $excel->setActiveSheetIndex(0)->setCellValue('N2', $bln_thn);
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "SENIN");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "SELASA");
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "RABU");
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "KAMIS");
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "JUM'AT");
        $excel->setActiveSheetIndex(0)->setCellValue('N4', date('d',strtotime($ftgl_awal_search)));
        $excel->setActiveSheetIndex(0)->setCellValue('O4', date('d',strtotime($ftgl_awal_search . "+1 days")));
        $excel->setActiveSheetIndex(0)->setCellValue('P4', date('d',strtotime($ftgl_awal_search . "+2 days")));
        $excel->setActiveSheetIndex(0)->setCellValue('Q4', date('d',strtotime($ftgl_awal_search . "+3 days")));
        $excel->setActiveSheetIndex(0)->setCellValue('R4', date('d',strtotime($ftgl_awal_search . "+4 days")));
        $excel->setActiveSheetIndex(0)->setCellValue('S2', "NAMA PENGAJAR");
		$excel->setActiveSheetIndex(0)->setCellValue('T2', "TOTAL PESERTA");
		
		//Set Style Heading
        $excel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('A2:A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B2:B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C2:C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D2:G2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3:E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3:G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H2:M2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3:H4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3:I4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3:J4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3:K4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3:L4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3:M4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N2:R2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S2:S4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T2:T4')->applyFromArray($style_col);
		
		//Set Isi Tabel
        $pasien = $this->m_trainingplan->ambil($ftgl_awal_search)->result();
        $no = 1;
        $numrow = 5;
        foreach($pasien as $data){
		  $total = 0;
		  $total += ($data->ta_pelatihan == null ? 0 : $data->ta_pelatihan);
		  $total += ($data->ta_bop == null ? 0 : $data->ta_bop);
		  $total += ($data->mitra_pelatihan == null ? 0 : $data->mitra_pelatihan);

          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->jenis_pelatihan);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->name_of_training);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->ta_pelatihan == null ? '' : $data->ta_pelatihan);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->ta_bop == null ? '' : $data->ta_bop);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->mitra_pelatihan == null ? '' : $data->mitra_pelatihan);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->nama_mitra == null ? '' : $data->nama_mitra);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->staff_teknisi == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->team_leader == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->officer == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->site_manager == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->mgr == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->mitra == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->senin == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->selasa == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->rabu == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->kamis == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->jumat == 0 ? '' : '✓');
          $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->nama_pengajar);
          $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $total);
          
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_normal);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_normal);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row_normal);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row_tengah);
          $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row_normal);
          $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row_tengah);
          
          $no++;
          $numrow++;
        }
		
		//Set Lebar Tabel
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
        
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        
        $excel->getActiveSheet(0)->setTitle("Laporan Training Plan");
        $excel->setActiveSheetIndex(0);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Training Plan '.date('d-m-Y').'.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        $write->save('php://output');
    }
}
