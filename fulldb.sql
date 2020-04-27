-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.38-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table mamifa.tb_content
CREATE TABLE IF NOT EXISTS `tb_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(100) DEFAULT NULL,
  `content_desc` text,
  `content_image` varchar(255) DEFAULT NULL,
  `content_by` int(11) DEFAULT NULL,
  `content_date` date DEFAULT NULL,
  `content_count` int(11) DEFAULT NULL,
  `content_slug` varchar(150) DEFAULT NULL,
  `content_active` tinyint(4) DEFAULT '1' COMMENT '1 aktif, 0 draft',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_content: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_content` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_files
CREATE TABLE IF NOT EXISTS `tb_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(100) DEFAULT NULL,
  `file_desc` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_created` date DEFAULT NULL,
  `file_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_files: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_files` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_jenis_laporan
CREATE TABLE IF NOT EXISTS `tb_jenis_laporan` (
  `jenis_lap_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_laporan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jenis_lap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_jenis_laporan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_jenis_laporan` DISABLE KEYS */;
INSERT INTO `tb_jenis_laporan` (`jenis_lap_id`, `jenis_laporan`) VALUES
	(1, 'Laporan 1'),
	(2, 'Laporan 2');
/*!40000 ALTER TABLE `tb_jenis_laporan` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_material
CREATE TABLE IF NOT EXISTS `tb_material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(100) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL COMMENT 'MATERIAL / HABIS PAKAI',
  `satuan` varchar(10) DEFAULT NULL COMMENT 'bh = buah, m = meter',
  `stok` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_material: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_material` DISABLE KEYS */;
INSERT INTO `tb_material` (`material_id`, `material`, `merk`, `type`, `jenis`, `satuan`, `stok`) VALUES
	(1, 'SOC', 'SUMITOMO', 'SOC', 'MATERIAL', NULL, 26),
	(2, 'ADAPTER', '', '', 'MATERIAL', NULL, 47),
	(3, 'ODC', '', 'ODC', 'HABIS PAKAI', NULL, 2);
/*!40000 ALTER TABLE `tb_material` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_material_trans
CREATE TABLE IF NOT EXISTS `tb_material_trans` (
  `mat_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `sumber_tujuan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 brg masuk, 0 brg keluar',
  `saldo` tinyint(4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mat_trans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_material_trans: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_material_trans` DISABLE KEYS */;
INSERT INTO `tb_material_trans` (`mat_trans_id`, `material_id`, `jumlah`, `sumber_tujuan`, `tanggal`, `status`, `saldo`, `keterangan`) VALUES
	(1, 1, 50, 'GUDANG', '2020-04-10', 1, 50, 'Masuk'),
	(2, 1, 12, 'BREVET INDIHOME 3P', '2020-04-10', 0, 38, 'Keluar'),
	(4, 1, 8, 'PELATIHAN 2', '2020-04-12', 1, 30, 'Masuk'),
	(5, 1, 2, 'PELATIHAN 2', '2020-04-12', 1, 28, 'Masuk'),
	(6, 2, 50, 'GUDANG', '2020-04-12', 0, 50, 'Keluar'),
	(7, 3, 2, 'GUDANG', '2020-04-12', 0, 2, 'Keluar'),
	(8, 2, 1, 'Pelatihan', '2020-04-27', 0, 49, NULL),
	(9, 2, 1, 'Pelatihan', '2020-04-27', 0, 48, NULL),
	(10, 1, 1, 'Pelatihan', '2020-04-27', 0, 27, NULL),
	(11, 2, 1, 'Pelatihan', '2020-04-25', 0, 47, NULL),
	(12, 1, 1, 'Pelatihan', '2020-04-25', 0, 26, NULL);
/*!40000 ALTER TABLE `tb_material_trans` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_mitra
CREATE TABLE IF NOT EXISTS `tb_mitra` (
  `mitra_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mitra` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mitra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_mitra: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_mitra` DISABLE KEYS */;
INSERT INTO `tb_mitra` (`mitra_id`, `nama_mitra`) VALUES
	(1, 'Telkom Akses'),
	(2, 'Infomedia Solusi Humanika (ISH)'),
	(3, 'Koperasi Pegawai Telkom (KOPEGTEL)');
/*!40000 ALTER TABLE `tb_mitra` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_monila
CREATE TABLE IF NOT EXISTS `tb_monila` (
  `monila_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_lap_id` int(11) DEFAULT NULL,
  `lokasi_temuan` char(3) DEFAULT NULL,
  `koordinat` varchar(100) NOT NULL,
  `odp` varchar(25) DEFAULT NULL,
  `file_evident` varchar(255) DEFAULT NULL,
  `saran_perbaikan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 blm diterima, 1 sdh diterima',
  PRIMARY KEY (`monila_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_monila: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_monila` DISABLE KEYS */;
INSERT INTO `tb_monila` (`monila_id`, `nik`, `nama_lengkap`, `jenis_lap_id`, `lokasi_temuan`, `koordinat`, `odp`, `file_evident`, `saran_perbaikan`, `status`) VALUES
	(2, '19929291', 'Nuril Muslichin', 1, 'PKL', '', 'ODP-PKL-FN/108', 'canting1.jpg', 'Mohon segera dicek!', 1),
	(3, '01929192', 'Bobby', 2, 'BRB', '-6.8898998,109.6682281', '', 'kelapa.jpg', 'Pintu ODP Terbuka', 0);
/*!40000 ALTER TABLE `tb_monila` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_naker
CREATE TABLE IF NOT EXISTS `tb_naker` (
  `naker_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) DEFAULT NULL,
  `position_title` varchar(100) DEFAULT NULL,
  `nik` varchar(15) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `sektor` varchar(50) DEFAULT NULL,
  `rayon` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `bpjs` varchar(255) DEFAULT NULL,
  `nama_cp` varchar(75) DEFAULT NULL,
  `hubungan` varchar(10) DEFAULT NULL,
  `kontak_cp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`naker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_naker: ~14 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_naker` DISABLE KEYS */;
INSERT INTO `tb_naker` (`naker_id`, `position_name`, `position_title`, `nik`, `nama`, `sektor`, `rayon`, `level`, `bpjs`, `nama_cp`, `hubungan`, `kontak_cp`) VALUES
	(1, 'STAFF HSE', 'STAFF HSE', '92170416', 'MUHAMMAD SOFYAN', '', '', 'TEKNISI', '92170416.jpg', NULL, NULL, NULL),
	(2, 'DATA MANAJEMEN', 'STAFF', '91829122', 'LUTFI ADI IRAWAN', '', '', 'TEAM LEADER', NULL, NULL, NULL, NULL),
	(4, 'IT KONSULTAN', 'TEAM LEADER', '91112121', 'Abdul Hakim Hassan', '', '', 'TEAM LEADER', NULL, NULL, NULL, NULL),
	(5, 'STAFF HSE', 'STAFF HSE', '92170416', 'MUHAMMAD SOFYAN', '', '', 'TEKNISI', NULL, NULL, NULL, NULL),
	(6, 'STAFF HSE', 'STAFF HSE', '865838', 'AGUNG SETIOBUDI', '', '', 'SITE MANAGER', NULL, NULL, NULL, NULL),
	(7, 'STAFF HSE', 'STAFF HSE', '19930260', 'BENNY TARWIDI', '', '', 'TEAM LEADER', NULL, NULL, NULL, NULL),
	(9, 'STAFF HUMAN CAPITAL SERVICE', 'STAFF HUMAN CAPITAL SERVICE', '19930028', 'PANJI DWIYANTO SAPUTRO', '', '', 'STAFF', NULL, NULL, NULL, NULL),
	(10, 'TEAM LEADER COMMERCE', 'TEAM LEADER COMMERCE', '18940680', 'ABDUL MUJIB HADI', '', '', 'TEAM LEADER', NULL, 'IBU ABDUL', 'IBU', '086627362217'),
	(11, 'STAFF COMMERCE', 'STAFF COMMERCE', '20940837', 'MEGAWATI WISNU WARDHANI', '', '', 'STAFF', NULL, NULL, NULL, NULL),
	(12, 'STAFF COMMERCE', 'STAFF COMMERCE', '19980245', 'HANUM SALSABILA', '', '', 'STAFF', NULL, NULL, NULL, NULL),
	(13, 'STAFF', 'DAMAN', '18290201', 'ARDIAN SYARIFUDIN', 'STO PEKALONGAN', 'AMO', 'STAFF', NULL, 'BAPAK ARDIAN', 'BAPAK', '09809898098'),
	(15, 'STAFF', 'DAMAN', '10192019', 'BOBBY IRYSAN WALANA', 'YOUTUBER', 'NASIONAL', 'SITE MANAGER', NULL, 'BAPAK BOBBY', 'BAPAK', '087087087087'),
	(16, 'SITE MANAGER CCAN & WAN', 'SITE MANAGER CCAN & WAN', '855824', 'MUHAMMAD SAIDUN', '', '', 'SITE MANAGER', NULL, 'BAPAK 1', 'BAPAK', '80808080808'),
	(17, 'TEKNISI WIFI', 'TEKNISI WIFI', '20870056', 'AMAT YUSUF', '', '', 'TEKNISI', '20870056.pdf', 'IBU 1', 'IBU', '87087087087');
/*!40000 ALTER TABLE `tb_naker` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_name_of_training
CREATE TABLE IF NOT EXISTS `tb_name_of_training` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_of_training` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_name_of_training: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_name_of_training` DISABLE KEYS */;
INSERT INTO `tb_name_of_training` (`not_id`, `name_of_training`, `status`) VALUES
	(1, 'Training 1', 1),
	(2, 'Training 2', 1);
/*!40000 ALTER TABLE `tb_name_of_training` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_nilai_mitra
CREATE TABLE IF NOT EXISTS `tb_nilai_mitra` (
  `nilai_m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `target_m_id` bigint(20) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `nilai` tinyint(4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nilai_m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_nilai_mitra: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_nilai_mitra` DISABLE KEYS */;
INSERT INTO `tb_nilai_mitra` (`nilai_m_id`, `target_m_id`, `lokasi`, `tgl_mulai`, `tgl_selesai`, `nilai`, `keterangan`) VALUES
	(1, 10, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-14', '2020-04-17', 100, 'Excelent!'),
	(2, 1, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-21', '2020-04-17', 100, 'Mantab!'),
	(4, 5, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-25', '2020-04-27', 90, 'Done');
/*!40000 ALTER TABLE `tb_nilai_mitra` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_nilai_ta
CREATE TABLE IF NOT EXISTS `tb_nilai_ta` (
  `nilai_ta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `target_id` bigint(20) NOT NULL,
  `pok` tinyint(4) NOT NULL DEFAULT '0',
  `roleplay` tinyint(4) NOT NULL DEFAULT '0',
  `pre_test` tinyint(4) NOT NULL DEFAULT '0',
  `post_test` tinyint(4) NOT NULL DEFAULT '0',
  `kehadiran` tinyint(4) NOT NULL DEFAULT '0',
  `lokasi` varchar(50) DEFAULT NULL,
  `periode_tgl` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nilai_ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_nilai_ta: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_nilai_ta` DISABLE KEYS */;
INSERT INTO `tb_nilai_ta` (`nilai_ta_id`, `target_id`, `pok`, `roleplay`, `pre_test`, `post_test`, `kehadiran`, `lokasi`, `periode_tgl`, `keterangan`) VALUES
	(1, 1, 0, 70, 30, 90, 100, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-08', ''),
	(2, 1, 0, 100, 100, 100, 100, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Bagus'),
	(3, 2, 0, 100, 70, 80, 90, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Cocok'),
	(4, 3, 0, 80, 90, 90, 80, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Mantap'),
	(5, 4, 0, 100, 100, 90, 90, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Sangat Bagus'),
	(6, 5, 0, 80, 80, 80, 80, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Cukup'),
	(7, 9, 0, 100, 100, 100, 100, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Excelent!'),
	(8, 10, 0, 100, 100, 100, 100, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', 'Wow! Perfect'),
	(9, 7, 0, 0, 0, 10, 0, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-10', '');
/*!40000 ALTER TABLE `tb_nilai_ta` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_operation
CREATE TABLE IF NOT EXISTS `tb_operation` (
  `operation_id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_code` varchar(10) DEFAULT NULL,
  `operation_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`operation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_operation: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_operation` DISABLE KEYS */;
INSERT INTO `tb_operation` (`operation_id`, `operation_code`, `operation_name`) VALUES
	(1, 'CCAN', 'CCAN'),
	(2, 'SDI', 'SDI'),
	(3, 'PKL', 'PKL'),
	(4, 'BTG', 'BTG');
/*!40000 ALTER TABLE `tb_operation` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_pelatihan
CREATE TABLE IF NOT EXISTS `tb_pelatihan` (
  `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pelatihan` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`pelatihan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_pelatihan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_pelatihan` DISABLE KEYS */;
INSERT INTO `tb_pelatihan` (`pelatihan_id`, `jenis_pelatihan`, `status`) VALUES
	(2, 'Pelatihan', 1),
	(3, 'Maintenance FO', 1);
/*!40000 ALTER TABLE `tb_pelatihan` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_slider
CREATE TABLE IF NOT EXISTS `tb_slider` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_title` varchar(50) DEFAULT NULL,
  `slide_desc` varchar(255) DEFAULT NULL,
  `slide_image` varchar(255) DEFAULT NULL,
  `slide_active` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_slider: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_slider` DISABLE KEYS */;
INSERT INTO `tb_slider` (`slide_id`, `slide_title`, `slide_desc`, `slide_image`, `slide_active`) VALUES
	(1, 'SELAMAT DATANG FA PEKALONGAN', 'Website Resmi Fiber Academy Pekalongan', 'fa.png', 1),
	(2, 'INFORMASI SEPUTAR FA PEKALONGAN', 'Berbagai informasi bisa kamu dapat disini', 'header-back.png', 1);
/*!40000 ALTER TABLE `tb_slider` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_target_mitra
CREATE TABLE IF NOT EXISTS `tb_target_mitra` (
  `target_m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(15) DEFAULT NULL,
  `nama` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `nama_mitra` varchar(50) DEFAULT NULL,
  `jenis_mitra` varchar(25) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `jenis_teknisi` varchar(25) DEFAULT NULL,
  `lokasi_pelatihan` varchar(50) DEFAULT NULL,
  `bulan` tinyint(2) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `nilai` tinyint(4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 blm, 1 sdh',
  PRIMARY KEY (`target_m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_target_mitra: ~19 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_target_mitra` DISABLE KEYS */;
INSERT INTO `tb_target_mitra` (`target_m_id`, `nik`, `nama`, `jenis_kelamin`, `nama_mitra`, `jenis_mitra`, `level`, `pelatihan_id`, `jenis_teknisi`, `lokasi_pelatihan`, `bulan`, `tahun`, `tgl_mulai`, `tgl_selesai`, `nilai`, `keterangan`, `status`) VALUES
	(1, '19291929', 'NURIL MUSLICHIN', 'L', 'KOPEGTEL', 'IOAN', 'Staff', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 1),
	(2, '18281827', 'ABDUL HAKIM HAS', 'L', 'HCP', 'IOAN', 'Team Leader', 3, 'IOAN', 'PKL', 4, '2021', NULL, NULL, NULL, NULL, 1),
	(3, '12121212', 'ARDIAN SYARIFUD', 'L', 'HCP', 'IOAN', 'Staff', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 1),
	(4, '12920121', 'BOBBY IRSYAN WA', 'L', 'KES', 'IOAN', 'Staff', 2, 'IOAN', 'PKL', 4, '2021', NULL, NULL, NULL, NULL, 1),
	(5, '11221122', 'YUSUF ARIFANDI', 'L', 'KOPEGTEL', 'IOAN', 'Team Leader', 2, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 1),
	(6, '10201020', 'ABDUL', 'L', 'KOPEGTEL', 'IOAN', 'TEAM LEADER', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(7, '10201021', 'NURIL', 'L', 'KOPEGTEL', 'IOAN', 'TEAM LEADER', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(8, '10201022', 'ABDULLAH', 'L', 'KOPEGTEL', 'IOAN', 'STAFF', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(9, '10201023', 'ABDUL HAKIM', 'L', 'KOPEGTEL', 'IOAN', 'STAFF', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(10, '10201024', 'MUSLICHIN', 'L', 'ISH', 'IOAN', 'STAFF', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 1),
	(11, '10201025', 'MUSLIM', 'L', 'ISH', 'IOAN', 'STAFF', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(12, '10201026', 'ARDIAN', 'L', 'ISH', 'IOAN', 'STAFF', 3, 'IOAN', 'PKL', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(13, '10201027', 'BOBBY', 'L', 'ISH', 'IOAN', 'STAFF', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(14, '10201028', 'ADITYA', 'L', 'ISH', 'IOAN', 'STAFF', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(15, '10201029', 'FITRI', 'P', 'HCP', 'IOAN', 'STAFF', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(16, '10201030', 'CINTA', 'P', 'HCP', 'IOAN', 'STAFF', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(17, '10201031', 'DELLA', 'P', 'HCP', 'IOAN', 'STAFF', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(18, '10201032', 'AYU', 'P', 'HCP', 'IOAN', 'TEAM LEADER', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0),
	(19, '10201033', 'BELLA', 'P', 'HCP', 'IOAN', 'TEAM LEADER', 3, 'IOAN', 'BTG', 4, '2020', NULL, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `tb_target_mitra` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_target_ta
CREATE TABLE IF NOT EXISTS `tb_target_ta` (
  `target_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(15) DEFAULT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `sektor` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `subunit` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bulan` tinyint(2) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 blm, 1 sdh',
  PRIMARY KEY (`target_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_target_ta: ~11 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_target_ta` DISABLE KEYS */;
INSERT INTO `tb_target_ta` (`target_id`, `nik`, `nama`, `sektor`, `level`, `position_name`, `subunit`, `tahun`, `bulan`, `pelatihan_id`, `operation_id`, `status`) VALUES
	(1, '94170021', 'MEGAWATI WISNU WARDHANI', '0', 'Manager', 'Installer Digitalisasi SPBU Pertamina', 'Assurance - Maintenance Program & Performance West', '2020', 4, 3, 3, 1),
	(2, '19900101', 'NIKI TRIYO PAMBUDI', '0', 'Teknisi', 'Installer Digitalisasi SPBU Pertamina', 'Assurance - Maintenance Program & Performance West', '2020', 4, 3, 3, 1),
	(3, '97150012', 'ARI AJI PAMUNGKAS', '0', 'Surveyor', 'Surveyor', 'Konstruksi Pekalongan', '2021', 4, 3, 3, 1),
	(4, '97156033', 'DWI FAJAR RIZKI', '0', 'Site Manager', 'Installer Digitalisasi SPBU Pertamina', 'Assurance - Maintenance Program & Performance West', '2020', 4, 3, 3, 1),
	(5, '17790315', 'RONI HIDAYAT', '0', 'Team Leader', 'Pengawas Pihak Ke-3', 'Operasi Pekalongan', '2020', 4, 3, 3, 1),
	(6, '18990150', 'INDRA HIDAYAT', '0', 'Teknisi', 'Teknisi FTM', 'Operasi Pekalongan', '2021', 4, 3, 3, 0),
	(7, '87157545', 'REZA ALI SYAHBANA', '0', 'Team Leader', 'Teknisi FTM', 'Operasi Pekalongan', '2020', 4, 2, 1, 1),
	(8, '87157221', 'DONNY PERMONO PUTRO', 'PEKALONGAN 1', 'Teknisi', 'Teknisi I-OAN Sektor Pekalongan 1', 'Operasi Pekalongan', '2021', 3, 2, 1, 0),
	(9, '92170416', 'MUHAMMAD SOFYAN', '0', 'Team Leader', 'Installer Digitalisasi SPBU Pertamina', 'Assurance - Maintenance Program & Performance West', '2020', 4, 3, 2, 1),
	(10, '20180126', 'FATKHUL ARIQRIFQI', '0', 'Teknisi', 'Teknisi Logic on Desk', 'Operasi Pekalongan', '2020', 3, 2, 2, 1),
	(11, '18910087', 'BAYU AGUNG RIYANTORO', 'PEKALONGAN 2', 'Team Leader', 'Team Leader Provisioning & Migrasi Sektor Pekalong', 'Operasi Pekalongan', '2020', 4, 3, 2, 0),
	(12, '96155464', 'NOVAN DWI RANGGA', '0', 'Manager', 'Teknisi FTM', 'Operasi Pekalongan', '2021', 4, 2, 4, 0),
	(13, '19980110', 'MUHAMMAD LABIB NUGROHO', '0', 'Site Manager', 'Staff Operation Consumer Service Pekalongan Rayon ', 'Operasi Pekalongan', '2020', 4, 2, 4, 0);
/*!40000 ALTER TABLE `tb_target_ta` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_training_plan
CREATE TABLE IF NOT EXISTS `tb_training_plan` (
  `training_plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `not_id` int(11) DEFAULT NULL,
  `nama_pengajar` varchar(100) NOT NULL,
  `ta_bop` smallint(6) DEFAULT NULL,
  `ta_pelatihan` smallint(6) DEFAULT NULL,
  `mitra_pelatihan` smallint(6) DEFAULT NULL,
  `mitra_id` int(11) DEFAULT NULL,
  `staff_teknisi` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `team_leader` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `officer` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `site_manager` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `mgr` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `mitra` tinyint(4) DEFAULT '0' COMMENT '0 tdk ikut, 1 ikut',
  `senin` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `selasa` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `rabu` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `kamis` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  `jumat` tinyint(4) DEFAULT '0' COMMENT '0 tdk, 1 ya',
  PRIMARY KEY (`training_plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_training_plan: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_training_plan` DISABLE KEYS */;
INSERT INTO `tb_training_plan` (`training_plan_id`, `tgl_awal`, `tgl_akhir`, `pelatihan_id`, `not_id`, `nama_pengajar`, `ta_bop`, `ta_pelatihan`, `mitra_pelatihan`, `mitra_id`, `staff_teknisi`, `team_leader`, `officer`, `site_manager`, `mgr`, `mitra`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`) VALUES
	(1, '2020-03-23', '2020-03-27', 3, 1, 'Nuril Muslichin', NULL, NULL, 30, 3, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0),
	(2, '2020-03-30', '2020-04-03', 3, 1, 'Abdul Hakim Hassan', 25, NULL, 10, 2, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0),
	(3, '2020-04-06', '2020-04-10', 3, 1, 'Bobby Irsyan Walana', 15, 15, NULL, NULL, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1),
	(4, '2020-04-13', '2020-04-17', 2, 2, 'Ardian Syarifudin', 15, 25, NULL, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1),
	(5, '2020-04-13', '2020-04-17', 2, 2, 'Ridho Hassan', NULL, NULL, 33, 3, 0, 1, 0, 0, 0, 1, 0, 0, 1, 1, 1),
	(6, '2020-04-06', '2020-04-10', 2, 1, 'Benny Irawan', NULL, NULL, 15, 2, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1),
	(7, '2020-03-23', '2020-03-27', 3, 2, 'Benny Irawan', NULL, NULL, 15, 2, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0),
	(8, '2020-03-30', '2020-04-03', 2, 1, 'BENNY', NULL, 10, 20, 3, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1),
	(9, '2020-04-20', '2020-04-24', 3, 1, 'NURIL', NULL, 5, 5, 2, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0);
/*!40000 ALTER TABLE `tb_training_plan` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_training_request
CREATE TABLE IF NOT EXISTS `tb_training_request` (
  `training_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` varchar(25) DEFAULT NULL,
  `sub_level` varchar(50) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `alasan_permintaan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 menunggu, 1 diterima, 2 ditolak',
  PRIMARY KEY (`training_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_training_request: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_training_request` DISABLE KEYS */;
INSERT INTO `tb_training_request` (`training_request_id`, `nik`, `nama_lengkap`, `level`, `sub_level`, `pelatihan_id`, `alasan_permintaan`, `status`) VALUES
	(1, '0210020198', 'Bobby', 'TEAM LEADER', 'REGIONAL', 2, 'Segera lakukan pelatihan', 1);
/*!40000 ALTER TABLE `tb_training_request` ENABLE KEYS */;

-- membuang struktur untuk table mamifa.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '0 tamu, 1 admin',
  `active` tinyint(4) DEFAULT '1' COMMENT '0 tdk aktif, 1 aktif',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel mamifa.tb_users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`users_id`, `email`, `username`, `password`, `fullname`, `level`, `active`, `last_login`) VALUES
	(1, 'abdulhakimhsn@gmail.com', 'Abdul_Hakim_Hs', '$2a$12$XOHwccCdzMSUbHx/u17JreZDeDnM6LOVJx2t54UFbXv4Bu9yG8v.a', 'Abdul Hakim Hs', 1, 1, '2020-04-27 14:04:06'),
	(2, 'nurilmuslichin16@gmail.com', 'nuril_muslichin', '$2a$12$HxbjGIvVWtjhvqfUZyXjqek27EPi.klwFJ5GluDefEr2D7f2W6k9K', 'Nuril Muslichin', 0, 1, '2020-04-25 14:58:35');
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
