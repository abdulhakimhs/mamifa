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
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Nilai TA/Mitra';
		$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/nilai',$data,true)
		]);
	}
	
	public function nilai_ta()
	{
		# code...
	}

	public function nilai_mitra()
	{
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
		header('Content-Disposition: attachment; filename="NILAI_MITRA_'.$t_bulan.'_'.strtoupper($tahun).'_'.$replace_jp.'.xlsx"');
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		ob_end_clean();
		$write->save('php://output');
	}

	public function tes(){
		$report = $this->m_report->cetak_nilai()->result();
		echo json_encode($report);
		// echo str_replace(' ', '_', 'PELATIHAN INDIHOME');
	}
}
