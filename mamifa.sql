-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5791
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mamifa.tb_files
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

-- Dumping data for table mamifa.tb_files: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_files` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_jenis_laporan
CREATE TABLE IF NOT EXISTS `tb_jenis_laporan` (
  `jenis_lap_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_laporan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jenis_lap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_jenis_laporan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_jenis_laporan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_jenis_laporan` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`kelas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_kelas: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_kelas` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_monila
CREATE TABLE IF NOT EXISTS `tb_monila` (
  `monila_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_lap_id` int(11) DEFAULT NULL,
  `lokasi_temuan` char(3) DEFAULT NULL,
  `odp_koordinat` varchar(150) DEFAULT NULL,
  `file_evident` varchar(255) DEFAULT NULL,
  `saran_perbaikan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 blm diterima, 1 sdh diterima',
  PRIMARY KEY (`monila_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_monila: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_monila` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_monila` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_name_of_training
CREATE TABLE IF NOT EXISTS `tb_name_of_training` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_of_training` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_name_of_training: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_name_of_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_name_of_training` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_operation
CREATE TABLE IF NOT EXISTS `tb_operation` (
  `operation_id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_code` varchar(10) DEFAULT NULL,
  `operation_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`operation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_operation: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_operation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_operation` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_pelatihan
CREATE TABLE IF NOT EXISTS `tb_pelatihan` (
  `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pelatihan` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`pelatihan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_pelatihan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_pelatihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pelatihan` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_training_plan
CREATE TABLE IF NOT EXISTS `tb_training_plan` (
  `training_plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `not_id` int(11) DEFAULT NULL,
  `ta_bop` smallint(6) DEFAULT NULL,
  `ta_pelatihan` smallint(6) DEFAULT NULL,
  `mitra_pelatihan` smallint(6) DEFAULT NULL,
  `nama_mitra` varchar(50) DEFAULT NULL,
  `staff_teknisi` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `team_leader` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `officer` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `site_manager` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `mgr` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `mitra` tinyint(4) DEFAULT 0 COMMENT '0 tdk ikut, 1 ikut',
  `senin` tinyint(4) DEFAULT 0 COMMENT '0 tdk, 1 ya',
  `selasa` tinyint(4) DEFAULT 0 COMMENT '0 tdk, 1 ya',
  `rabu` tinyint(4) DEFAULT 0 COMMENT '0 tdk, 1 ya',
  `kamis` tinyint(4) DEFAULT 0 COMMENT '0 tdk, 1 ya',
  `jumat` tinyint(4) DEFAULT 0 COMMENT '0 tdk, 1 ya',
  PRIMARY KEY (`training_plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_training_plan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_training_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_training_plan` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_training_request
CREATE TABLE IF NOT EXISTS `tb_training_request` (
  `training_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` varchar(25) DEFAULT NULL,
  `sub_level` varchar(50) DEFAULT NULL,
  `pelatihan_id` int(11) DEFAULT NULL,
  `alasan_permintaan` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 menunggu, 1 diterima, 2 ditolak',
  PRIMARY KEY (`training_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_training_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_training_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_training_request` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '0 tamu, 1 admin',
  `active` tinyint(4) DEFAULT 1 COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
