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

-- Dumping structure for table sigata.tbl_files
CREATE TABLE IF NOT EXISTS `tbl_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(100) DEFAULT NULL,
  `file_desc` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_visibility` int(11) DEFAULT NULL,
  `file_counter` int(11) DEFAULT 0,
  `file_created` date DEFAULT NULL,
  `file_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigata.tbl_files: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_files` DISABLE KEYS */;
INSERT INTO `tbl_files` (`file_id`, `file_title`, `file_desc`, `file_name`, `file_size`, `file_type`, `file_visibility`, `file_counter`, `file_created`, `file_by`) VALUES
	(1, 'Tes file 1', 'ini tes file 1', 'Administrator_-_Sistem_Informasi_Geografis_Aset_Kota_Pekalongan.pdf', '14.91', 'application/pdf', 1, 5, '2019-08-02', 5),
	(2, 'Tes file 2 Tes file 2 Tes file 2 Tes file 2 Tes file 2 Tes file 2 Tes file 2 Tes file 2 Tes file 2 T', 'Inin tes file 2', 'ini.pdf', '1624.8', 'application/pdf', 1, 10, '2019-08-27', 5);
/*!40000 ALTER TABLE `tbl_files` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
