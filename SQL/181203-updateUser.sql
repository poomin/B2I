ALTER TABLE `b2i_user`
	CHANGE COLUMN `role` `role` ENUM('student','teacher','admin','board','company') NOT NULL DEFAULT 'student' COMMENT 'สถานะ student , teacher , admin , board ,company' AFTER `schoolregion`;
