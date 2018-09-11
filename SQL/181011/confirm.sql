-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.40-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_b2i.b2i_project_confirm
DROP TABLE IF EXISTS `b2i_project_confirm`;
CREATE TABLE IF NOT EXISTS `b2i_project_confirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `confirm_phase` enum('1','2','3') NOT NULL,
  `result` enum('process','wait','fail','pass') NOT NULL DEFAULT 'process' COMMENT 'process:ดำเนินการ,wait:รอกรรมการตัดสิน,fail:ไม่ผ่าน,pass:ผ่าน',
  `check_in` date DEFAULT NULL,
  `driver` text,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id_confirm_phase` (`project_id`,`confirm_phase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_b2i.b2i_project_confirm_member
DROP TABLE IF EXISTS `b2i_project_confirm_member`;
CREATE TABLE IF NOT EXISTS `b2i_project_confirm_member` (
  `confirm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membertype` enum('header','member') NOT NULL DEFAULT 'member',
  `shirts_size` enum('S','M','L','XL') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `classroom` varchar(255) DEFAULT NULL,
  `vegetarian_food` enum('Y','N') DEFAULT NULL COMMENT 'มังสวิรัติ',
  PRIMARY KEY (`confirm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_b2i.b2i_project_phase
DROP TABLE IF EXISTS `b2i_project_phase`;
CREATE TABLE IF NOT EXISTS `b2i_project_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `phase` enum('1','2','3') NOT NULL,
  `result` enum('process','wait','fail','pass') NOT NULL DEFAULT 'process' COMMENT 'process:ดำเนินการ,wait:รอกรรมการตัดสิน,fail:ไม่ผ่าน,pass:ผ่าน',
  `detail` text,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id_phase` (`project_id`,`phase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_b2i.b2i_project_phase_log
DROP TABLE IF EXISTS `b2i_project_phase_log`;
CREATE TABLE IF NOT EXISTS `b2i_project_phase_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_b2i.b2i_project_phase_upload
DROP TABLE IF EXISTS `b2i_project_phase_upload`;
CREATE TABLE IF NOT EXISTS `b2i_project_phase_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `namefile` varchar(255) DEFAULT NULL,
  `typefile` enum('img','pdf','video') NOT NULL DEFAULT 'img',
  `path` varchar(255) DEFAULT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
