-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
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
  `jenis` varchar(50) DEFAULT NULL COMMENT 'MATERIAL / HABIS PAKAI',
  `satuan` varchar(10) DEFAULT NULL COMMENT 'bh = buah, m = meter',
  `stok` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_material: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_material` DISABLE KEYS */;
INSERT INTO `tb_material` (`material_id`, `material`, `merk`, `type`, `jenis`, `satuan`, `stok`) VALUES
	(1, 'SOC', 'SUMITOMO', 'SOC', 'MATERIAL', NULL, 28),
	(2, 'ADAPTER', '', '', 'MATERIAL', NULL, 50),
	(3, 'ODC', '', 'ODC', 'HABIS PAKAI', NULL, 2);
/*!40000 ALTER TABLE `tb_material` ENABLE KEYS */;

-- Dumping structure for table mamifa.tb_material_trans
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table mamifa.tb_material_trans: ~8 rows (approximately)
/*!40000 ALTER TABLE `tb_material_trans` DISABLE KEYS */;
INSERT INTO `tb_material_trans` (`mat_trans_id`, `material_id`, `jumlah`, `sumber_tujuan`, `tanggal`, `status`, `saldo`, `keterangan`) VALUES
	(1, 1, 50, 'GUDANG', '2020-04-10', 1, 50, NULL),
	(2, 1, 12, 'BREVET INDIHOME 3P', '2020-04-10', 0, 38, NULL),
	(4, 1, 8, 'PELATIHAN 2', '2020-04-12', 1, 30, NULL),
	(5, 1, 2, 'PELATIHAN 2', '2020-04-12', 1, 28, NULL),
	(6, 2, 50, 'GUDANG', '2020-04-12', 0, 50, NULL),
	(7, 3, 2, 'GUDANG', '2020-04-12', 0, 2, NULL),
	(8, 0, 0, 'PELATIHAN 1', '0000-00-00', 1, 0, NULL),
	(9, 0, 0, 'PELATIHAN 1', '0000-00-00', 1, 0, NULL),
	(10, 0, 0, 'PELATIHAN 1', '2020-04-12', 1, 0, NULL),
	(11, 0, 0, 'PELATIHAN 1', '2020-04-12', 1, 0, NULL);
/*!40000 ALTER TABLE `tb_material_trans` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
