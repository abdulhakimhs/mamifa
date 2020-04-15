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
            
        }
		$data['title'] 			= 'Laporan';
		$data['subtitle'] 		= 'Nilai TA/Mitra';
		$data['pelatihan']		= $this->m_pelatihan->ambil()->result_array();
		$this->load->view('backend/template',[
			'content' => $this->load->view('backend/report/nilai',$data,true)
		]);
	}
	
	public function cetak_nilai($download)
    {
		if($download == 'TA') {
			//Cetak TA
		} else {
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	
			$excel = new PHPExcel();
			
			$excel->getProperties()->setCreator('FIBER ACADEMY PEKALONGAN')
						 ->setLastModifiedBy('FIBER ACADEMY PEKALONGAN')
						 ->setTitle("Laporan Nilai $download")
						 ->setSubject("Admin")
						 ->setDescription("Laporan Nilai $download")
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
}
