<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters/m_pelatihan');
		$this->load->model('m_report');
	}

	public function material()
	{
        if(isset($_POST['submit'])) {
            # code...
        }
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Stok Material';
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/material',$data,true)
		]);
    }
    
    public function nilai()
	{
        if(isset($_POST['submit'])) {
			$download = $this->input->post('target_for');
			$this->cetak_nilai($download);
        }
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Nilai TA/Mitra';
		$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/nilai',$data,true)
		]);
	}

	public function tes(){
		$report = $this->m_report->cetak_nilai()->result();
		echo json_encode($report);
		// echo str_replace(' ', '_', 'PELATIHAN INDIHOME');
	}
	
	public function cetak_nilai($download)
    {
		if($download == 'TA') {
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	
			$excel = new PHPExcel();
			
			$excel->getProperties()->setCreator('FIBER ACADEMY PEKALONGAN')
						 ->setLastModifiedBy('FIBER ACADEMY PEKALONGAN')
						 ->setTitle("Laporan Nilai TA")
						 ->setSubject("Admin")
						 ->setDescription("Laporan Nilai TA")
						 ->setKeywords("Laporan Nilai");
			
			$style_col = array(
			  'font' => array('bold' => true),
			  'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			  ),
			  'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_MEDIUM),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_MEDIUM),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_MEDIUM),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_MEDIUM)
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

			$style_heading_abu = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'C0BFBF')
				)
			);

			$style_isi_biru = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'B6ECEA')
				)
			);

			$style_isi_kuning = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'FCFC31')
				)
			);

			//Set Header
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT. TELKOM AKSES");
			$excel->setActiveSheetIndex(0)->setCellValue('A2', "FIBER ACADEMY PEKALONGAN");
			$excel->getActiveSheet()->mergeCells('A1:C1');
			$excel->getActiveSheet()->mergeCells('A2:C2');
			$excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(TRUE);

			//Set Judul
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "DAFTAR NILAI");
			$excel->setActiveSheetIndex(0)->setCellValue('A4', "EVALUASI HASIL BELAJAR");
			$excel->getActiveSheet()->mergeCells('A3:J3');
			$excel->getActiveSheet()->mergeCells('A4:J4');
			$excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setSize(16);
			$excel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A4:J4')->getFont()->setSize(16);
			$excel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			//Set Perencanaan
			$excel->setActiveSheetIndex(0)->setCellValue('A6', "PELATIHAN / BATCH");
			$excel->setActiveSheetIndex(0)->setCellValue('A7', "TAHUN");
			$excel->setActiveSheetIndex(0)->setCellValue('A8', "PERIODE TANGGAL");
			$excel->setActiveSheetIndex(0)->setCellValue('A9', "LOKASI / RUANG");
			$excel->getActiveSheet()->mergeCells('A6:C6');
			$excel->getActiveSheet()->mergeCells('A7:C7');
			$excel->getActiveSheet()->mergeCells('A8:C8');
			$excel->getActiveSheet()->mergeCells('A9:C9');
			$excel->getActiveSheet()->getStyle('A6:C6')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A7:C7')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A8:C8')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A9:C9')->getFont()->setBold(TRUE);

			// $sub = $this->m_report->sub()->result();

			// $excel->setActiveSheetIndex(0)->setCellValue('D6', ': '.strtoupper($sub->jenis_pelatihan));
			// $excel->setActiveSheetIndex(0)->setCellValue('D7', ': '.$sub->tahun);
			// $excel->setActiveSheetIndex(0)->setCellValue('D8', ': '.$sub->periode_tgl);
			// $excel->setActiveSheetIndex(0)->setCellValue('D9', ': '.strtoupper($sub->lokasi));
			$excel->setActiveSheetIndex(0)->setCellValue('D6', ': CX BEHAVIOR');
			$excel->setActiveSheetIndex(0)->setCellValue('D7', ': 2020');
			$excel->setActiveSheetIndex(0)->setCellValue('D8', ': 16 April 2020');
			$excel->setActiveSheetIndex(0)->setCellValue('D9', ': R. FIBER ACADEMY PEKALONGAN');
			$excel->getActiveSheet()->mergeCells('D6:G6');
			$excel->getActiveSheet()->mergeCells('D7:G7');
			$excel->getActiveSheet()->mergeCells('D8:G8');
			$excel->getActiveSheet()->mergeCells('D9:G9');
			$excel->getActiveSheet()->getStyle('D6:G6')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('D7:G7')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('D8:G8')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('D9:G9')->getFont()->setBold(TRUE);
			
			//Set Heading
			$excel->setActiveSheetIndex(0)->setCellValue('A11', "No");
			$excel->setActiveSheetIndex(0)->setCellValue('B11', "NAMA");
			$excel->setActiveSheetIndex(0)->setCellValue('C11', "NIK");
			$excel->setActiveSheetIndex(0)->setCellValue('D11', "POK");
			$excel->setActiveSheetIndex(0)->setCellValue('E11', "PRAKTEK");
			$excel->setActiveSheetIndex(0)->setCellValue('E12', "Role Play");
			$excel->setActiveSheetIndex(0)->setCellValue('F11', "PRE TEST");
			$excel->setActiveSheetIndex(0)->setCellValue('G11', "POST TEST");
			$excel->setActiveSheetIndex(0)->setCellValue('H11', "Kehadiran");
			$excel->setActiveSheetIndex(0)->setCellValue('I11', "Peningkatan Pembelajaran");
			$excel->setActiveSheetIndex(0)->setCellValue('J11', "Nilai Akhir");
			$excel->setActiveSheetIndex(0)->setCellValue('K11', "KET");
			$excel->setActiveSheetIndex(0)->setCellValue('A14', "1");
			$excel->setActiveSheetIndex(0)->setCellValue('B14', "2");
			$excel->setActiveSheetIndex(0)->setCellValue('C14', "3");
			$excel->setActiveSheetIndex(0)->setCellValue('D14', "4");
			$excel->setActiveSheetIndex(0)->setCellValue('E14', "5");
			$excel->setActiveSheetIndex(0)->setCellValue('F14', "6");
			$excel->setActiveSheetIndex(0)->setCellValue('G14', "7");
			$excel->setActiveSheetIndex(0)->setCellValue('H14', "8");
			$excel->setActiveSheetIndex(0)->setCellValue('I14', "9");
			$excel->setActiveSheetIndex(0)->setCellValue('J14', "10");
			$excel->setActiveSheetIndex(0)->setCellValue('K14', "11");

			$excel->getActiveSheet()->mergeCells('A11:A13'); // NO
			$excel->getActiveSheet()->mergeCells('B11:B13'); // NAMA
			$excel->getActiveSheet()->mergeCells('C11:C13'); // NIK
			$excel->getActiveSheet()->mergeCells('D11:D13'); // POK
			$excel->getActiveSheet()->mergeCells('E12:E13'); // ROLE PLAY
			$excel->getActiveSheet()->mergeCells('F11:F13'); // PRE TEST
			$excel->getActiveSheet()->mergeCells('G11:G13'); // POST TEST
			$excel->getActiveSheet()->mergeCells('H11:H13'); // KEHADIRAN
			$excel->getActiveSheet()->mergeCells('I11:I13'); // PENINGKATAN PEMBELAJARAN
			$excel->getActiveSheet()->mergeCells('J11:J13'); // NILAI AKHIR
			$excel->getActiveSheet()->mergeCells('K11:K13'); // KETERANGAN

			$excel->getActiveSheet()->getStyle('A11:K13')->applyFromArray($style_heading_abu);
			$excel->getActiveSheet()->getStyle('A11:A13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B11:B13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C11:C13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D11:D13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E11')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E12:E13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F11:F13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F11:F13')->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('G11:G13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G11:G13')->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('H11:H13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I11:I13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I11:I13')->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('J11:J13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('J11:J13')->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('K11:K13')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('A14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('H14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('J14')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('K14')->applyFromArray($style_col);
			
			//Set Isi Tabel
			$tahun 				= $this->input->post('tahun');
			$bulan 				= $this->input->post('bulan');
			$jenis_pelatihan 	= $this->input->post('jenis_pelatihan');
			$replace_jp			= '';

			if($bulan == 'all') {
				$t_bulan = 'ALL';
			} else {
				$t_bulan = bulan($bulan);
			}

			$report = $this->m_report->cetak_nilai($tahun, $bulan, $jenis_pelatihan, $download)->result();
			$no = 1;
			$numrow = 15;
			foreach($report as $data){
	
			  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama);
			  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nik);
			  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->pok);
			  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->roleplay);
			  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->pre_test);
			  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->post_test);
			  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->kehadiran);
			  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, '100%'); // Menggunakan Rumus
			  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, '100'); // Menggunakan Rumus
			  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->keterangan);
			  
			  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_isi_biru);
			  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_isi_kuning);
			  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row_normal);
			  
			  $no++;
			  $numrow++;
			  $replace_jp = str_replace(' ', '_', $data->jenis_pelatihan);
			}

			//Set Catatan
			$excel->setActiveSheetIndex(0)->setCellValue('A30', "Catatan :");
			$excel->getActiveSheet()->getStyle('A30')->getFont()->setBold(TRUE);
			$excel->setActiveSheetIndex(0)->setCellValue('A31', "1");
			$excel->setActiveSheetIndex(0)->setCellValue('A32', "2");
			$excel->setActiveSheetIndex(0)->setCellValue('A33', "3");
			$excel->setActiveSheetIndex(0)->setCellValue('A34', "4");
			$excel->setActiveSheetIndex(0)->setCellValue('B31', "Nilai Akhir = 40 % Nilai Post Test + 50 % (Nilai Mastery Test/Praktek+ Nilai Keaktifan/Observasi )+ 10 % (kehadiran).");
			$excel->setActiveSheetIndex(0)->setCellValue('B32', "Nilai Akhir = Apabila pada pelatihan tidak ada nilai Masteri Test/Praktek dan Nilai Keaktifan/Observasi.");
			$excel->setActiveSheetIndex(0)->setCellValue('B33', "Maka bobot nilai post tes 90 % + 10 % (kehadiran).");
			$excel->setActiveSheetIndex(0)->setCellValue('B34', "Syarat Kelulusan Nilai Akhir harus >= 65 dan kehadiran >=80 % kecuali area Jakarta > 90 %.");

			//Set Tanda Tangan
			$excel->setActiveSheetIndex(0)->setCellValue('H35', "Pekalongan, ".date_indo(date('Y-m-d')));
			$excel->setActiveSheetIndex(0)->setCellValue('H38', "INSTRUKTUR");
			$excel->setActiveSheetIndex(0)->setCellValue('H43', "....................");
			$excel->setActiveSheetIndex(0)->setCellValue('K43', "....................");
			$excel->getActiveSheet()->mergeCells('H35:L35');
			$excel->getActiveSheet()->mergeCells('H38:L38');
			$excel->getActiveSheet()->mergeCells('H43:I43');
			$excel->getActiveSheet()->mergeCells('K43:L43');
			$excel->getActiveSheet()->getStyle('H35:L35')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('H38:L38')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('H43')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('K43')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('H43')->getFont()->setUnderline(TRUE);
			$excel->getActiveSheet()->getStyle('K43')->getFont()->setUnderline(TRUE);
			$excel->getActiveSheet()->getStyle('H35:L35')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('H38:L38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('H43:I43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('K43:L43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			//Set Lebar Tabel
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(9);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
			$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
			
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			
			$excel->getActiveSheet(0)->setTitle("Laporan Nilai TA");
			$excel->setActiveSheetIndex(0);
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="NILAI_'.$download.'_'.$t_bulan.'_'.strtoupper($tahun).'_'.$replace_jp.'.xlsx"');
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			ob_end_clean();
			$write->save('php://output');
		} else {
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	
			$excel = new PHPExcel();
			
			$excel->getProperties()->setCreator('FIBER ACADEMY PEKALONGAN')
						 ->setLastModifiedBy('FIBER ACADEMY PEKALONGAN')
						 ->setTitle("Laporan Nilai Mitra")
						 ->setSubject("Admin")
						 ->setDescription("Laporan Nilai Mitra")
						 ->setKeywords("Laporan Nilai");
			
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

			$style_heading_pink = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'FFBF9E')
				)
			);

			$style_heading_merah = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'BF292E')
				),
				'font'  => array(
					'bold'  => true,
					'color' => array('rgb' => 'FFFFFF')
				)
			);
			
			//Set Heading
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
			$excel->setActiveSheetIndex(0)->setCellValue('B1', "NIK");
			$excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMA");
			$excel->setActiveSheetIndex(0)->setCellValue('D1', "JENIS KELAMIN");
			$excel->setActiveSheetIndex(0)->setCellValue('E1', "NAMA MITRA");
			$excel->setActiveSheetIndex(0)->setCellValue('F1', "JENIS MITRA");
			$excel->setActiveSheetIndex(0)->setCellValue('G1', "WITEL");
			$excel->setActiveSheetIndex(0)->setCellValue('H1', "REGIONAL");
			$excel->setActiveSheetIndex(0)->setCellValue('I1', "NAMA PELATIHAN");
			$excel->setActiveSheetIndex(0)->setCellValue('J1', "JENIS TEKNISI MITRA");
			$excel->setActiveSheetIndex(0)->setCellValue('K1', "LOKASI PELATIHAN");
			$excel->setActiveSheetIndex(0)->setCellValue('L1', "BULAN");
			$excel->setActiveSheetIndex(0)->setCellValue('M1', "TAHUN");
			$excel->setActiveSheetIndex(0)->setCellValue('N1', "TANGGAL MULAI");
			$excel->setActiveSheetIndex(0)->setCellValue('O1', "TANGGAL SELESAI");
			$excel->setActiveSheetIndex(0)->setCellValue('P1', "NILAI");
			$excel->setActiveSheetIndex(0)->setCellValue('Q1', "KETERANGAN");
			
			//Set Style Heading
			$excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($style_heading_pink);
			$excel->getActiveSheet()->getStyle('I1:Q1')->applyFromArray($style_heading_merah);

			$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
			
			//Set Isi Tabel
			$tahun 				= $this->input->post('tahun');
			$bulan 				= $this->input->post('bulan');
			$jenis_pelatihan 	= $this->input->post('jenis_pelatihan');
			$replace_jp			= '';

			if($bulan == 'all') {
				$t_bulan = 'ALL';
			} else {
				$t_bulan = bulan($bulan);
			}

			$report = $this->m_report->cetak_nilai($tahun, $bulan, $jenis_pelatihan, $download)->result();
			$no = 1;
			$numrow = 2;
			foreach($report as $data){
	
			  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nik);
			  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama);
			  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jenis_kelamin);
			  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_mitra);
			  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->jenis_mitra);
			  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, 'PEKALONGAN');
			  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 'REGIONAL 4');
			  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->jenis_pelatihan);
			  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->jenis_teknisi);
			  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->lokasi);
			  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, bulan($data->bulan));
			  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->tahun);
			  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, mediumdate_indo($data->tgl_mulai));
			  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, mediumdate_indo($data->tgl_selesai));
			  $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->nilai);
			  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->keterangan);
			  
			  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_normal);
			  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_normal);
			  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_tengah);
			  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row_tengah);
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
			  
			  $no++;
			  $numrow++;
			  $replace_jp = str_replace(' ', '_', $data->jenis_pelatihan);
			}
			
			//Set Lebar Tabel
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
			
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
			
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			
			$excel->getActiveSheet(0)->setTitle("Laporan Nilai Mitra");
			$excel->setActiveSheetIndex(0);
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="NILAI_'.$download.'_'.$t_bulan.'_'.strtoupper($tahun).'_'.$replace_jp.'.xlsx"');
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			ob_end_clean();
			$write->save('php://output');
		}
    }
}
