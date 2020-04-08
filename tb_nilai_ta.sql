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

-- Dumping structure for table mamifa.tb_nilai_ta
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_nilai_ta: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_nilai_ta` DISABLE KEYS */;
INSERT INTO `tb_nilai_ta` (`nilai_ta_id`, `target_id`, `pok`, `roleplay`, `pre_test`, `post_test`, `kehadiran`, `lokasi`, `periode_tgl`, `keterangan`) VALUES
	(1, 1, 0, 70, 30, 90, 100, 'R. FIBER ACADEMY PEKALONGAN', '2020-04-08', '');
/*!40000 ALTER TABLE `tb_nilai_ta` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
