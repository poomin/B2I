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

-- Dumping structure for table db_augur.b2i_post
DROP TABLE IF EXISTS `b2i_post`;
CREATE TABLE IF NOT EXISTS `b2i_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `details` text,
  `type` enum('project','news','announce','article') NOT NULL DEFAULT 'news',
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_post: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_post` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_post_comment
DROP TABLE IF EXISTS `b2i_post_comment`;
CREATE TABLE IF NOT EXISTS `b2i_post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_post_comment: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_post_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_post_comment` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_post_upload
DROP TABLE IF EXISTS `b2i_post_upload`;
CREATE TABLE IF NOT EXISTS `b2i_post_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `namefile` varchar(255) DEFAULT NULL,
  `typefile` enum('img','pdf','video') NOT NULL DEFAULT 'img',
  `path` varchar(255) DEFAULT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_post_upload: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_post_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_post_upload` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_project
DROP TABLE IF EXISTS `b2i_project`;
CREATE TABLE IF NOT EXISTS `b2i_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectsetup_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `schoolname` varchar(255) DEFAULT NULL,
  `schoolregion` varchar(255) DEFAULT NULL,
  `detail` text,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_project: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_project` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_projectsetup
DROP TABLE IF EXISTS `b2i_projectsetup`;
CREATE TABLE IF NOT EXISTS `b2i_projectsetup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `title` text,
  `detail` text,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `phasestate` enum('1','2','3') NOT NULL DEFAULT '1',
  `phase1status` enum('close','process','wait') NOT NULL DEFAULT 'close',
  `phase1detail` text,
  `phase2status` enum('close','process','wait') NOT NULL DEFAULT 'close',
  `phase2detail` text,
  `phase3status` enum('close','process','wait') NOT NULL DEFAULT 'close',
  `phase3detail` text,
  `manager` text COMMENT 'ผู้รับผิดชอบโครงการ',
  `rationale` text COMMENT 'หลักการและเหตุผล',
  `objective` text COMMENT 'วัตถุประสงค์',
  `criteria` text COMMENT 'ระเบียบเกณฑ์',
  `award` text COMMENT 'รางวัล',
  `connect` text COMMENT 'ติดต่อเรา',
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_projectsetup: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_projectsetup` DISABLE KEYS */;
INSERT INTO `b2i_projectsetup` (`id`, `name`, `title`, `detail`, `active`, `phasestate`, `phase1status`, `phase1detail`, `phase2status`, `phase2detail`, `phase3status`, `phase3detail`, `manager`, `rationale`, `objective`, `criteria`, `award`, `connect`, `createat`, `updateat`) VALUES
	(1, 'B2I', NULL, NULL, 'Y', '1', 'close', NULL, 'close', NULL, 'close', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-30 15:22:15', '2018-05-30 15:22:15');
/*!40000 ALTER TABLE `b2i_projectsetup` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_projectsetup_image
DROP TABLE IF EXISTS `b2i_projectsetup_image`;
CREATE TABLE IF NOT EXISTS `b2i_projectsetup_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namefile` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_projectsetup_image: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_projectsetup_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_projectsetup_image` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_project_member
DROP TABLE IF EXISTS `b2i_project_member`;
CREATE TABLE IF NOT EXISTS `b2i_project_member` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membertype` enum('header','member') NOT NULL DEFAULT 'member',
  PRIMARY KEY (`project_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_project_member: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_project_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_project_member` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_project_phase
DROP TABLE IF EXISTS `b2i_project_phase`;
CREATE TABLE IF NOT EXISTS `b2i_project_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `phase` enum('1','2','3') NOT NULL,
  `result` enum('process','wait','fail','pass') NOT NULL DEFAULT 'process' COMMENT 'process:ดำเนินการ,wait:รอกรรมการตัดสิน,fail:ไม่ผ่าน,pass:ผ่าน',
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_project_phase: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_project_phase` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_project_phase` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_project_phase_log
DROP TABLE IF EXISTS `b2i_project_phase_log`;
CREATE TABLE IF NOT EXISTS `b2i_project_phase_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_augur.b2i_project_phase_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_project_phase_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_project_phase_log` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_project_phase_upload
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

-- Dumping data for table db_augur.b2i_project_phase_upload: ~0 rows (approximately)
/*!40000 ALTER TABLE `b2i_project_phase_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2i_project_phase_upload` ENABLE KEYS */;

-- Dumping structure for table db_augur.b2i_user
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
  `updataat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ข้อมูลสมาชิก';

-- Dumping data for table db_augur.b2i_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `b2i_user` DISABLE KEYS */;
INSERT INTO `b2i_user` (`id`, `username`, `password`, `email`, `name`, `surname`, `schoolname`, `schoolregion`, `role`, `confirmemail`, `createat`, `updataat`) VALUES
	(0, 'admin', '1234', 'admin@gmail.com', 'Admin', 'B2I', '-', 'กลาง', 'admin', 'y', '2018-05-30 15:16:35', '2018-05-30 15:18:17'),
	(1, 'teacher', '1234', 'teacher@gmail.com', 'นพรัตน์', 'แก้วศรี', 'บ้านดอนกลาง', 'ตะวันออกเฉียงเหนือ', 'teacher', 'n', '2018-05-30 15:18:12', '2018-05-31 16:43:25'),
	(2, 'student', '1234', 'student@gmail.com', 'มานพ', 'บุญศรี', 'บ้านหว้านใหญ่', 'ตะวันออกเฉียงเหนือ', 'student', 'n', '2018-05-30 15:20:50', '2018-05-31 16:43:06');
/*!40000 ALTER TABLE `b2i_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
