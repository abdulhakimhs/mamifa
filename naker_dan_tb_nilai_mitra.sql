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

-- Dumping structure for table mamifa.tb_naker
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
  PRIMARY KEY (`naker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_naker: ~12 rows (approximately)
/*!40000 ALTER TABLE `tb_naker` DISABLE KEYS */;
INSERT INTO `tb_naker` (`naker_id`, `position_name`, `position_title`, `nik`, `nama`, `sektor`, `rayon`, `level`, `bpjs`) VALUES
	(1, 'STAFF HSE', 'STAFF HSE', '92170416', 'MUHAMMAD SOFYAN', '', '', 'TEKNISI', '92170416.jpg'),
	(2, 'DATA MANAJEMEN', 'STAFF', '91829122', 'LUTFI ADI IRAWAN', '', '', 'TEAM LEADER', NULL),
	(4, 'IT KONSULTAN', 'TEAM LEADER', '91112121', 'Abdul Hakim Hassan', '', '', 'TEAM LEADER', NULL),
	(5, 'STAFF HSE', 'STAFF HSE', '92170416', 'MUHAMMAD SOFYAN', '', '', 'TEKNISI', NULL),
	(6, 'STAFF HSE', 'STAFF HSE', '865838', 'AGUNG SETIOBUDI', '', '', 'SITE MANAGER', NULL),
	(7, 'STAFF HSE', 'STAFF HSE', '19930260', 'BENNY TARWIDI', '', '', 'TEAM LEADER', NULL),
	(9, 'STAFF HUMAN CAPITAL SERVICE', 'STAFF HUMAN CAPITAL SERVICE', '19930028', 'PANJI DWIYANTO SAPUTRO', '', '', 'STAFF', NULL),
	(10, 'TEAM LEADER COMMERCE', 'TEAM LEADER COMMERCE', '18940680', 'ABDUL MUJIB HADI', '', '', 'TEAM LEADER', NULL),
	(11, 'STAFF COMMERCE', 'STAFF COMMERCE', '20940837', 'MEGAWATI WISNU WARDHANI', '', '', 'STAFF', NULL),
	(12, 'STAFF COMMERCE', 'STAFF COMMERCE', '19980245', 'HANUM SALSABILA', '', '', 'STAFF', NULL),
	(13, 'STAFF', 'DAMAN', '18290201', 'ARDIAN SYARIFUDIN', 'STO PEKALONGAN', 'AMO', 'STAFF', NULL),
	(15, 'STAFF', 'DAMAN', '10192019', 'BOBBY IRYSAN WALANA', '', '', 'STAFF', NULL);
/*!40000 ALTER TABLE `tb_naker` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_nilai_mitra
CREATE TABLE IF NOT EXISTS `tb_nilai_mitra` (
  `nilai_m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `target_m_id` bigint(20) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `nilai` tinyint(4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nilai_m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_nilai_mitra: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_nilai_mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_nilai_mitra` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
