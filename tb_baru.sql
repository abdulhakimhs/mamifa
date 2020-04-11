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

-- Dumping structure for table mamifa.tb_material
CREATE TABLE IF NOT EXISTS `tb_material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(100) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `stok` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_material: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_material` DISABLE KEYS */;
INSERT INTO `tb_material` (`material_id`, `material`, `merk`, `type`, `stok`) VALUES
	(1, 'SOC', 'SUMITOMO', 'SOC', 0);
/*!40000 ALTER TABLE `tb_material` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_material_trans
CREATE TABLE IF NOT EXISTS `tb_material_trans` (
  `mat_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `sumber_tujuan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 brg masuk, 0 brg keluar',
  PRIMARY KEY (`mat_trans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_material_trans: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_material_trans` DISABLE KEYS */;
INSERT INTO `tb_material_trans` (`mat_trans_id`, `material_id`, `jumlah`, `sumber_tujuan`, `tanggal`, `status`) VALUES
	(1, 1, 50, 'GUDANG', '2020-04-10', 1),
	(2, 1, 12, 'BREVET INDIHOME 3P', '2020-04-10', 0);
/*!40000 ALTER TABLE `tb_material_trans` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
