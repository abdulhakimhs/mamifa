-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mamifa.tb_target_mitra
CREATE TABLE IF NOT EXISTS `tb_target_mitra` (
  `target_m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(15) DEFAULT NULL,
  `nama` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `nama_mitra` varchar(50) DEFAULT NULL,
  `jenis_mitra` varchar(25) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_target_mitra: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_target_mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_target_mitra` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_target_ta
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_target_ta: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_target_ta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_target_ta` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
