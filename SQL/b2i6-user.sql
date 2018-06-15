-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_b2i.b2i_user
DROP TABLE IF EXISTS `b2i_user`;
CREATE TABLE IF NOT EXISTS `b2i_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `schoolname` varchar(255) DEFAULT NULL,
  `schoolregion` varchar(255) DEFAULT NULL COMMENT 'ภาค เหนือ ใต้ ออก ตก ตะวันออกเฉียงเหนือ',
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student' COMMENT 'สถานะ student , teacher , admin',
  `confirmemail` enum('n','y') NOT NULL DEFAULT 'n',
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updataat` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='ข้อมูลสมาชิก';

-- Dumping data for table db_b2i.b2i_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_user` DISABLE KEYS */;
INSERT INTO `b2i_user` (`id`, `username`, `password`, `email`, `name`, `surname`, `schoolname`, `schoolregion`, `role`, `confirmemail`, `createat`, `updataat`) VALUES
	(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '-', 'admin', 'b2i', '-', '-', 'admin', 'y', '2018-06-15 14:07:48', NULL);
/*!40000 ALTER TABLE `b2i_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
