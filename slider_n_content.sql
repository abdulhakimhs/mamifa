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

-- Dumping structure for table mamifa.tb_content
CREATE TABLE IF NOT EXISTS `tb_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(50) DEFAULT NULL,
  `content_desc` text DEFAULT NULL,
  `content_image` varchar(255) DEFAULT NULL,
  `content_active` tinyint(4) DEFAULT 1 COMMENT '1 aktif, 0 tdk aktif',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_content: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_content` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_slider
CREATE TABLE IF NOT EXISTS `tb_slider` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_title` varchar(50) DEFAULT NULL,
  `slide_image` varchar(255) DEFAULT NULL,
  `slide_active` tinyint(4) DEFAULT 1 COMMENT '0 tdk aktif, 1 aktif',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_slider: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_slider` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
