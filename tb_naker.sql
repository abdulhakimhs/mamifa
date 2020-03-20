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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_naker: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_naker` DISABLE KEYS */;
INSERT INTO `tb_naker` (`naker_id`, `position_name`, `position_title`, `nik`, `nama`, `sektor`, `rayon`, `level`, `bpjs`) VALUES
	(1, 'Waspang Digitalisasi SPBU Pertamina', 'Waspang Digitalisasi SPBU Pertamina', '92170416', 'MUHAMMAD SOFYAN', NULL, NULL, 'Teknisi', '92170416.jpg');
/*!40000 ALTER TABLE `tb_naker` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
